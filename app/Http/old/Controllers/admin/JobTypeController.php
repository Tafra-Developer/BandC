<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job_type;
use App\Models\Tag;
use App\my_helper\Helper;
use App\my_helper\Ipda3Cms;
use Illuminate\Http\Request;
use Response;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $job_types = Job_type::where(function($q) use($request){
            if($request->name)
            {
                $q->where(function ($q) use($request){

                    $q->where('type','LIKE','%'.$request->name.'%');
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

        return view('admin.job_types.index',compact('job_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Job_type();
        return view('admin.job_types.create',compact('model'));
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
                'type'           => 'required'
            ];

        $error_sms =
            [
                'name_ar.required'=>'الرجاء ادخال نوع الوظيفة '

            ];

        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Job_type::create($request->all());


        session()->flash('success' , 'تمت الاضافة بنجاح');
        return redirect('admin/job-types');
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
        $model = Job_type::findOrFail($id);
        return view('admin.job_types.edit',compact('model'));
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
                'type'           => 'required'
            ];

        $error_sms =
            [
                'name_ar.required'=>'الرجاء ادخال نوع الوظيفة '

            ];


        $data = validator()->make($request->all() , $rules , $error_sms );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Job_type::findOrFail($id);

        $record ->update($request->all());


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
        return redirect('admin/job-types/'.$id.'/edit');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Job_type::findOrFail($id);

        if (count($record->jobs))
        {
            $data = [
                'status' => 0,
                'msg' => 'لا يمكن الحذف ، يوجد  وظائف مرتبطة بهذا النوع  ',
            ];
            return response()->json($data, 200);
        }

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
        $record = Job_type::find($id);

        if($record)
        {
           $activate =  Helper::activation($record);

           if($activate)
           {
               session()->flash('success' , 'تمت العملية بنجاح');
               return redirect('admin/job-types');
           }
        }

        session()->flash('fail' , 'حدث خطأ ما الرجاء المحاوله مره اخري');
        return redirect('admin/job-types');
    }
}
