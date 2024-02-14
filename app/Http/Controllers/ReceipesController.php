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

    public function storeEditReceipe(Receipe $receipe,Request $request){
        $cleanData = $request->validate([
            'product_id' => ['required'],
            'ingredient_id' => ['required'],
            'amount_grams' => ['required']
        ]);

        $collectedIngredients = collect($cleanData['ingredient_id']);

        $collectedIngredients->each(function($i) use($cleanData,$receipe) {
            $newArray = ['product_id' => $cleanData['product_id'],'ingredient_id' => (int) $i, 'amount_grams'=> $cleanData['amount_grams'][$i]];
            $receipe->update($newArray);
        });
    }
}
