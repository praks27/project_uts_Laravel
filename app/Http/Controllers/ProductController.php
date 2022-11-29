<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Blade;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter');
        $data = product::with(['category']);
        $categories = Category::get();


        if ($search) {
            $data->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                      ->orWhere('status','like', "%$search%");
            });
        }

        if($filter) {
            $data->where(function ($query) use ($filter){
                $query->where('category_id','=',$filter);
            });
        }

        $data = $data->paginate(2);
        return view('admin.pages.product.list', [
            'data' => $data,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //ditambahkan major untuk memanggil relasi categroy
         $product = new Product();
         $categories = Category::get();
         return view('admin.pages.product.form',['product' => $product,'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->all();
        $image = $request->file('image');
        if ($image) {
            $data['image'] = $image->store('images/product', 'public');
        }
        $data['image'] = $request->file('image')->store('images/product','public');
        Product::create($data);
        return redirect()->route('product.index')->with('notif','berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('admin.pages.product.form',
        ['product'=>$product,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->all();
        $image = $request->file('image');
        // CEK APAKAH USER MENGUPLOAD FILE
        if ($image) {
            // cek apakah file lama ada didalam folder?
            $exists = File::exists(storage_path('app/public/').$product->image);
            if ($exists) {
                // delete file lama tersebut
                File::delete(storage_path('app/public/').$product->image);
            }
            // upload file baru
            $data['image'] = $image->store('images/product', 'public');
        }
        $product -> update($data);
        //untuk memanggil fungsi notif session tambahkan panah setelah kurung,lalu ketikan with
        //untuk parameter pertama berdasarkan nama dari variabel session dan parameter kedua berisikan pesan yang akan di tampilkan
        return redirect()->route('product.index')->with('notif','berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $exists = File::exists(storage_path('app/public/').$product->image);
        if ($exists) {
            // delete file lama tersebut
            File::delete(storage_path('app/public/').$product->image);
        }
        $product->delete();
        return redirect()->route('product.index')->with('notif','berhasil hapus data');
    }

}
