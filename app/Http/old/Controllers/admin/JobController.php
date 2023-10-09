<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\my_helper\Helper;
use App\my_helper\Ipda3Cms;
use Illuminate\Http\Request;
use Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs = Job::where(function($q) use($request){
            if($request->name)
            {
                $q->where(function ($q) use($request){

                    $q->where('title_en','LIKE','%'.$request->name.'%')
                    ->orWhere('title_ar','LIKE','%'.$request->name.'%')
                    ->orWhere('slug','LIKE','%'.$request->name.'%')
                    ->orWhere('details_en','LIKE','%'.$request->name.'%')
                    ->orWhere('details_ar','LIKE','%'.$request->name.'%');
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


        return view('admin.jobs.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Job();
        return view('admin.jobs.create',compact('model'));
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
                'slug'           => 'required|unique:jobs,slug',
                'job_type_id' => 'required|exists:job_types,id',
                'title_ar'           => 'required',
                'title_en'           => 'required',
                'details_en'           => 'required',
                'details_ar'           => 'required',
                'tags'           => 'required',
                'thumbnail'      => 'required|image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'name.required'=>'الرجاء ادخال الاسم ',
                'slug.required'=>'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique'=>'الكلمة الدلالية متواجدة بالفعل',
                'job_type_id.required'=>'الرجاء اختيار نوع الوظيفة',
                'title_ar.required'=>'الرجاء ادخال الاسم ',
                'title_en.required'=>'الرجاء ادخال الاسم',
                'details_en.required'=>'الرجاء ادخال تفاصيل الوظيفة ',
                'details_ar.required'=>'الرجاء ادخال تفاصيل الوظيفة',
                'tags.required'=>'الرجاء ادخال الكلمات المفتاحية',
                'thumbnail.required'=>'الرجاء ادخال الصورة',
                'thumbnail.image'=>'الرجاء ادخال الصورة',
                'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Job::create($request->all());

        if ($request->hasFile('thumbnail'))
        {

            $image = $request->file('thumbnail');

            Ipda3Cms::addPhoto($image , $record , 'jobs');

        }

        $record->tags()->attach($request->tags);

        session()->flash('success' , 'تمت الاضافة بنجاح');
        return redirect('admin/jobs');
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
        $model = Job::findOrFail($id);
        return view('admin.jobs.edit',compact('model'));
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

        $record = Job::findOrFail($id);

        $rules =
            [
                'slug'           => 'required|unique:jobs,slug,'.$record->id.'',
                'job_type_id' => 'required|exists:job_types,id',
                'title_ar'           => 'required',
                'title_en'           => 'required',
                'details_en'           => 'required',
                'details_ar'           => 'required',
                'tags'           => 'required',
                'thumbnail'      => 'image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'slug.required'=>'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique'=>'الكلمة الدلالية متواجدة بالفعل',
                'job_type_id.required'=>'الرجاء اختيار نوع الوظيفة',
                'title_ar.required'=>'الرجاء ادخال الاسم ',
                'title_en.required'=>'الرجاء ادخال الاسم',
                'details_en.required'=>'الرجاء ادخال تفاصيل الوظيفة ',
                'details_ar.required'=>'الرجاء ادخال تفاصيل الوظيفة',
                'tags.required'=>'الرجاء ادخال الكلمات المفتاحية',
                'thumbnail.required'=>'الرجاء ادخال الصورة',
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
            Ipda3Cms::updatePhoto($request->file('thumbnail') , $record->photo , $record , 'jobs');
        }
        if($request->has('tags')){
            $record->tags()->sync($request->tags);
        }

        session()->flash('success' , 'تمت تحديث بنجاح');
        return redirect('admin/jobs/'.$id.'/edit');
    }

    /**
         * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Job::findOrFail($id);

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
        $record = Job::find($id);

        if($record)
        {
           $activate =  Helper::activation($record);

           if($activate)
           {
               session()->flash('success' , 'تمت العملية بنجاح');
               return redirect('admin/jobs');
           }
        }

        session()->flash('fail' , 'حدث خطأ ما الجاء المحاوله مره اخري');
        return redirect('admin/jobs');
    }
}
