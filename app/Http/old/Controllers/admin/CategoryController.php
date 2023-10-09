<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use App\my_helper\Helper;
use App\my_helper\Ipda3Cms;
use Illuminate\Http\Request;
use Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories = Category::where(function($q) use($request){
            if($request->name)
            {
                $q->where(function ($q) use($request){

                    $q->where('name_en','LIKE','%'.$request->name.'%')
                    ->orWhere('name_ar','LIKE','%'.$request->name.'%');
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

        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Category();
        return view('admin.categories.create',compact('model'));
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
                'name_ar'           => 'required',
                'name_en'           => 'required',
                'tags'           => 'required',
                'thumbnail'      => 'image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'name_ar.required'=>'الرجاء ادخال الاسم ',
                'name_en.required'=>'الرجاء ادخال الاسم',
                'tags.required'=>'الرجاء ادخال الكلمات المفتاحية',
                'thumbnail.image'=>'الرجاء ادخال الصورة',
                'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Category::create($request->all());

        if ($request->hasFile('thumbnail'))
        {

            $image = $request->file('thumbnail');

            Ipda3Cms::addPhoto($image , $record , 'categories');

        }

        $record->tags()->attach($request->tags);

        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect('admin/categories');
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
        $model = Category::findOrFail($id);
        return view('admin.categories.edit',compact('model'));
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
        $rules =
            [
                'name_ar'           => 'required',
                'name_en'           => 'required',
                'tags'           => 'required',
                'thumbnail'      => 'image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'name_ar.required'=>'الرجاء ادخال الاسم ',
                'name_en.required'=>'الرجاء ادخال الاسم',
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

        $record = Category::findOrFail($id);

        $record ->update($request->all());

        if ($request->hasFile('thumbnail'))
        {
            Ipda3Cms::updatePhoto($request->file('thumbnail') , $record->photo , $record , 'categories');
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
        return redirect('admin/categories/'.$id.'/edit');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Category::findOrFail($id);

        if($record->products)
        {
            $data = [
                'status' => 0,
                'msg' => 'لا يمكن حذف هذا القسم , يوجد منتجات مرتبطة به',
                'id' => $id
            ];
            return Response::json($data, 200);
        }
        if($record->tags)
            $record->tags()->detach();
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
        $record = Category::find($id);

        if($record)
        {
           $activate =  Helper::activation($record);

           if($activate)
           {
               session()->flash('success' , 'تمت العملية بنجاح');
               return redirect('admin/categories');
           }
        }

        session()->flash('fail' , 'حدث خطأ ما الجاء المحاوله مره اخري');
        return redirect('admin/categories');
    }
}
