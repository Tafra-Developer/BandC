<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\my_helper\Helper;
use App\my_helper\Ipda3Cms;
use Illuminate\Http\Request;
use Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::where(function($q) use($request){
            if($request->name)
            {
                $q->where(function ($q) use($request){

                    $q->where('name','LIKE','%'.$request->name.'%')
                    ->orWhere('email','LIKE','%'.$request->name.'%')
                    ->orWhere('slug','LIKE','%'.$request->name.'%')
                    ->orWhere('phone','LIKE','%'.$request->name.'%');
                });
            }

            if ($request->from)
            {
                $q->whereDate('created_at' , '>=' , Helper::convertDateTime($request->from));
            }

            if ($request->to)
            {
                $q->whereDate('created_at' , '<=' , Helper::convertDateTime($request->to));
            }


        })->latest()->paginate(20);

        return view('admin.customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Customer();
        return view('admin.customers.create',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules =
            [
                'name'           => 'required',
                'slug'           => 'required|unique:customers,slug',
                'email'           => 'required|email|unique:customers',
                'phone'           => 'required|unique:customers|regex:/(01)[0-9]{9}/',
                'thumbnail'      => 'nullable',
            ];

        $error_sms =
            [
                'name.required'=>'الرجاء ادخال الاسم ',
                'slug.required'=>'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique'=>'الكلمة الدلالية متواجدة بالفعل',
                'email.required'=>'الرجاء ادخال البريد الالكتروني ',
                'email.email'=>'الرجاء ادخال البريد الالكتروني  بالطريقة الصحيحة',
                'email.unique'=>'هذا البريد الالكتروني متواجد بالفعل',
                'phone.required'=>'الرجاء ادخال رقم الهاتف ',
                'phone.unique'=>'رقم الهاتف الذي ادخلته متواجد بالفعل ',
                'phone.regex'=>'الرجاء ادخال رقم الهاتف بالطرقة الصحيحة ',
                'thumbnail.required'=>'الرجاء ادخال الصورة',
                'thumbnail.image'=>'الرجاء ادخال الصورة',
                'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Customer::create($request->all());

        if ($request->hasFile('thumbnail'))
        {

            $image = $request->file('thumbnail');

            Ipda3Cms::addPhoto($image , $record , 'customers');

        }


        session()->flash('success' , 'تمت الاضافة بنجاح');
        return redirect('admin/customers');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Customer::findOrFail($id);
        return view('admin.customers.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $record = Customer::findOrFail($id);
        $rules =
            [
                'name'           => 'required',
                'slug'           => 'required|unique:customers,slug,'.$record->id.'',
                'email'           => 'required|email|unique:customers,email,'.$record->id.'',
                'phone'           => 'required|unique:customers,phone,'.$record->id.'|regex:/(01)[0-9]{9}/',
                'thumbnail'      => 'image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'name.required'=>'الرجاء ادخال الاسم ',
                'slug.required'=>'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique'=>'الكلمة الدلالية متواجدة بالفعل',
                'email.required'=>'الرجاء ادخال البريد الالكتروني ',
                'email.email'=>'الرجاء ادخال البريد الالكتروني  بالطريقة الصحيحة',
                'email.unique'=>'هذا البريد الالكتروني متواجد بالفعل',
                'phone.required'=>'الرجاء ادخال رقم الهاتف ',
                'phone.unique'=>'رقم الهاتف الذي ادخلته متواجد بالفعل ',
                'phone.regex'=>'الرجاء ادخال رقم الهاتف بالطرقة الصحيحة ',
                'thumbnail.image'=>'الرجاء ادخال الصورة',
                'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',

            ];


        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }


        $record->update($request->all());

        if ($request->hasFile('thumbnail'))
        {
            Ipda3Cms::updatePhoto($request->file('thumbnail') , $record->photo , $record , 'customers');
        }

        session()->flash('success' , 'تمت تحديث بنجاح');
        return redirect('admin/customers/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Customer::findOrFail($id);


        Ipda3Cms::deletePhoto($record);
        $record->delete();
        $data = [
            'status' => 1,
            'msg' => 'تم الحذف بنجاح',
            'id' => $id
        ];
        return Response::json($data, 200);
    }


    public function activation($id)
    {
        $record = Customer::find($id);

        if($record)
        {
           $activate =  Helper::activation($record);

           if($activate)
           {
               session()->flash('success' , 'تمت العملية بنجاح');
               return redirect('admin/customers');
           }
        }

        session()->flash('fail' , 'حدث خطأ ما الجاء المحاوله مره اخري');
        return redirect('admin/customers');
    }
}
