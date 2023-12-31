<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Receipe;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FactoryController extends Controller
{
    public function index(){
        return Inertia::render('FactoryDepartment/Index',[
            'factories' => Factory::all()->load('product')->map(function ($item){
                return [
                    'id'=>$item->id,
                    'expected' => $item->expected,
                    'actual' => $item->actual,
                    'product_id' => $item->product['id'],
                    'product_name' => $item->product['name'],
                    'isStore' => $item->product['inventory'] ? true : false,
                    'created_at'=>$item->created_at
                ];
            }),
            'products' => Product::latest()->get(),
            'ingredients' => Ingredient::latest()->get(),
            'receipes' => Receipe::all()->load('product','ingredient')->map(function($item){
                return [
                    'id' => $item->id,
                    'ingredient_name' => $item->ingredient?->name,
                    'product_name' => $item->product?->name,
                    'amount_grams' => $item->amount_grams,
                    'created_at' => $item->created_at
                ];
            })
        ]);
    }

    public function store(Request $request){
        $productCleanData = $request->validate([
            'name' => 'required',
            'image_url' => ['required','image'],
            'description' => 'required',
            'unit_price'=>'required',
            'quantity_per_box'=>'required'
        ]);
        
        $url = request('image_url')->store('product-images');
        $productCleanData['image_url'] = 'storage/' . $url ;
        $product = Product::create($productCleanData);
        
        $factoryCleanData = $request->validate([
            'expected' => 'required',
            'actual' => 'required'
        ]);
        $factoryCleanData['product_id'] = $product->id;
        Factory::create($factoryCleanData);
        return redirect(route('dashboard'))->with('message',[
            'content' => 'Create Factory is successful.',
            'type' => 'success'
        ]);
    }

    public function editPage(Factory $factory){
        return Inertia::render('FactoryDepartment/EditFactory',[
            'factory' => $factory->load('product')
        ]);
    }

    public function editProduct(Product $product){
        return Inertia::render('FactoryDepartment/EditFactory',[
            'product' => $product->load('details','inventory')
        ]);
    }

    public function editFactory(Request $request){
        $productCleanData = $request->validate([
            'name' => 'required',
            'image_url' => ['required','image'],
            'description' => 'required',
            'unit_price'=>'required',
            'quantity_per_box'=>'required'
        ]);
        $factoryCleanData = $request->validate([
            'expected' => 'required',
            'actual' => 'required'
        ]);
        //product
        $url = request('image_url')->store('product-images');
        $productCleanData['image_url'] = 'storage/' . $url ;
        $product = Product::where('name',$productCleanData['name'])->update($productCleanData);
        //factory
        $factoryCleanData['product_id'] = $product->id;
        Factory::where('product_id',$product->id)->update($factoryCleanData);
        return redirect(route('dashboard'))->with('message',[
            'content' => 'Edit Factory is successful.',
            'type' => 'success'
        ]);
    }

    public function deleteProduct(Product $product){
        $product->delete();
        $product->details()->delete();
        return back()->with('message',[
            'content' => 'Deleting Product is successful.',
            'type' => 'success'
        ]);
    }

    public function deleteFactory(Factory $factory){
        $factory->delete();
        $factory->product()->delete();
        return back()->with('message',[
            'content' => 'Deleting Factory is successful.',
            'type' => 'success'
        ]);
    }
}
