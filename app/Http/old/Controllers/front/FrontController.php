<?php

namespace App\Http\Controllers\front;

use App\Models\Post;
use App\Models\Option;
use App\Models\Product;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public $viewsDomain;

    public function __construct()
    {
        $this->viewsDomain = config('cms.viewDomain');
    }

    private function view($view, $params = [])
    {
        $setting = Option::all();
        $settings = [];
        foreach ($setting as $set) {
            $settings += [$set->key => $set->value];
        }
        $params += ['settings' => $settings];

        return view($this->viewsDomain . $view, $params);
    }

    public function index()
    {
        $products = Product::where('activation', 1)
            ->latest()
            ->paginate(6);
        return $this->view('layouts.home', compact('products'));
    }

    public function posts()
    {
        $posts = Post::where('activation', 1)
            ->latest()
            ->paginate(6);
        return $this->view('posts', compact('posts'));
    }

    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if ($post && $post->activation == 0) {
            return back();
        }
        return $this->view('post', compact('post'));
    }
    public function products()
    {
        $products = Product::where('activation', 1)->latest()->paginate(9);
        return $this->view('products', compact('products'));
    }

    public function contact()
    {
        return $this->view('contact');
    }

    public function about()
    {
        return $this->view('about');
    }

    public function showProject($slug)
    {
        $project = Project::where('slug', $slug)->first();
        if ($project && $project->activation == 0) {
            return back();
        }
        return $this->view('project', compact('project'));
    }
}
