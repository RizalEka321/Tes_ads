<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product_asset;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('price', 'desc')->get();
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('product.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|min:2|max:100',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ]);

        $id = Str::replace('...', '', Str::limit($request->name, 2)) . mt_rand(1, 99);
        Product::create([
            'id' => $id,
            'category_id' => $request->category_id,
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        if ($request->hasFile('images')) {
            $product = Product::findOrFail($id);

            $images = $request->file('images');
            foreach ($images as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('public/product', $image->hashName());

                $product->product_asset()->create([
                    'product_id' => $id,
                    'image' => $image->hashName()
                ]);
            }
        }

        return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $product_asset = Product_asset::where('product_id', $id)->get();
        $category = Category::all();
        return view('product.edit', compact('product', 'product_asset', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|min:2|max:100',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ]);

        $id->update([
            'category_id' => $request->category_id,
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);
        return redirect()->route('product')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $id)
    {
        $product_asset = Product_asset::where('product_id', $id->id)->get();
        // Hapus asset
        foreach ($product_asset as $asset) {
            Storage::delete('public/product/'. $asset->image);
        }
        //delete post
        $id->delete();
        return redirect()->route('product')->with('errors', 'Produk berhasil dihapus.');
    }
}
