<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\my_helper\SettingField;
use Illuminate\Http\Request;



class SettingController extends Controller
{
    public function view()
    {
        $settings = Option::all();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {

        $settings = Option::all();

        $data = validator()->make($request->all() , SettingField::validation($settings) );

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        foreach ($settings as $setting)
        {
            $setting->update(
                [
                    'value' => $request[$setting->key]
                ]);
        }


        session()->flash('success' , 'تمت التعديل بنجاح');
        return redirect('admin/settings');
    }
}
