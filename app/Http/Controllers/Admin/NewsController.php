<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'News - index';
        // get data baru terbaru darii tabel news
        $news = News::latest()->paginate(5);  // mengambil semua isi tabel news dan diurutkan secara latest (terbaru)
        $category = Category::all();   // menampilkan semua data yang ada didalam table category
        //mengurutkan data berdasarkan data terbaru

        return view('home.news.index', compact('title', 'news', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "News - index";
        //model category
        $category = Category::all();
        return view('home.news.create', compact('title', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'title' => 'required|min:1|max:100',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:3999'
        ]);
        // upload img
        $image = $request->file('image');
        //kedalam folder public/news
        // fungsi hasName bikin random nama file
        $image->storeAs('public/news', $image->hashName());
        //create data kedalam table news
        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $image->hashName(),
            'slug' => Str::slug($request->title),
        ]);
        return redirect()->route('news.index')->with('success', 'Mantap Berita Berhasil Di Tambahkan! 👍');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Show - News";
        $news = News::findOrFail($id);
        return view('home.news.show', compact('title', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $category = Category::all();
        $title = 'Edit Data Berita';
        return view('home.news.edit', compact('title', 'news', 'category'));
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
        //validate
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:6000'
        ]);
        // get data by id
        $news =  News::findOrFail($id);
        //jika tidak ada img yg di upload
        if ($request->file('image') == "") {
            //update
            $news->update([
                'title'       =>   $request->title,
                'content'     =>   $request->content,
                'slug'        =>   Str::slug($request->title),
                'category_id' =>   $request->category_id
            ]); 
        } else {
            //hapus old image dulu
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
        return redirect()->route('news.index')->with(['success'=>'Berhasil Mengubah Data 🫡']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get data by id
        $news = News::findOrFail($id);
        Storage::disk('local')->delete('public/news/' . basename($news->image));
        //delate data
        $news->delete();

        return redirect()->route('news.index')->with(['success'=> 'Berhasil  Di Hapus 🧹']);
    }
}
