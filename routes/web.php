<?php

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\HomeController;


// use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\UserController;
// use App\Http\Controllers\Dashboard\OfferController;
use App\Http\Controllers\Dashboard\ContactController;
// use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\SettingController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	Route::get('/', function()
	{
		return View::make('hello');
	});

	Route::get('test',function(){
		return View::make('test');
	});
});
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect']
], function () {


    Route::get('locale/{locale}', function ($locale) {
        Session::put('locale', $locale);
        return redirect()->back();
    });

    Route::get('/', function () {

        $url = 'https://clients.tafraa.com/api/clients';
        $user = 'B&C';
        $st = 'true';

        $response = file_get_contents($url);
        $newsData = json_decode($response);
        foreach($newsData as $client)
        {
            if($client->name == $user && $client->status == $st )
            {
                return view('front.index');
            }
            else
            {
                return view('front.m3fn');

            }
        }


    })->name('client.home');

    Route::get('page/{page}', [\App\Http\Controllers\Dashboard\PageController::class, 'page'])->name('client.page');

    Route::get('before-after', [\App\Http\Controllers\Dashboard\PatientController::class, 'page'])->name('client.before-after');

    Route::post('contact', [ContactController::class, 'store'])->name('client.contact');

    Route::get('/admin', function () {

        return redirect()->route('admin.login');
    });

    Route::get('/booking', function () {
    return view('front.booking');
})->name('booking');



    Route::group(['as' => 'admin.', 'prefix' => 'dashboard'], function () {

        Route::group(['middleware' => 'guest:admin'], function () {
            Route::get('login', [AuthController::class, 'viewLogin'])->name('viewLogin');
            Route::post('login', [AuthController::class, 'login'])->name('login');
        });
        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('/', [HomeController::class, 'index'])->name('index');
            Route::get('/contact', [ContactController::class, 'index'])->name('contact');
            Route::post('logout', [AuthController::class, 'adminLogout'])->name('logout');
            Route::get('settings/create', [SettingController::class, 'getSettings'])->name('settings.create');
            Route::put('settings/create', [SettingController::class, 'setSettings'])->name('settings.update');
            Route::get('user/update-status/{id}/{status}', [UserController::class, 'status']);

            // Firebase
            // Route::get('/push-notificaiton', [WebNotificationController::class, 'index'])->name('push-notificaiton');
            // Route::post('/store-token', [WebNotificationController::class, 'storeToken'])->name('store.token');
            // Route::post('/send-web-notification', [WebNotificationController::class, 'sendWebNotification'])->name('send.web-notification');
            // Route::resource('role', RoleController::class);
            Route::get('user/update/{id}', [AuthController::class, 'edit'])->name('user.settings');
            Route::post('user/update/{id}', [AuthController::class, 'update']);

            Route::get('offer/update-status/{id}/{status}', [\App\Http\Controllers\Dashboard\OfferController::class, 'status']);

            Route::group(['namespace' => '\App\Http\Controllers\Dashboard'], function () {
                Route::resources([
                    'category' => CategoryController::class,
                    'page' => PageController::class,
                    'patient' => PatientController::class,
                    'doctor' => DoctorController::class,
                    'device' => DeviceController::class,
                    'offer' => OfferController::class,
                    'contact' => ContactController::class,

                ]);
            });
        });
    });
});
