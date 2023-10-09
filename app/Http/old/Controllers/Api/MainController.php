<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdRescource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\HomeAdRescource;
use App\Http\Resources\HomeCategoryResource;
use App\Models\Ad;
use App\Models\Category;
use Helper\Helper;

class MainController extends Controller
{
    public $helper;

    public function __construct()
    {
        $this->helper = new Helper();
        if (array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
            $this->middleware('auth:api');
        }
    }

    public function category(Category $category = null)
    {
        if ($category) {

            return Helper::responseJson(200, 'Category retrieved successfully', new CategoryResource($category));
        } else {
            $categories = Category::whereIn('category_id', [0, null])->where('type', 'normal')->paginate(10);
            return Helper::responseJson(200, 'Categories retrieved successfully', CategoryResource::collection($categories));
        }
    }
    public function ad(Ad $ad = null)
    {
        if ($ad) {
            return Helper::responseJson(200, 'Ad retrieved successfully', new AdRescource($ad));
        } else {
            $ads = Ad::where('type', 'normal')->paginate(10);
            return Helper::responseJson(200, 'Ads retrieved successfully', AdRescource::collection($ads));
        }
    }

    public function homePage(Category $category)
    {
        $category = Category::whereType('normal')->where('category_id', null)->limit(8)->get();
        $tojaryAds = Ad::whereType('tojary')->limit(5)->get();
        $personalAds = Ad::whereType('normal')->limit(5)->get();

        return $this->helper->responseJson(1, 'home retrieved successfully.', [
            'category' => HomeCategoryResource::collection($category),
            'tojaryAds' => HomeAdRescource::collection($tojaryAds),
            'personalAds' => HomeAdRescource::collection($personalAds),
        ]);
    }
}
