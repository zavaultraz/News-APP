<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //get al category
    public function index(){
        try {
            $category=Category::latest()->get();
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
    public function  show($id){
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
}
