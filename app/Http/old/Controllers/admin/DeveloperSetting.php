<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Response;

class DeveloperSetting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Option::latest()->paginate(20);

        return view('admin.developer_setting.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Option();
        $validation = null;
        return view('admin.developer_setting.create',compact('model' ,'validation'));
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
                'display_name_ar'           => 'required',
                'display_name_en'           => 'required',
                'key'           => 'required',
                'value'           => 'required',
                'validation'           => 'required',
                'data_type'           => 'required'
            ];


        $data = validator()->make($request->all() , $rules  );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Option::create($request->except('validation'));

        $record->validation()->create(['value' => $request->validation]);


        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect('admin/developer/setting');
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
        $model = Option::findOrFail($id);
        $validation = $model->validation->value;

        return view('admin.developer_setting.edit',compact('model' , 'validation'));
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
                'display_name_ar'           => 'required',
                'display_name_en'           => 'required',
                'key'           => 'required',
                'value'           => 'required',
                'validation'           => 'required',
                'data_type'           => 'required'
            ];


        $data = validator()->make($request->all() , $rules  );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Option::findOrFail($id);

        $record ->update($request->except('validation'));

        $record->validation()->update(['value' => $request->validation]);

        session()->flash('success' , 'تمت تحديث بنجاح');
        return redirect('admin/developer/setting/'.$id.'/edit');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Option::findOrFail($id);

        $record->validation()->delete();
        $record->delete();
        $data = [
            'status' => 1,
            'msg' => 'تم الحذف بنجاح',
            'id' => $id
        ];
        return Response::json($data, 200);
    }


}
