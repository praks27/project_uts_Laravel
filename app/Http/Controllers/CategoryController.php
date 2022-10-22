<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Category::get();
        return view('pages.category.list',['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = new Category();
        return view('pages.category.form',['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        Category::create($data);
        return redirect('category')->with('notif','berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        $categories = $category->load(['products']);
        return view('pages.category.list-category',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view('pages.category.form', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //untuk menampilkan value dari databse
        $data = $request->all();
        //untuk menyimpan data setelah update
        $category -> update($data);
        //untuk memanggil fungsi notif session tambahkan panah setelah kurung,lalu ketikan with
        //untuk parameter pertama berdasarkan nama dari variabel session dan parameter kedua berisikan pesan yang akan di tampilkan
        return redirect('category')->with('notif','berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //untuk menghapus data
        $category->delete();
        return redirect()->route('category.index')->with('notif','berhasil delete data');
    }
}
