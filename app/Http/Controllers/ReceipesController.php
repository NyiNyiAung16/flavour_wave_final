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
            'product_id' => ['required',Rule::exists('products','id')],
            'ingredient_id' => ['required'],
            'amount_grams' => ['required']
        ]);
        $receipe->update($cleanData);
        return back()->with('message',[
            'content' => 'Edit Receipe is successful.',
            'type' => 'success'
        ]);
    }

}
