<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with("category")->paginate(10);
        return view("products.index", compact("products"));
    }

    public function create()
    {
        $categories = Category::all();
        return view("products.create", compact("categories"));
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route("products.index")->with("success", "Product created successfully.");
    }

    public function show(Product $product)
    {
        return view("products.show", compact("product"));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view("products.edit", compact("product", "categories"));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route("products.index")->with("success", "Product updated successfully.");
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route("products.index")->with("success", "Product deleted successfully.");
    }
}
