<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductsRequest;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Receipe;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class ProductController extends Controller
{

    public function all(){
        return Inertia::render('Products/All',[
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'products' => Product::latest()->get(),
            'user_id' => auth()->id()
        ]);
    }

    public function show(Product $product){
        return Inertia::render('Products/Show',[
            'product' => $product,
            'receipes'=> $product->receipes,
            'products'=>Product::inRandomOrder()->limit(4)->get(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'user_id' => auth()->id()
        ]);
    }

    public function create(ProductsRequest $request){
        $cleanData = $request->validated();
        Product::create($cleanData);
        return response()->json([
            'message'=>'Create Product is successful.'
        ]);
    }

    public function storeProductEdit(Product $product,Request $request){
        $cleanData = $request->validate([
            'name'=>'required',
            'description'=>'required',
            'unit_price'=>'required|min:1',
            'quantity_per_box'=>'required|min:1',
            'image_url'=>'required|image',
        ]);
        $product->update($cleanData);
        return redirect('factoryDepartment.index')->with('message',[
            'content' => 'Edit Product is successful',
            'type' => 'success'
        ]);
    }

    // import 4 random products to frontend
    public function get4Products(){
        $randomProducts = Product::inRandomOrder()->limit(4)->get();
        return response()->json([
            'randomProducts' => $randomProducts,
            'randomProductsCount' => count($randomProducts),
        ]);
    }

    // get product details
    public function detailProduct($id){
        return Product::where('product_id', $id)->first();
        
    }

    // get trending products
    public function trendProducts(){
       return Warehouse::orderBy('sales_issue', 'desc')->take(3)->get();
    }
}
