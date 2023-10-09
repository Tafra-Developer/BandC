<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
class resetPasswordController extends Controller
{
    public function index()
    {

        return view('admin.reset_password.index');
    }

    public function reset(Request $request)
    {
        $rules =
            [

                'old_password' => 'required',
                'password' => 'required|confirmed',

            ];

        $error_sms =
            [
                'old_password.required'=>'الرجاء ادخال كلمة المرور الحالية ',
                'password.required'=>'الرجاء ادخال كلمة المرور الجديدة',
                'password.confirmed'=>'الرجاء التاكد من كلمة المرور الجديدة',
                'thumbnail.required'=>'الرجاء ادخال الصورة',
                'thumbnail.image'=>'الرجاء ادخال الصورة',
                'thumbnail.mimes'=>'صيغة الصورة غير مقبولة',

            ];
        $validator = validator()->make($request->all() , $rules , $error_sms);

        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator->errors());
        }

        if(Hash::check($request->old_password , auth()->user()->password))
        {
            auth()->user()->update(['password'=>Hash::make($request->password)]);


            session()->flash('success' , 'تمت تحديث بنجاح');
            return redirect('admin/reset-password');

        }else{
            $errors = ['old_password' => 'الرجاء ادخال كلمة المرور الحالية '];
            return redirect('admin/reset-password')->withInput()->withErrors($errors);
        }

    }
}
