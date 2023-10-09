<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Service;
use App\my_helper\Ipda3Cms;
use Illuminate\Http\Request;
use Response;

class ServiceFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $service = Service::find($id);

        if($service)
        {
            $features = $service->features()->latest()->paginate(20);

            return view('admin.features.index',compact('features' , 'service'));
        }else{

            session()->flash('fail' , 'لم يتم العثور علي هذه الخدمة');
            return redirect('admin/services');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $model = new Feature();
        $service = Service::find($id);
        if($service)
        {
            return view('admin.features.create',compact('model' , 'service'));
        }else{

            session()->flash('fail' , 'لم يتم العثور علي هذه الخدمة');
            return redirect('admin/services');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id , Request $request)
    {

        $rules =
            [
                'title_en'   =>'required',
                'title_ar'   =>'required',
                'body_en'           => 'required',
                'body_ar'           => 'required',
                'thumbnail'      => 'required|image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'title_ar.required'=>'الرجاء ادخال الاسم ',
                'title_en.required'=>'الرجاء ادخال الاسم',
                'body_en.required'=>'الرجاء ادخال تفاصيل المنتج ',
                'body_ar.required'=>'الرجاء ادخال تفاصيل المنتج',
                'thumbnail.required'=>'الرجاء ادخال الصورة',
                'thumbnail.image'=>'الرجاء ادخال الصورة',
                'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $service = Service::find($id);

        if(!$service)
        {
            session()->flash('fail' , 'لم يتم العثور علي هذه الخدمة');
            return redirect('admin/services');
        }


        $record = $service->features()->create($request->all());

        if ($request->hasFile('thumbnail'))
        {

            $image = $request->file('thumbnail');

            Ipda3Cms::addPhoto($image , $record , 'features');
        }

        session()->flash('success' , 'تم إضافة الميزة بنجاح');
        return redirect('/admin/services/'.$service->id.'/feature');
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
    public function edit( $service_id ,$id)
    {
        $service = Service::find($service_id);
        if($service)
        {
            $model = Feature::findOrFail($id);
            return view('admin.features.edit',compact('model' ,'service'));
        }else{

            session()->flash('fail' , 'لم يتم العثور علي هذه الخدمة');
            return redirect('admin/services');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $service_id , $id , Request $request)
    {

        $rules =
            [
                'title_en'   =>'required',
                'title_ar'   =>'required',
                'body_en'           => 'required',
                'body_ar'           => 'required',
            ];

        $error_sms =
            [
                'title_ar.required'=>'الرجاء ادخال الاسم ',
                'title_en.required'=>'الرجاء ادخال الاسم',
                'body_en.required'=>'الرجاء ادخال تفاصيل المنتج ',
                'body_ar.required'=>'الرجاء ادخال تفاصيل المنتج',

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $service = Service::find($service_id);

        if(!$service)
        {
            session()->flash('fail' , 'لم يتم العثور علي هذه الخدمة');
            return redirect('admin/services');
        }


        $record = $service->features()->findOrFail($id);
        $record->update($request->except('thumbnail'));
        if ($request->hasFile('thumbnail'))
        {
            Ipda3Cms::updatePhoto($request->file('thumbnail') , $record->photo , $record , 'features');
        }


        session()->flash('success' , 'تم التحديث بنجاح');
        return redirect('/admin/services/'.$service_id.'/feature/'.$id.'/edit');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($service_id , $id)
    {
        $service = Service::find($service_id);

        if(!$service)
        {
            $data = [
                'status' => 0,
                'msg' => 'تم الحذف بنجاح',
                'id' => $id
            ];
            return Response::json($data, 400);

        }

       $record = $service->features()->findOrFail($id);

        Ipda3Cms::deletePhoto($record);
        $record->delete();
        $data = [
            'status' => 1,
            'msg' => 'تم الحذف بنجاح',
            'id' => $id
        ];
        return Response::json($data, 200);
    }
}
