<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\my_helper\Helper;
use App\my_helper\Ipda3Cms;
use Illuminate\Http\Request;
use Response;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = Page::where(function($q) use($request){
            if($request->name)
            {
                $q->where(function ($q) use($request){

                    $q->where('title_en','LIKE','%'.$request->name.'%')
                    ->orWhere('title_ar','LIKE','%'.$request->name.'%')
                    ->orWhere('body_en','LIKE','%'.$request->name.'%')
                        ->orWhere('slug','LIKE','%'.$request->name.'%')
                    ->orWhere('body_ar','LIKE','%'.$request->name.'%')
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

        return view('admin.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Page();
        return view('admin.pages.create',compact('model'));
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
                'slug'           => 'required|unique:pages,slug',
                'title_ar'           => 'required',
                'title_en'           => 'required',
                'excerpt_en'           => 'required',
                'excerpt_ar'           => 'required',
                'body_en'           => 'required',
                'body_ar'           => 'required',
                'tags'           => 'required',
                'thumbnail'      => 'required|image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'name.required'=>'الرجاء ادخال الاسم ',
                'slug.required'=>'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique'=>'الكلمة الدلالية متواجدة بالفعل',
                'title_ar.required'=>'الرجاء ادخال الاسم ',
                'title_en.required'=>'الرجاء ادخال الاسم',
                'excerpt_en.required'=>'الرجاء ادخال وصف مختصر ',
                'excerpt_ar.required'=>'الرجاء ادخال وصف مختصر',
                'body_en.required'=>'الرجاء ادخال تفاصيل صفحة ',
                'body_ar.required'=>'الرجاء ادخال تفاصيل صفحة',
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

        $record = Page::create($request->all());

        if ($request->hasFile('thumbnail'))
        {

            $image = $request->file('thumbnail');

            Ipda3Cms::addPhoto($image , $record , 'pages');

        }

        $record->tags()->attach($request->tags);

        session()->flash('success' , 'تمت الاضافة بنجاح');
        return redirect('admin/pages');
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
        $model = Page::findOrFail($id);
        return view('admin.pages.edit',compact('model'));
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
        $record = Page::findOrFail($id);
        $rules =
            [
                'slug'           => 'required|unique:pages,slug,'.$record->id.'',
                'title_ar'           => 'required',
                'title_en'           => 'required',
                'excerpt_en'           => 'required',
                'excerpt_ar'           => 'required',
                'body_en'           => 'required',
                'body_ar'           => 'required',
                'tags'           => 'required',
                'thumbnail'      => 'image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'name.required'=>'الرجاء ادخال الاسم ',
                'slug.required'=>'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique'=>'الكلمة الدلالية متواجدة بالفعل',
                'title_ar.required'=>'الرجاء ادخال الاسم ',
                'title_en.required'=>'الرجاء ادخال الاسم',
                'excerpt_en.required'=>'الرجاء ادخال وصف مختصر ',
                'excerpt_ar.required'=>'الرجاء ادخال وصف مختصر',
                'body_en.required'=>'الرجاء ادخال تفاصيل صفحة ',
                'body_ar.required'=>'الرجاء ادخال تفاصيل صفحة',
                'tags.required'=>'الرجاء ادخال الكلمات المفتاحية',
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
            Ipda3Cms::updatePhoto($request->file('thumbnail') , $record->photo , $record , 'pages');
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
        return redirect('admin/pages/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Page::findOrFail($id);

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
        $record = Page::find($id);

        if($record)
        {
           $activate =  Helper::activation($record);

           if($activate)
           {
               session()->flash('success' , 'تمت العملية بنجاح');
               return redirect('admin/pages');
           }
        }

        session()->flash('fail' , 'حدث خطأ ما الجاء المحاوله مره اخري');
        return redirect('admin/pages');
    }
}
