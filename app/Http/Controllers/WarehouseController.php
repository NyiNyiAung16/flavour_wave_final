<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;
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
}
