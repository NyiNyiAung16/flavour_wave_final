<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceipesRequest;
use App\Models\Receipe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReceipesController extends Controller
{
    public function create(ReceipesRequest $request){
        $cleanData =$request->validated();
        Receipe::create($cleanData);
        return response()->json(['message'=>'Create receipe for product is successful.']);
    }

    public function storeEditReceipe(Request $request){
        $cleanData = $request->validate([
            'product_id' => ['required'],
            'ingredient_id' => ['required'],
            'amount_grams' => ['required']
        ]);
        $productId = $cleanData['product_id'];
        $ingredientIds = $cleanData['ingredient_id'];
        $amountGrams = $cleanData['amount_grams'];
        Receipe::where('product_id', $productId)->delete();
        foreach ($ingredientIds as $key => $ingredientId) {
            Receipe::create([
                'product_id' => $productId,
                'ingredient_id' => $ingredientId,
                'amount_grams' => $amountGrams[$ingredientId]
            ]);
        }
        return;
    }

}
