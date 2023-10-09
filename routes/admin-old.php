<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\OfferController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\DoctorsController;
use App\Http\Controllers\Dashboard\DeviceController;


Route::group(['as' => 'admin.'], function () {

    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('login', [AuthController::class, 'viewLogin'])->name('viewLogin');
        Route::post('login', [AuthController::class, 'login'])->name('login');
    });
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::get('/doctor', [DoctorsController::class, 'index'])->name('doctor');
        Route::get('/device', [DeviceController::class, 'index'])->name('doctor');
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

        Route::get('offer/update-status/{id}/{status}', [OfferController::class, 'status']);

        Route::resources([
            'category' => 'CategoryController',
            'page' => 'PageController',
            'patient' => 'PatientController',
            'offer' => 'OfferController',
            'contact'=> 'ContactController',
            'doctor' => 'DoctorController',


            // '/admins' => 'AdminController',
            // '/offer-shop' => 'OfferShopController',
            // '/offer-order' => 'OfferOrderController',
            // '/b-category' => 'Category1Controller',
            // '/brand' => 'BrandController',
            // '/b-brand' => 'BrandController',
            // '/b-ad' => 'AdController',
            // '/ad' => 'AdController',
            // '/article' => 'ArticleController',
            // '/service' => 'ServiceController',
            // '/question' => 'QuestionController',
            // '/user' => 'UserController',
            // '/reports' => 'ReportController',
            // '/government' => 'GovernmentController',
            // '/seo' => 'SeoController',
            // '/offer-category' => 'OfferCategoryController',
        ]);
    });
});
