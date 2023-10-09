<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Helper\Helper;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public $helper;
    public $model;

    public function __construct()
    {
        $this->helper = new Helper();
        $this->model = new User();
    }

    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->balance = $user->balance + $request->balance;
        $user->save();
        $data = [
            'balance' => $user->balance,
        ];
        return Helper::responseJson(200, 'successfully', $data);

    }
}
