<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 15; // Default is 1
    // needs to be reviewed
    public function viewLogin()
    {
        return view('admin.auth.login');
    }


    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required'
        ];

        $message = [
            'email.required' => 'البريد الإلكترني مطلوب',
            'email.email' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'email.exists' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'password.required' => 'كلمة المرور مطلوبة'
        ];


        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        } else {
            $remember = $request->input('remember') && $request->remember == 1 ? $request->remember : 0;
            if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                return back();
            } else {
                return back()->withInput()->withErrors(['email' => 'خطأ في البريد الإلكتروني أو كلمة المرور']);
            }
        }
    }
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return back();
    }


    public function home()
    {
        return view('admin.layouts.home');
    }

    public function update($id, Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required',
            'name' => 'required'
        ];

        $message = [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكترني مطلوب',
            'email.email' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'email.exists' => 'البريد الاكتروني غير مسجل بقواعد البيانات',
            'password.required' => 'كلمة المرور مطلوبة'
        ];
        $this->validate($request, $rules, $message);
        $request->merge(['password' => bcrypt($request->password)]);
        $record = Admin::findorfail($id);
        $record->update($request->all());
        session()->flash('success', __('تم التعديل'));
        return redirect(route('admin.index'));
    }

    public function edit($id)
    {
        $record = Admin::findOrFail($id);
        $edit = true;

        return view('admin.auth.edit', compact('record', 'edit'));
    }
}
