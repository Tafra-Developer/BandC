<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\my_helper\Helper;
use Illuminate\Http\Request;
use Response;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::where(function ($q) use ($request) {

            if ($request->sms) {
                $q->where('id',$request->sms);
            }

            if ($request->name) {
                $q->where(function ($q) use ($request) {

                    $q->where('name', 'LIKE', '%' . $request->name . '%');
                });
            }
            if ($request->phone) {
                $q->where(function ($q) use ($request) {

                    $q->where('phone', 'LIKE', '%' . $request->phone . '%');
                });
            }
            if ($request->email) {
                $q->where(function ($q) use ($request) {

                    $q->where('email', 'LIKE', '%' . $request->email . '%');
                });
            }

            if ($request->from) {
                $q->whereDate('created_at', '>=', Helper::convertDateTime($request->from));
            }

            if ($request->to) {
                $q->whereDate('created_at', '<=', Helper::convertDateTime($request->to));
            }


        })->latest()->paginate(20);

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $record = Contact::findOrFail($id);

        $record->update(['is_read' => 1]);

        return Response::json($record, 200);
    }

    public function show()
    {
        $record = Contact::where('is_read' , 0)->where('jq' , 0)->latest()->get();
        Contact::where('jq' , 0 )->update(['jq' => 1]);

        $number = count(Contact::where('is_read' , 0)->get());


        if(count($record))
        {
            $data = [
                'status' => 1,
                'msg' => 'تم الحذف بنجاح',
                'data' => $record,
                'sms_number' => $number
            ];
            return Response::json($data, 200);
        }else
        {
            $data = [
                'status' => 0,
                'msg' => 'تم الحذف بنجاح',

            ];
            return Response::json($data, 200);
        }

    }


    public function destroy($id)
    {
        $record = Contact::findOrFail($id);

        $record->delete();
        $data = [
            'status' => 1,
            'msg' => 'تم الحذف بنجاح',
            'id' => $id
        ];

        return Response::json($data, 200);
    }


    public function is_read($id)
    {
        $record = Contact::findOrFail($id);
        $record->jq = 1;
        $record->save();
        $helper = Helper::is_read($record);

        if($helper)
        {
            $data = [
                'status' => 1,
                'msg' => 'تم الحذف بنجاح',
                'id' => $id
            ];
            return Response::json($data, 200);
        }else
        {
            $data = [
                'status' => 0,
                'msg' => 'تم الحذف بنجاح',
                'id' => $id
            ];
            return Response::json($data, 200);
        }


    }


}
