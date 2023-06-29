<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_asset;
use Illuminate\Support\Facades\Storage;

class ProductAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'product_id' => 'required',
        ]);
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/product/', $image->hashName());

        //create post
       Product_asset::create([
            'product_id'     => $request->product_id,
            'image'     => $image->hashName(),
        ]);
        return back()->with('success', 'Gambar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_asset  $product_asset
     * @return \Illuminate\Http\Response
     */
    public function show(Product_asset $product_asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_asset  $product_asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_asset $product_asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_asset  $product_asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_asset $product_asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_asset  $product_asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_asset $id)
    {
        // Hapus file asset
        Storage::delete('/public/product/'. $id->image);
        //delete asset
        $id->delete();
        return back()->with('errors', 'Gambar berhasil dihapus.');
    }
}
