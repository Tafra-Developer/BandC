<?php

namespace App\Http\Controllers\admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Response;

class TagController extends Controller
{
    //
    public function index()
    {
        $tags = Tag::latest()->paginate(20);
        return view('admin.tags.index',compact('tags'));
    }

    public function create(Tag $model)
    {
        return view('admin.tags.create',compact('model'));
    }

    public function store(Request $request)
    {
        $rules =
            [
                'title_ar'           => 'required',
                'title_en'           => 'required'
            ];

        $error_sms =
            [
                'title_ar.required'=>'الرجاء ادخال الكلمة ',
                'title_en.required'=>'الرجاء ادخال الكلمة',

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }
        Tag::create($request->all());

        session()->flash('success' , 'تمت الاضافة بنجاح');
        return redirect('admin/tag');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $model = Tag::findOrFail($id);
        return view('admin.tags.edit',compact('model'));
    }

    public function update(Request $request , $id)
    {
        $rules =
            [
                'title_ar'           => 'required',
                'title_en'           => 'required'
            ];

        $error_sms =
            [
                'title_ar.required'=>'الرجاء ادخال الكلمة ',
                'title_en.required'=>'الرجاء ادخال الكلمة',

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        Tag::findOrFail($id)->update($request->all());


        session()->flash('success' , 'تمت التعديل بنجاح');
        return redirect('admin/tag');

    }

    public function destroy($id)
    {
        $record = Tag::findOrFail($id);
        if (
                count($record->posts) ||
                count($record->sliders) ||
                count($record->pages) ||
                count($record->jobs) ||
                count($record->categories) ||
                count($record->products) ||
                count($record->customers) ||
                count($record->projects) ||
                count($record->services)
            )
        {
            $data = [
                'status' => 0,
                'msg' => 'لا يمكن الحذف ، يوجد  مقالات مرتبطة بهذه الكلمة الدلالية  ',
            ];
            return response()->json($data, 200);
        }
        $record->delete();
        $data = [
            'status' => 1,
            'msg' => 'تم الحذف بنجاح',
            'id' => $id
        ];
        return response()->json($data, 200);
    }
}
