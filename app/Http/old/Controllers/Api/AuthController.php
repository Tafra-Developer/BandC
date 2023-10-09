<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $helper;
    public $model;

    public function __construct()
    {
        $this->helper = new Helper();
        $this->model = new User();
    }

    public function register(Request $request)
    {

        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'nullable|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
            'fcm_token' => 'nullable',
            'country_code' => 'nullable',
        ];
        $data = validator()->make($request->all(), $rules);
        if ($data->fails()) {
            return $this->helper->responseJson(0, $data->errors()->first());
        }
        $request->merge([
            'password' => bcrypt($request->password),
            'status' => 'pending',
            'otp' => 1234,
        ]);
        $user = User::create($request->all());
        return Helper::responseJson(200, 'OTP send successfully');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->status == 'pending') {
                return Helper::responseJson(401, 'plese validate phone first');
            }

            if ($user->is_active != 1) {
                return Helper::responseJson(401, 'your account is banned');
            }

            $user->fcm_token = $request->fcm_token;
            $user->save();

            $token = $user->createToken('MyLaravelApp')->accessToken;

            $data = ['token' => $token, 'user' => $user];

            return Helper::responseJson(200, 'login successfully', $data);
        } else {
            return Helper::responseJson(401, 'phone or password is not correct');
        }
    }

    public function checkotp(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if ($user && $user->otp == $request->otp) {
            $user->otp = null;
            $user->status = 'accepted';
            $user->save();
            $token = $user->createToken('MyLaravelApp')->accessToken;
            $data = ['token' => $token, 'user' => $user];
            return Helper::responseJson(200, 'successfully', $data);
        } else {
            return Helper::responseJson(401, 'otp is not correct');
        }
    }

    public function logout()
    {
        /**
         * @var \App\Models\Client $user
         **/
        $user = auth()->guard('api')->user()->token();
        $user->revoke();

        return Helper::responseJson(1, 'logout success');
    }
}
