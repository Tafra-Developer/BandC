<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSettings()
    {

        $records = Setting::where('page', request('page'))->get();
        return view('admin.settings.create', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setSettings(Request $request)
    {

        foreach($request->except(['_token','_method']) as $key => $value){
            $setting = Setting::where('key', $key)->first();
            $setting->update([
                'value' => $value
            ]);
        }
        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }


}
