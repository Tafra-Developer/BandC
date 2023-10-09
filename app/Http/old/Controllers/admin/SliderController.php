<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\my_helper\Helper;
use App\my_helper\Ipda3Cms;
use Illuminate\Http\Request;
use Response;

class SliderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sliders = Slider::where(function($q) use($request){
            if($request->name)
            {
                $q->where(function ($q) use($request){

                    $q->where('title_en','LIKE','%'.$request->name.'%')
                    ->orWhere('title_ar','LIKE','%'.$request->name.'%')
                    ->orWhere('body_en','LIKE','%'.$request->name.'%')
                        ->orWhere('slug','LIKE','%'.$request->name.'%')
                    ->orWhere('body_ar','LIKE','%'.$request->name.'%');
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

        return view('admin.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Slider();
        return view('admin.sliders.create',compact('model'));
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
                'slug'           => 'required|unique:sliders,slug',
                'title_ar'           => 'required',
                'title_en'           => 'required',
                'body_ar'           => 'required',
                'body_en'           => 'required',
                'action_url'           => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'thumbnail'      => 'required|image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'slug.required'=>'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique'=>'الكلمة الدلالية متواجدة بالفعل',
                'title_ar.required'=>'الرجاء ادخال الاسم ',
                'title_en.required'=>'الرجاء ادخال الاسم',
                'body_ar.required'=>'الرجاء ادخال الاسم ',
                'body_en.required'=>'الرجاء ادخال الاسم',
                'action_url.required'=>'الرجاء ادخال رابط',
                'action_url.regex'=>'الرابط غير صالح ',
                'thumbnail.required'=>'الرجاء ادخال الصورة',
                'thumbnail.image'=>'الرجاء ادخال الصورة',
                'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Slider::create($request->all());

        if ($request->hasFile('thumbnail'))
        {

            $image = $request->file('thumbnail');

            Ipda3Cms::addPhoto($image , $record , 'sliders');

        }

        if ($request->has('tags'))
        {

            $record->tags()->attach($request->tags);

        }


        session()->flash('success' , 'تمت الاضافة بنجاح');
        return redirect('admin/sliders');
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
        $model = Slider::findOrFail($id);
        return view('admin.sliders.edit',compact('model'));
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
        $record = Slider::findOrFail($id);
        $rules =
            [
                'slug'           => 'required|unique:sliders,slug,'.$record->id.'',
                'title_ar'           => 'required',
                'title_en'           => 'required',
                'body_ar'           => 'required',
                'body_en'           => 'required',
                'action_url'           => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'thumbnail'      => 'image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'slug.required'=>'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique'=>'الكلمة الدلالية متواجدة بالفعل',
                'title_ar.required'=>'الرجاء ادخال الاسم ',
                'title_en.required'=>'الرجاء ادخال الاسم',
                'body_ar.required'=>'الرجاء ادخال الاسم ',
                'body_en.required'=>'الرجاء ادخال الاسم',
                'action_url.required'=>'الرجاء ادخال رابط',
                'action_url.regex'=>'الرابط غير صالح ',
                'thumbnail.image'=>'الرجاء ادخال الصورة',
                'thumbnail.mimes'=>'صيغة الصورة غير مقبولة'

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }


        $record ->update($request->all());

        if ($request->hasFile('thumbnail'))
        {
            Ipda3Cms::updatePhoto($request->file('thumbnail') , $record->photo , $record , 'sliders');
        }
        if($request->has('tags')){
            $record->tags()->sync($request->tags);
        }
//      if ($request->hasFile('photos'))
//      {
//          if($record->photos)
//          {
//              foreach ($record->photos as $photo) {
//                  if( file_exists($photo)){
//                      unlink($photo);
//                  }
//              }
//          }
//        foreach ($request->photos as $photo) {
//              $destinationPath = base_path() . '/uploads/services/images/';
//              $extension = $photo->getClientOriginalExtension(); // getting image extension
//              $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
//              $photo->move($destinationPath, $name); // uploading file to given
//              $record->photos()->create(['extension' => $extension, 'url' => 'uploads/services/images/' . $name]);
//
//          }
//      }

        session()->flash('success' , 'تمت تحديث بنجاح');
        return redirect('admin/sliders/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Slider::findOrFail($id);

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
        $record = Slider::find($id);

        if($record)
        {
           $activate =  Helper::activation($record);

           if($activate)
           {
               session()->flash('success' , 'تمت العملية بنجاح');
               return redirect('admin/sliders');
           }
        }

        session()->flash('fail' , 'حدث خطأ ما الجاء المحاوله مره اخري');
        return redirect('admin/sliders');
    }
}
