<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class WarehouseController extends Controller
{
    public function index(){
        return Inertia::render('WarehouseDepartment/Index',[
            'warehouses' => Warehouse::all()->load('product')->map(function ($item){
                return [
                    'id'=>$item->id,
                    'opening_balance' => $item->opening_balance,
                    'closing_balance' => $item->closing_balance,
                    'product_id' => $item->product->id ?? null,
                    'product_name' => $item->product->name ?? null,
                    'sales_issue'=>$item->sales_issue,
                    'received'=>$item->received,
                    'availability'=>$item->availability,
                    'sales_return'=>$item->sales_return,
                    'damage'=>$item->damage,
                    'created_at'=>$item->created_at
                ];
            }),
            'products' => Warehouse::all()->load('product')->map(function ($item){
                return [
                    'id'=>$item->product->id ?? null,
                    'name' => $item->product->name ?? null,
                    'description' => $item->product->description ?? null,
                    'unit_price' => $item->product->unit_price ?? null,
                    'quantity_per_box' => $item->product->quantity_per_box ?? null,
                    'image_url' => $item->product->image_url ?? null,
                    'created_at' => $item->product->created_at ?? null,
                ];
            })
        ]);
    }

    public function create(WarehouseRequest $request){
        $cleanData = $request->validated();
        Warehouse::create($cleanData);
        return response()->json(['message'=>'Adding product into warehouse is successful.']);
    }

    public function destroy(Warehouse $warehouse){
        $warehouse->delete();
        return back()->with('message',[
            'content'=> 'Deleting warehouse is successful.',
            'type' => 'success'
        ]);
    }

    public function storeWarehouseEdit(Warehouse $warehouse,Request $request){
        $cleanData = $request->validate([
            'product_id' => ['required',Rule::exists('products','id')],
            'opening_balance' => ['required','min:1'],
            'sales_issue' => ['required','min:1'],
            'received' => ['required','min:1'],
            'availability' => ['required','min:1'],
            'sales_return' => ['required','min:1'],
            'damage' => ['required','min:1'],
            'closing_balance' => ['required','min:1'],
        ]);
        $warehouse->update($cleanData);
        return back()->with('message',[
            'content' => 'Edit Warehouse is successful.',
            'type' => 'success'
        ]);
    }
}
