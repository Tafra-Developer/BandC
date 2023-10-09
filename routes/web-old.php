<?php

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


Route::get('/clear', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');

    return 'done';
});

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::group([
    'namespace' => 'front', 'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/', 'FrontController@index')->name('home');
    // NEW STUFF
    Route::get('/home', 'FrontController@index')->name('home');
    Route::get('/contact', 'FrontController@contact')->name('contact');
    Route::get('/about', 'FrontController@about')->name('about');
    Route::get('/test-table', function () {
        return view('index');
    });

    Route::get('/posts', 'FrontController@posts');
    Route::get('/post/{slug}', 'FrontController@showPost');
    Route::get('/products', 'FrontController@products')->name('products');
    Route::get('/project/{slug}', 'FrontController@showProject');
});



Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth:web', 'is_active', 'auto-check-permission']], function () {

    Route::get('home', 'ProductController@index');

    Route::get('reset-password', 'resetPasswordController@index');
    Route::post('reset-password', 'resetPasswordController@reset');


    Route::resource('categories', 'CategoryController');
    Route::get('categories/activation/{id}', 'CategoryController@activation')->name('categories.categories_activation');

    Route::resource('job-types', 'JobTypeController');


    Route::resource('tag', 'TagController');


    Route::resource('products', 'ProductController');
    Route::get('products/activation/{id}', 'ProductController@activation')->name('products.products_activation');


    Route::resource('posts', 'PostController');
    Route::get('posts/activation/{id}', 'PostController@activation')->name('posts.posts_activation');


    Route::resource('sliders', 'SliderController');
    Route::get('sliders/activation/{id}', 'SliderController@activation')->name('sliders.sliders_activation');


    Route::resource('services', 'ServiceController');
    Route::get('services/activation/{id}', 'ServiceController@activation')->name('services.services_activation');


    Route::resource('services.feature', 'ServiceFeatureController');


    Route::resource('projects', 'ProjectController');
    Route::get('projects/activation/{id}', 'ProjectController@activation')->name('projects.projects_activation');


    Route::resource('jobs', 'JobController');
    Route::get('jobs/activation/{id}', 'JobController@activation')->name('jobs.jobs_activation');


    Route::resource('pages', 'PageController');
    Route::get('pages/activation/{id}', 'PageController@activation')->name('pages.pages_activation');


    Route::resource('customers', 'CustomerController');
    Route::get('customers/activation/{id}', 'CustomerController@activation')->name('customers.customers_activation');


    Route::resource('contacts', 'ContactController');
    Route::get('contacts/is-read/{id}', 'ContactController@is_read');

    Route::resource('developer/setting', 'DeveloperSetting');


    Route::resource('roles', 'RoleController');

    Route::get('settings', 'SettingController@view')->name('settings_get');
    Route::post('settings', 'SettingController@update')->name('settings_post');

    Route::resource('users', 'AdminController');
    Route::get('users/activation/{id}', 'AdminController@activation')->name('users.users_activation');


    Route::resource('testimonial', 'TestimonialsController');
});
Auth::routes(['register' => false]);

// Route::get('register', function () {
//    return redirect('login');
// });
