<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PatientController extends Controller
{
    protected $model;
    protected $viewsDomain = 'admin.patient.';

    public function __construct()
    {
        $this->model = new Patient();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }
    public function index(Request $request)
    {
        $records = $this->model->where(function ($query) use ($request) {
            if ($request->name) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            }
        })->paginate(10);
        $totalRecords = $records->count();

        return $this->view('index', compact('records', 'totalRecords'));
    }


    public function page()
    {
        $records = $this->model->get();
        return view('front.patient', compact('records'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $record = $this->model->get();
        return $this->view('create', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'img'        => 'required',

        ];
        $messages = [
            'name_ar.required'        => 'الاسم مطلوب',
            'name_en.required'        => 'الاسم مطلوب',
            'img.required'        => 'الصورة مطلوب',
        ];
        $data = $this->validate($request, $rules, $messages);

        $data = $this->validate($request, $rules, $messages);
        $fileName = time() . '.' . $request->file('img')->extension();
        $request->file('img')->storeAs('public/images', $fileName);
        $new_patient = new Patient;
        $new_patient->name_ar = $request->input('name_ar');
        $new_patient->name_en = $request->input('name_en');
        $new_patient->img = $fileName;
        $new_patient->save();

        
        
        session()->flash('success', __('تم الإضافة'));
        return redirect(route('admin.patient.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $record = $this->model->findOrFail($id);
        $edit = true;
        return $this->view('edit', compact('record', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'img'        => 'required',

        ];
        $messages = [
            'name_ar.required'        => 'الاسم مطلوب',
            'name_en.required'        => 'الاسم مطلوب',
            'img.required'        => 'الصورة مطلوب',
        ];
        $this->validate($request, $rules, $messages);

        $fileName = time() . '.' . $request->file('img')->extension();
        $request->file('img')->storeAs('public/images', $fileName);
        $new_patient = Patient::findOrFail($id);
        $new_patient->name_ar = $request->input('name_ar');
        $new_patient->name_en = $request->input('name_en');
        $new_patient->img = $fileName;
        $new_patient->update();

        
        
        session()->flash('success', __('تم التعديل'));
        return redirect(route('admin.patient.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // dd($id);
        $record = $this->model->find($id);

        if (!$record) {
            return response()->json([
                'status'  => 0,
                'message' => __('تعذر الحصول على البيانات')
            ]);
        }


        $record->delete();

        session()->flash('success', __('تم الحذف'));
        return redirect(route('admin.patient.index'));

    }
}
