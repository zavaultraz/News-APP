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
        $newsSideNews = News::where('category_id')->limit(10)->get();
        //get data category
        $sliderNews = News::latest()->limit(3)->get();
        $category= Category::latest()->get();
        // get data news by category
   
        return view('frontend.news.index',compact('title', 'category', 'sliderNews', 'newsSideNews'));
    }
}
