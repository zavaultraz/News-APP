<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //title halaman index
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $title = 'Category - index';
        //mengurutkan data berdasarkan data terbaru
$category = Category::Latest()->paginate(5); 
        return view('category.index',compact( 'category', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Category - Create';
        return view('category.create',compact( 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:220',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2000',

        ]);
 //upload
 $image=$request->file('image');
 //menyimpan image yang  di upload ke folder storage/app/public/category
 //fungsi hasname untuk generate nama unik
 //fungsi getClientOriginal Name
 //itu menggunakan nama asli dari image
 $image->storeAs('public/category', $image->hashName());

//melakkukan save to database
Category::create([
    'name'=>$request->name,
    'slug'=>Str::slug($request->name),
    'image'=>$image->hashName(),
]);
//melakukan return redirect
return redirect()->route('category.index')->with('success', 'Mantap data Berhasil Di Tambahkan! 👍');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Category - edit';
        $category = Category::findOrFail($id);
        return view ('category.edit', compact('title','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|max:220',
            'image'=>'image|mimes:jpeg,png,jpg|max:2000',
        ]);
        // get data by id
        $category = Category::findOrFail($id);
        //jika  image kosong
        if ($request->image==''){
            $category->update([
                'name'=>$request->name,
                'slug'=>Str::slug($request->name),
            ]);
            return redirect()->route('category.index') ->with(['succes' => 'data kehapus']);
        }else{
            // jika image tidak kosong
            //hapus image lama
            Storage::disk('local')->delete('public/category/'.basename($category->image));
            //upload gambar yang baru
            $image =  $request->file('image');
            $image->storeAs('public/category/', $image->hashName());
            //update data
            $category->update([
                'name'=>$request->name,
                'image'=>$image->hashName(),
                'slug'=>Str::slug($request->name)]);
        }
        return redirect()->route('category.index') -> with(['success' => 'Data telah diubah 😁']);
        }
         /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //get data by id
    $category=Category::findOrFail($id);    
    // delete data
    Storage::disk('local')->delete('public/category/'.basename($category->image));
    //delete data by id
    $category->delete();
  	//redirect
    return redirect()->route('category.index') -> with(['error' => 'Data telah dihapus 👋']);
    }
    }

   


