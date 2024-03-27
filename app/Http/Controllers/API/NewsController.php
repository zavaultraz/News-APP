<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        try {
            $news = News::latest()->get();
            return ResponseFormatter::success(
                $news,
                'Data list news berhasil diambil'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
    public function  show($id)
    {
        try {
            //get data by id
            $news  = News::find($id);
            return ResponseFormatter::success(
                $news,
                'Data news berhasil di ambil'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
    public function store(Request $request)
    {
        try {
            //validate
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                'category_id' => 'required',
                'image' => 'required|image:jpg,png,jpeg,gif,svg|max:5048',
            ]);
            //UPLOAD IMAGE
            $image = $request->file('image');
            $image->storeAs('public/news', $image->hashName());
            //create data
            $news = News::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'image' => $image->hashName(),
                'slug' => Str::slug($request->title)

            ]);

            return  ResponseFormatter::success([$news], "News Berhasil Ditambahkan");
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
    public function destroy($id)
    {
        try {
            //get data by id
            $news = News::findorFail($id);
            //delate image
            Storage::disk('local')->delete('public/news/' . basename($news->image));
            // delete category
            $news->delete();
            return ResponseFormatter::success(null, 'Deleted');
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
    public function update(Request $request, $id){
    try {
        //validate
        $this->validate($request,[
            'title'=>'required',
            'category_id'=>'required',
            'content'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg|max:10004'
        ]);
        // get data by id 
        $news = News::findOrFail($id);
        if ($request->file('image')=='') {
            $news->update([
                'title'       =>   $request->title,
                'content'     =>   $request->content,
                'slug'        =>   Str::slug($request->title),
                'category_id' =>   $request->category_id
            ]);
        }else{
            //delete old image
            Storage::disk('local')->delete('public/news/' . basename($news->image));
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/news', $image->hashName());
            //update     dengan image baru
            $news->update([
                'title'      =>  $request->title,
                'content'    =>  $request->content,
                'image'      =>  $image->hashName(),
                'slug'       =>  Str::slug($request->title),
                'category_id'=>  $request->category_id
            ]);
        
        }
        //return response
        return ResponseFormatter::success([$news], "News Updated", 200);
    } catch (\Exception $error) {
        return ResponseFormatter::error([
            'message' => 'Something went wrong',
            'error' => $error
        ], 'Authentication Failed', 500);
    }
    }
}
