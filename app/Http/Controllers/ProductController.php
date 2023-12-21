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
            'products' => Product::latest()->get()
        ]);
    }

    public function show(Product $product){
        return Inertia::render('Products/Show',[
            'product' => $product,
            'receipes'=> $product->receipes,
            'products'=>Product::inRandomOrder()->limit(4)->get(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')
        ]);
    }

    public function create(ProductsRequest $request){
        $cleanData = $request->validated();
        Product::create($cleanData);
        return response()->json([
            'message'=>'Create Product is successful.'
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
