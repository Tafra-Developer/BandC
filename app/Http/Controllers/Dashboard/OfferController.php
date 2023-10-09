<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Support\Facades\Storage;


class OfferController extends Controller
{
    protected $model;
    protected $viewsDomain = 'admin.offer.';

    public function __construct()
    {
        $this->model = new Offer();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }
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

    public function status($id, $status)
    {
        $record = $this->model->findOrFail($id);
        $record->update(['is_active' => $status]);

        return response()->json(['msg' => 'done']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $record = $this->model->get();
        return $this->view('create', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'content_ar'        => 'required',
            'content_en'        => 'required',
            'price'        => 'required',
            'category_id'        => 'required',
            'img'        => 'required',

        ];
        $messages = [
            'name_ar.required'        => 'مطلوب',
            'name_en.required'        => 'مطلوب',
            'content_ar.required'        => 'مطلوب',
            'content_en.required'        => 'مطلوب',
            'price.required'        => 'مطلوب',
            'category_id.required'        => 'مطلوب',
            'img.required'        => 'مطلوب',
        ];
        $data = $this->validate($request, $rules, $messages);
        $fileName = time() . '.' . $request->file('img')->extension();
        $request->file('img')->storeAs('public/images', $fileName);
        $new_offer = new Offer;
        $new_offer->name_ar = $request->input('name_ar');
        $new_offer->name_en = $request->input('name_en');
        $new_offer->content_ar = $request->input('content_ar');
        $new_offer->content_en = $request->input('content_en');
        $new_offer->price = $request->input('price');
        $new_offer->img = $fileName;
        $new_offer->category_id = $request->input('category_id');
        $new_offer->save();

        session()->flash('success', __('تم الإضافة'));
        return redirect(route('admin.offer.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $record = $this->model->findOrFail($id);
        $edit = true;
        return $this->view('edit', compact('record', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'content_ar'        => 'required',
            'content_en'        => 'required',
            'price'        => 'required',
            'category_id'        => 'required',
            'img'        => 'required',

        ];
        $messages = [
            'name_ar.required'        => 'مطلوب',
            'name_en.required'        => 'مطلوب',
            'content_ar.required'        => 'مطلوب',
            'content_en.required'        => 'مطلوب',
            'price.required'        => 'مطلوب',
            'category_id.required'        => 'مطلوب',
            'img.required'        => 'مطلوب',
        ];
        $this->validate($request, $rules, $messages);



        $fileName = time() . '.' . $request->file('img')->extension();
        $request->file('img')->storeAs('public/images', $fileName);
        $new_offer = Offer::findOrFail($id);
        $new_offer->name_ar = $request->input('name_ar');
        $new_offer->name_en = $request->input('name_en');
        $new_offer->content_ar = $request->input('content_ar');
        $new_offer->content_en = $request->input('content_en');
        $new_offer->price = $request->input('price');
        $new_offer->img = $fileName;
        $new_offer->category_id = $request->input('category_id');

        $new_offer->update();
        
           
        
        
        session()->flash('success', __('تم التعديل'));
        return redirect(route('admin.offer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // dd($id);
        $record = $this->model->find($id);

        if (!$record) {
            return response()->json([
                'status'  => 0,
                'message' => __('تعذر الحصول على البيانات')
            ]);
        }


        $record->delete();


        session()->flash('success', __('تم الحذف'));
        return redirect(route('admin.offer.index'));
    }
}
