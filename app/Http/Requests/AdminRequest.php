<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

       $rules=[
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:admins,email',
        'password' => 'required|string|min:8|confirmed',
        'phone' => 'nullable|min:10|unique:admins,phone',
       ];
       if( in_array("PUT", request()->route()->methods) ){
        $rules['email']='required|string|email|max:255|unique:admins,email,'.request('admin');
              $rules['password']='nullable|string|min:8|confirmed';
              $rules['phone']='nullable|min:10|unique:admins,phone,'.request('admin');
         }
        return $rules;
    }
}
