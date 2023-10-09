<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\my_helper\Helper;
use App\my_helper\Ipda3Cms;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = Service::where(function($q) use($request){
            if($request->name)
            {
                $q->where(function ($q) use($request){

                    $q->where('name_en','LIKE','%'.$request->name.'%')
                        ->orWhere('name_ar','LIKE','%'.$request->name.'%')
                        ->orWhere('slug','LIKE','%'.$request->name.'%')
                        ->orWhere('description_en','LIKE','%'.$request->name.'%')
                        ->orWhere('description_ar','LIKE','%'.$request->name.'%')
                        ->orWhere('excerpt_en','LIKE','%'.$request->name.'%')
                        ->orWhere('excerpt_ar','LIKE','%'.$request->name.'%');
                });
            }
            if ($request->tag)
            {
                $q->whereHas( 'tags' ,function ($q) use($request){

                    $q->where('title_ar','LIKE','%'.$request->tag.'%')
                        ->orWhere('title_en','LIKE','%'.$request->tag.'%');
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
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Service();
        return view('admin.services.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules =
            [
                'slug'           => 'required|unique:services,slug',
                'name_ar'           => 'required',
                'name_en'           => 'required',
                'description_en'           => 'required',
                'description_ar'           => 'required',
                'thumbnail'      => 'required|image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'slug.required'=>'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique'=>'الكلمة الدلالية متواجدة بالفعل',
                'name_ar.required'=>'الرجاء ادخال الاسم ',
                'name_en.required'=>'الرجاء ادخال الاسم',
                'description_en.required'=>'الرجاء ادخال تفاصيل المنتج ',
                'description_ar.required'=>'الرجاء ادخال تفاصيل المنتج',
                'thumbnail.required'=>'الرجاء ادخال الصورة',
                'thumbnail.image'=>'الرجاء ادخال الصورة',
                'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Service::create($request->all());

        if ($request->hasFile('thumbnail'))
        {

            $image = $request->file('thumbnail');

            Ipda3Cms::addPhoto($image , $record , 'services');

        }

        if ($request->has('tags'))
        {

            $record->tags()->attach($request->tags);

        }


        session()->flash('success' , 'تمت الاضافة بنجاح');
        return redirect('admin/services');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Service::findOrFail($id);
        return view('admin.services.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = Service::findOrFail($id);
        $rules =
            [
                'slug'           => 'required|unique:services,slug,'.$record->id.'',
                'name_ar'           => 'required',
                'name_en'           => 'required',
                'description_en'           => 'required',
                'description_ar'           => 'required',
                'thumbnail'      => 'image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'slug.required'=>'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique'=>'الكلمة الدلالية متواجدة بالفعل',
                'name_ar.required'=>'الرجاء ادخال الاسم ',
                'name_en.required'=>'الرجاء ادخال الاسم',
                'description_en.required'=>'الرجاء ادخال تفاصيل المنتج ',
                'description_ar.required'=>'الرجاء ادخال تفاصيل المنتج',
                'thumbnail.image'=>'الرجاء ادخال الصورة',
                'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',

            ];
        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }


        $record ->update($request->all());

        if ($request->hasFile('thumbnail'))
        {
            Ipda3Cms::updatePhoto($request->file('thumbnail') , $record->photo , $record , 'services');
        }
        if($request->has('tags')){
            $record->tags()->sync($request->tags);
        }

        session()->flash('success' , 'تمت تحديث بنجاح');
        return redirect('admin/services/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Service::findOrFail($id);

        if($record->tags)
            $record->tags()->detach();

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
        $record = Service::find($id);

        if($record)
        {
            $activate =  Helper::activation($record);

            if($activate)
            {
                session()->flash('success' , 'تمت العملية بنجاح');
                return redirect('admin/services');
            }
        }

        session()->flash('fail' , 'حدث خطأ ما الجاء المحاوله مره اخري');
        return redirect('admin/services');
    }
}
