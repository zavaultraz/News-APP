<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $title="Home";
        //get data category
        $category= Category::latest()->get();
        // get data news by category
        $categoryNews = News::with('category')->latest()->get();
        return view('frontend.news.index',compact('title', 'category','categoryNews'));
    }
}
