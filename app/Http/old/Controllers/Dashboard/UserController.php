<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Userold;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    protected $model;
    protected $viewsDomain = 'admin.user.';

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * @param $view
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = $this->model->where(function ($query) use ($request) {
            if ($request->name) {
                $query->where('first_name', 'LIKE', '%' . $request->name . '%');
            }
            if ($request->phone) {
                $query->where('phone', 'LIKE', '%' . $request->phone . '%');
            }
            if ($request->status) {
                $query->where('status', 'LIKE', '%' . $request->status . '%');
            }
        })->paginate(10);

        $totalRecords = $records->count();
        return $this->view('index', compact('records', 'totalRecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = $this->model->findOrFail($id);
        $records = $record->ads()->paginate(10);
        $totalRecords = $records->count();

        return $this->view('show', compact('record', 'records', 'totalRecords'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'confirmed',
            'phone' => 'required',
            'email' => 'required|email',
        ];

        $data = validator()->make($request->all(), $rules);
        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = $this->model->findOrFail($id);
        $record->update($request->except('password'));

        if ($request->password) {
            $record->update(['password' => bcrypt($request->password)]);
        }
        session()->flash('success', __('تم التعديل'));
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record2 = Userold::findOrFail($id);
        $record->delete();
        $record2->delete();
        session()->flash('success', __('تم الحذف'));
        return redirect()->route('admin.user.index');
    }


    public function status($id, $status)
    {
        $record = $this->model->findOrFail($id);
        $record->update(['is_active' => $status]);

        return response()->json(['msg' => 'done']);
    }

    public function requestConfirmation($id, Request $request)
    {
        $record = $this->model->findOrFail($id);
        $record->update([
            'status' => $request->status
        ]);
        session()->flash('success', __('تم التعديل'));
        return redirect()->route('admin.user.index');
    }
}
