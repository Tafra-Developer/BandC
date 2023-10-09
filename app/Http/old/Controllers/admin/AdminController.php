<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use \Spatie\Permission\Models\Role;
use App\my_helper\Helper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where(function ($q) use ($request) {
            if ($request->name) {
                $q->where(function ($q) use ($request) {

                    $q->where('name', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->name . '%');
                });
            }
            if ($request->role_name) {

                $q->whereHas('roles', function ($q) use ($request) {

                    $q->where('display_name', 'LIKE', '%' . $request->role_name . '%');
                });
            }

            if ($request->from) {
                $q->whereDate('created_at', '>=', Helper::convertDateTime($request->from));
            }

            if ($request->to) {
                $q->whereDate('created_at', '<=', Helper::convertDateTime($request->to));
            }
        })->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $model = new User();
        $roles = Role::all();

        return view('admin.users.create', compact('model', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules =
            [
                'name'           => 'required',
                'email'           => 'required|email|unique:users',
                'password'           => 'required|confirmed',
                'roles.*'           => 'required|exists:roles,id',
            ];

        $error_sms =
            [
                'name.required' => 'الرجاء ادخال الاسم ',
                'email.unique' => ' البريد الالكتروني موجود بالفعل',
                'email.required' => 'الرجاء ادخال البريد الالكتروني',
                'password.required' => 'الرجاء ادخال كلمة المرور',
                'password.confirmed' => 'الرجاء التاكد من كلمة المرور ',

            ];

        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }
        $user = User::create(request()->all());

        $user->update(['password' => Hash::make($request->password)]);

        $user->assignRole($request->roles);
        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('model', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $record = User::findOrFail($id);

        $rules =
            [
                'name'           => 'required',
                'email'           => 'required|email|unique:users,email,' . $record->id . '',
                'password'           => 'confirmed',
                'roles.*'           => 'required|exists:roles,id',
            ];

        $error_sms =
            [
                'name.required' => 'الرجاء ادخال الاسم ',
                'email.required' => 'الرجاء ادخال البريد الالكتروني',
                'email.unique' => ' البريد الالكتروني موجود بالفعل',
                'password.confirmed' => 'الرجاء التاكد من كلمة المرور ',

            ];
        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return redirect('/admin/users/' . $id . '/edit')->withInput()->withErrors($data->errors());
        }



        $record->update($request->except('password'));

        if ($request->has('password')) {
            $record->update(['password' => Hash::make($request->password)]);
        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $record->assignRole($request->roles);

        session()->flash('success', 'تم التعديل بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::findOrFail($id);

        if (auth('web')->user()->id == $record->id) {
            session()->flash('fail', 'هذا البريد الالكتروني الخاص بك لا يمكنك حذفه');
            return redirect('admin/users');
        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();
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
        $record = User::findOrFail($id);

        if (auth('web')->user()->id == $record->id) {
            session()->flash('fail', 'هذا البريد الالكتروني الخاص بك لا يمكنك الغاء تفعيله');
            return redirect('admin/users');
        }
        $activate = Helper::activation($record);

        if ($activate) {
            session()->flash('success', 'تمت العملية بنجاح');
            return redirect('admin/users');
        }


        session()->flash('fail', 'حدث خطأ ما الجاء المحاوله مره اخري');
        return redirect('admin/users');
    }

    public function home()
    {
        return view('admin.products.index');
    }
}
