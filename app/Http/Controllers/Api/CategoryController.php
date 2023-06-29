<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        //get category
        $category = DB::table('categories')
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.id', 'categories.name', DB::raw('COUNT(products.id) as product_count'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('product_count', 'desc')
            ->get();

        //return collection of posts as a resource
        return new PostResource(true, 'List Data Category', $category);
    }
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

         $category = Category::create([
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name)
        ]);

        $category = Category::orderBy('created_at', 'desc')->first();

        return new PostResource(true, 'Data Kategori Berhasil Ditambahkan!', $category);
    }
    public function update(Request $request, Category $category)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category->update([
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name)
        ]);

        return new PostResource(true, 'Data Kategori Berhasil Diubah!', $category);
    }
    public function destroy(Category $category)
    {
        //delete category
        $category->delete();

        //return response
        return new PostResource(true, 'Data Kategori Berhasil Dihapus!', null);
    }
}
