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

    public function storeProductEdit(Product $product,Request $request){
        $cleanData = $request->validate([
            'name'=>'required',
            'description'=>'required',
            'unit_price'=>'required|min:1',
            'quantity_per_box'=>'required|min:1',
            'image_url'=>'required|image',
        ]);
        $url = request('image_url')->store('product-images');
        $cleanData['image_url'] = 'storage/' . $url ;
        $product->update($cleanData);
        return redirect(route('factoryDepartment.index'))->with('message',[
            'content' => 'Edit Product is successful',
            'type' => 'success'
        ]);
    }
}
