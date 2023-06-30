<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product_asset;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with('product_asset')->orderBy('price', 'desc')->get();
        return new PostResource(true, 'List Data Product', $product);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required|string|min:2|max:100',
            'description' => 'required',
            'stock' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $id = Str::replace('...', '', Str::limit($request->name, 2)) . mt_rand(1, 99);
        $product = Product::create([
            'id' => $id,
            'category_id' => $request->category_id,
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        $input = $request->file('images');
        foreach ($input as $image) {
            $image->storeAs('public/product/', $image->hashName());
            $product = Product::findOrFail($id);
            Product_asset::create([
                'product_id' => $id,
                'image'     => $image->hashName(),
            ]);
        }

        $product = Product::with('product_asset')->first();

        return new PostResource(true, 'Data Produk Berhasil Ditambahkan!', $product);
    }
    public function update(Request $request, Product $product)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required|string|min:2|max:100',
            'description' => 'required',
            'stock' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return new PostResource(true, 'Data Produk Berhasil Diubah!', $product);
    }
    public function destroy(Product $product)
    {
        $product_asset = Product_asset::where('product_id', $product->id)->get();

        // Hapus asset
        foreach ($product_asset as $asset) {
            Storage::delete($asset->image);
        }

        // Hapus product_asset
        Product_asset::where('product_id', $product->id)->delete();
        // Hapus product
        $product->delete();
        return new PostResource(true, 'Data Produk Berhasil Dihapus!', null);
    }
}
