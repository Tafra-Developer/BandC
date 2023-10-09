<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    protected $model;
    protected $viewsDomain = 'admin.admins.';

    public function __construct()
    {
        $this->model = new Admin();

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
                $query->where('name', 'LIKE', '%' . $request->name . '%');
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
        $record = new Admin();
        $roles = Role::all();

        return $this->view('create', compact('record', 'roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $request->merge(['password' => bcrypt($request->password)]);
        $user = $this->model->create($request->all());
        $user->assignRole($request->roles);

        session()->flash('success', __('تم الإضافة'));

        return redirect()->route('admin.admins.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $record)
    {
        return $this->view('show', compact('record'));

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

        return $this->view('edit', compact('record'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($request->except('password'));

        if ($request->password) {
            $record->update(['password' => bcrypt($request->password)]);
        }
        session()->flash('success', __('تم التعديل'));

        return redirect()->route('admin.admins.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id, $status)
    {
        $record = $this->model->findOrFail($id);
        $record->update(['is_active' => $status]);

        return response()->json(['msg' => 'done']);
    }
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        session()->flash('success', __('تم الحذف'));

        return redirect()->route('admin.admins.index');

    }

}
