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

    public function detailNews($slug){
        $category=Category::latest()->get();
        //get data news
        $news = News::where('slug', $slug )->first();
        return view('frontend.news.detail', compact('category','news'));
    }
    public function detailCategory($slug){
    //  datail/category{slug}
    // 
        $category=Category::latest()->get();
   
        $detailCategory = Category::where('slug', $slug)->first();

        $news = News::where('category_id',$detailCategory->id)->latest()->get();
        return view('frontend.news.detail-category', compact('category','detailCategory','news'));
    }
}
