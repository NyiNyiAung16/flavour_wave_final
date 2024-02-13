<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Models\Factory;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Receipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use PDO;

class FactoryController extends Controller
{
    public function index(){
        return Inertia::render('FactoryDepartment/Index',[
            'factories' => Factory::all()->load('product')->map(function ($item){
                return [
                    'id'=>$item->id,
                    'expected' => $item->expected,
                    'actual' => $item->actual,
                    'product_id' => $item->product?->id,
                    'product_name' => $item->product?->name,
                    'isStore' => $item->stored == 1 ? true : false,
                    'created_at'=>$item->created_at
                ];
            }),
            'products' => Product::latest()->get(),
            'ingredients' => Ingredient::latest()->get(),
            'receipes' => Receipe::all()->load('product','ingredient')->map(function($item){
                return [
                    'id' => $item->id,
                    'ingredient_id' => $item->ingredient?->id,
                    'ingredient_name' => $item->ingredient?->name,
                    'product_id' => $item->product?->id,
                    'product_name' => $item->product?->name,
                    'amount_grams' => $item->amount_grams,
                    'created_at' => $item->product?->created_at,
                ];
            })
        ]);
    }

    public function getFactoryProduct()
    {
        $factories = Factory::with('product')->get();
        $transformedData = $factories->map(function ($factory) {
        return [
            'id' => $factory->id,
            'product_id' => $factory->product_id,
            'product_name' => $factory->product->name,
            'expected' => $factory->expected,
            'actual' => $factory->actual,
            'stored' => $factory->stored,
            'created_at' => $factory->created_at,
            ];
        });
        return response()->json([
            'factories' => $transformedData,
        ]);
    }

    public function storeProduct(ProductsRequest $request){
        $productCleanData = $request->validated();
        $url = request('image_url')->store('product-images');
        $productCleanData['image_url'] = 'storage/' . $url ;
        Product::create($productCleanData);
    }

    public function storeProductDetails(Request $request){
        $factoryCleanData = $request->validate([
            'product_id' => ['required',Rule::exists('products','id')],
            'expected' => ['required','numeric','min:1'],
            'actual' => ['required','numeric','min:1']
        ]);

        Factory::create($factoryCleanData);
    }

    public function storeIngredient(Request $request){
        $cleanData = $request->validate([
            'name'=>'required',
            'source'=>'required',
            'amount'=>'required|numeric|min:1',
            'unit_price'=>'required|numeric|min:1',
        ]);

        $cleanData['purchased_date'] = now();

        Ingredient::create($cleanData);
    }

    public function storeReceipe(Request $request){
        $cleanData = $request->validate([
            'ingredient_id' => ['required',Rule::exists('ingredients','id')],
            'product_id' => ['required',Rule::exists('receipes','id')],
            'amount_grams' => 'required|numeric|min:1',
        ]);

        Receipe::create($cleanData);
    }

    public function editPage(Factory $factory){
        return Inertia::render('FactoryDepartment/EditFactory',[
            'factory' => $factory->load('product')
        ]);
    }

    public function editProduct(Product $product){
        return Inertia::render('FactoryDepartment/EditFactory',compact('product'));
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

    public function storeFactoryEdit(Factory $factory,Request $request){
        $cleanData = $request->validate([
            'product_id' => ['required',Rule::exists('products','id')],
            'expected'=>['required','min:1'],
            'actual'=>['required','min:1']
        ]);
        $factory->update($cleanData);
        return back()->with('message',[
            'content' => 'Edit Factory is successful.',
            'type' => 'success'
        ]);
    }

    public function storeEditIngredient(Ingredient $ingredient,Request $request){
        $cleanData = $request->validate([
            'name'=>'required',
            'source'=>'required',
            'amount'=>['required','min:2'],
            'unit_price'=>['required','min:2']
        ]);
        $ingredient->update($cleanData);
        return redirect(route('factoryDepartment.index'))->with('message',[
            'content' => 'Edit Ingredient is successful.',
            'type' => 'success'
        ]);
    }

    public function deleteProduct(Product $product){
        $product->delete();
        return back()->with('message',[
            'content' => 'Deleting Product is successful.',
            'type' => 'success'
        ]);
    }

    public function deleteFactory(Factory $factory){
        $factory->delete();
        return back()->with('message',[
            'content' => 'Deleting Factory is successful.',
            'type' => 'success'
        ]);
    }

    public function deleteIngredient(Ingredient $ingredient){
        $ingredient->delete();
        return back()->with('message',[
            'content' => 'Deleting Ingredient is successful.',
            'type' => 'success'
        ]);
    }

    public function deleteReceipe(Receipe $receipe){
        $receipe->delete();
        return back()->with('message',[
            'content' => 'Deleting Ingredient is successful.',
            'type' => 'success'
        ]);
    }
}
