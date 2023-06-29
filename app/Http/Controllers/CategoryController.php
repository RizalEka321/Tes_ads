<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = DB::table('categories')
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.id', 'categories.name', DB::raw('COUNT(products.id) as product_count'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('product_count', 'desc')
            ->get();
        // @dd($category);
        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.add');
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
            'name' => 'required|string|min:2|max:100',
        ]);

        Category::create([
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('category')->with('success', 'Kategori berhasil ditambahkan.');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $id)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:100'
        ]);

        $id->update([
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('category')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $id)
    {
        //delete category
        $id->delete();
        return redirect()->route('category')->with('errors', 'Kategori berhasil dihapus.');
    }
}
