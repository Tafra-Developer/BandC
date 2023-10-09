<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Helper\Attachment;
use Helper\Helper;
use Illuminate\Http\Request;

class AdController extends Controller
{

    public function index()
    {

    }

    public function store(Request $request)
    {

        $morph = [];
        $user = auth()->user();
        $reflection_class = new \ReflectionClass($user);
        $morph['user_type'] = $reflection_class->getName();
        $morph['user_id'] = $user->id;

        if ($request->has('brand_id') && $request->brand_id != null) {
            $morph['category_type'] = "App\Models\Brand";
            $morph['category_id'] = $request->brand_id;
        } else {
            $morph['category_type'] = "App\Models\Category";
            $morph['category_id'] = $request->category_id;
        }

        $request->merge($morph);
        $request->merge(['type' => 'normal']);
        $record = Ad::create($request->only(
            'title_ar',
            'title_en',
            'description_ar',
            'description_en',
            'price',
            'category_type',
            'category_id',
            'user_type',
            'user_id',
            'city_id',
            'whatsapp',
            'phone',
            'lat',
            'long',
            'show_name',
            'contact_way',
            'type'
        ));

        if (!empty($request->attach)) {
            if (is_array($request->attach)) {
                foreach ($request->attach as $attach) {
                    Attachment::addAttachment($attach, $record, 'ads/attach', ["type" => "files"]);
                }
            } else {
                Attachment::addAttachment($request->file('attach'), $record, 'ads/attach', ["type" => "files"]);
            }
        }
        return Helper::responseJson(200, 'Ad created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
