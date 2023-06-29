<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product_asset;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductAssetController extends Controller
{
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'product_id'     => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/product/', $image->hashName());

        //create post
        $post = Product_asset::create([
            'product_id'     => $request->product_id,
            'image'     => $image->hashName(),
        ]);

        //return response
        return new PostResource(true, 'Data Asset Berhasil Ditambahkan!', $post);
    }
    public function destroy(Product_asset $product_asset)
    {
        // Hapus file asset
        Storage::delete('public/product/', $product_asset->image);
        //delete asset
        $product_asset->delete();
        return new PostResource(true, 'Data Asset Berhasil Dihapus!', null);
    }
}
