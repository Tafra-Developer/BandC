<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $records = Contact::where(function ($query) use ($request) {
            if ($request->name) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            }
        })->paginate(10);
        $totalRecords = $records->count();

        return view('admin.contact', compact('records', 'totalRecords'));
    }

    public function store(Request $request)
    {

        $rules = [
            'name'        => 'required',
            'phone'        => 'required',
            'email'        => 'required',
            'notes'        => 'required',
            'category_id'   => 'required',
            'date'        => 'required',

        ];
        $messages = [
            'name.required'        => 'مطلوب',
            'phone.required'        => 'مطلوب',
            'email.required'        => 'مطلوب',
            'notes.required'        => 'مطلوب',
            'category_id.required'        => 'مطلوب',
            'date.required'        => 'مطلوب',
        ];
        $data = $this->validate($request, $rules, $messages);

        Contact::create($data);
        session()->flash('success', __('تم الإضافة'));

        return redirect('/');
    }
}
