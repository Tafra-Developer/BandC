<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\my_helper\Helper;
use App\my_helper\Ipda3Cms;
use Illuminate\Http\Request;
use Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::where(function ($q) use ($request) {
            if ($request->name) {
                $q->where(function ($q) use ($request) {

                    $q->where('name_en', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('name_ar', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('body_en', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('slug', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('body_ar', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('excerpt_en', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('excerpt_ar', 'LIKE', '%' . $request->name . '%');
                });
            }
            if ($request->tag) {
                $q->whereHas('tags', function ($q) use ($request) {

                    $q->where('title_ar', 'LIKE', '%' . $request->tag . '%')
                        ->orWhere('title_en', 'LIKE', '%' . $request->tag . '%');
                });
            }
            if ($request->from) {
                $q->whereDate('created_at', '>=', Helper::convertDateTime($request->from));
            }

            if ($request->to) {
                $q->whereDate('created_at', '<=', Helper::convertDateTime($request->to));
            }
        })->latest()->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Product();
        return view('admin.products.create', compact('model'));
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
                'slug'           => 'nullable|unique:products,slug',
                'category_id'           => 'nullable|exists:categories,id',
                'name_ar'           => 'nullable',
                'name_en'           => 'nullable',
                'price'           => 'nullable',
                'offer_price'           => 'nullable',
                'excerpt_en'           => 'nullable',
                'excerpt_ar'           => 'nullable',
                'tags'           => 'nullable',
                'thumbnail'      => 'required',
            ];

        $error_sms =
            [
                'slug.required' => 'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique' => 'الكلمة الدلالية متواجدة بالفعل',
                'category_id.required' => 'الرجاء اختيار القسم',
                'name_ar.required' => 'الرجاء ادخال الاسم ',
                'name_en.required' => 'الرجاء ادخال الاسم',
                'price.required' => 'الرجاء ادخال السعر ',
                'offer_price.required' => 'الرجاء ادخال السعر بعد الخصم',
                'excerpt_en.required' => 'الرجاء ادخال تفاصيل المنتج ',
                'excerpt_ar.required' => 'الرجاء ادخال تفاصيل المنتج',
                'tags.required' => 'الرجاء ادخال الكلمات المفتاحية',
                'thumbnail.required' => 'الرجاء ادخال الصورة',
                'thumbnail.image' => 'الرجاء ادخال الصورة',
                'thumbnail.mimes' => 'صيغة الصورة غير مقبولة',

            ];

        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Product::create($request->all());

        if ($request->hasFile('thumbnail')) {

            $image = $request->file('thumbnail');

            Ipda3Cms::addPhoto($image, $record, 'products');
        }

        $record->tags()->attach($request->tags);

        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect('admin/products');
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
        $model = Product::findOrFail($id);
        return view('admin.products.edit', compact('model'));
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
        $record = Product::findOrFail($id);
        $rules =
            [
                'slug'           => 'required|unique:products,slug,' . $record->id . '',
                'category_id'           => 'required',
                'name_ar'           => 'required',
                'name_en'           => 'required',
                'price'           => 'required',
                'offer_price'           => 'required',
                'excerpt_en'           => 'required',
                'excerpt_ar'           => 'required',
                'tags'           => 'required',
                'thumbnail'      => 'image|mimes:jpeg,jpg,png',
            ];

        $error_sms =
            [
                'slug.required' => 'الرجاء ادخال الكلمة الدلالية ',
                'slug.unique' => 'الكلمة الدلالية متواجدة بالفعل',
                'category_id.required' => 'الرجاء اختيار القسم',
                'name_ar.required' => 'الرجاء ادخال الاسم ',
                'name_en.required' => 'الرجاء ادخال الاسم',
                'price.required' => 'الرجاء ادخال السعر ',
                'offer_price.required' => 'الرجاء ادخال السعر بعد الخصم',
                'excerpt_en.required' => 'الرجاء ادخال تفاصيل المنتج ',
                'excerpt_ar.required' => 'الرجاء ادخال تفاصيل المنتج',
                'tags.required' => 'الرجاء ادخال الكلمات المفتاحية',
                'thumbnail.image' => 'الرجاء ادخال الصورة',
                'thumbnail.mimes' => 'صيغة الصورة غير مقبولة',

            ];

        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }


        $record->update($request->all());

        if ($request->hasFile('thumbnail')) {
            Ipda3Cms::updatePhoto($request->file('thumbnail'), $record->photo, $record, 'products');
        }
        if ($request->has('tags')) {
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

        session()->flash('success', 'تمت تحديث بنجاح');
        return redirect('admin/products/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Product::findOrFail($id);

        if ($record->tags)
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
        $record = Product::find($id);

        if ($record) {
            $activate =  Helper::activation($record);

            if ($activate) {
                session()->flash('success', 'تمت العملية بنجاح');
                return redirect('admin/products');
            }
        }

        session()->flash('fail', 'حدث خطأ ما الجاء المحاوله مره اخري');
        return redirect('admin/products');
    }
}
