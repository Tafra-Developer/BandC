<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\my_helper\Helper;
use App\my_helper\Ipda3Cms;
use Illuminate\Http\Request;
use Response;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $testimonials = Testimonial::where(function($q) use($request){
            if($request->name)
            {
                $q->where('name','LIKE','%'.$request->name.'%');
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
        return view('admin.testimonials.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Testimonial();
        return view('admin.testimonials.create',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'        => 'required',
            'body'        => 'required',
            'thumbnail'      => 'required|image|max:1000|mimes:jpeg,jpg,png',
        ] , [
            'name.required' => 'الرجاء ادخال اسم العميل',
            'body.required' => 'الرجاء ادخال المحتوي',
            'thumbnail.required'=>'الرجاء ادخال الصورة',
            'thumbnail.max'=>'حجم الصورة كبير اختر صورة اخري',
            'thumbnail.image'=>'الرجاء ادخال الصورة',
            'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',
        ]);

        $testimonial = Testimonial::create($request->all());

        if ($request->hasFile('thumbnail'))
        {

            $image = $request->file('thumbnail');

            Ipda3Cms::addPhoto($image , $testimonial , 'testimonials');

        }


        session()->flash('success' , 'تمت الاضافة بنجاح');
        return redirect('admin/testimonial');
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
        $model = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit',compact('model'));
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
        $this->validate($request,[
            'name'        => 'required',
            'body'        => 'required',
            'thumbnail'      => 'image|max:1000|mimes:jpeg,jpg,png',
        ] , [
            'name.required' => 'الرجاء ادخال اسم العميل',
            'body.required' => 'الرجاء ادخال المحتوي',
            'thumbnail.max'=>'حجم الصورة كبير اختر صورة اخري',
            'thumbnail.image'=>'الرجاء ادخال الصورة',
            'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',
        ]);

        $record = Testimonial::findOrFail($id);
        $record->update($request->except('thumbnail'));


        if ($request->hasFile('thumbnail'))
        {
            Ipda3Cms::updatePhoto($request->file('thumbnail') , $record->photo , $record , 'testimonials');
        }
        session()->flash('success' , 'تمت تحديث بنجاح');
        return redirect('admin/testimonial/'.$id.'/edit');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Testimonial::findOrFail($id);

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
