<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //get al category
    public function index()
    {
        try {
            $category = Category::latest()->get();
            return ResponseFormatter::success(
                $category,
                'Data list of categories berhasil diambil'
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
            $category  = Category::find($id);
            return ResponseFormatter::success(
                $category,
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
                'name' => 'required|unique:categories',
                'image' => 'required|image|mimes:jpeg,jpg,png|max:6600'
            ]);
            // store image
            $image = $request->file('image');
            $image->storeAs('public/category', $image->hashName());
            //store data
            $category = Category::create([
                'name' => $request->name,
                'image' => $image->hashName(),
                'slug' => Str::slug($request->name)
            ]);
            return ResponseFormatter::success([
                $category, 'Data category Berhasil ditambahkan'
            ]);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            //validate
            $this->validate($request,[
                'name' => 'required|unique:categories',
                'image' => 'image|mimes:jpeg,jpg,png|max:6600'
            ] );
            //get data by id
            $category = Category::findOrFail($id);
            //store image
            if ($request->file('image')=='') {
                $category->update([
                    'name'=>$request->name,
                    'slug'=>Str::slug($request->name)
                ]);
            }else{
                //delate old img
                Storage::disk('local')->delete('public/category/' . basename($category->image));
                $image =  $request->file('image');
                $image->storeAs('public/category/', $image->hashName());
                //update data
                $category->update([
                    'name' => $request->name,
                    'image' => $image->hashName(),
                    'slug' => Str::slug($request->name)
                ]);
            }
            return ResponseFormatter::success([
                $category, 'Data category Berhasil di update'
            ]);
            
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
