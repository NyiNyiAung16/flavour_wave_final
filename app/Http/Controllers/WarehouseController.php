<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Models\Factory;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class WarehouseController extends Controller
{
    public function index(){
        return Inertia::render('WarehouseDepartment/Index',[
            'warehouses' => Warehouse::with('product')->latest()->get()->map(function ($item){
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
            'factoryProduct' => Factory::with('product')->latest()->get(),
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

    public function store(WarehouseRequest $request){
        $cleanData = $request->validated();
        Warehouse::create($cleanData);
        return back()->with('message',[
            'content'=>'Create Warehouse is successful.',
            'type' => 'success'
        ]);
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

    public function updateDamage(Request $request){
        $product_id = $request -> product_id;
        $damage_qty = $request -> damage_qty;
        $warehouse = Warehouse::find($product_id);
        if($warehouse){
            $oldDamage_qty = $warehouse->damage;
            $newDamage_qty = $oldDamage_qty + $damage_qty;
            $oldAvailability = $warehouse->availability;
            $newAvailability = $oldAvailability - $damage_qty;
            $warehouse -> update(["availability" => $newAvailability]);
            $warehouse->update(["damage" => $newDamage_qty]);
        }
        return back()->with('message',[
            'content' => 'Edit Warehouse is successful.',
            'type' => 'success'
        ]);
    }

    public function saleReturn(Request $request){
        $product_id = $request -> product_id;
        $sale_return = $request -> sale_return;
        $warehouse = Warehouse::find($product_id);
        if($warehouse){
            $oldSale_return = $warehouse->sales_return;
            $newSale_return = $oldSale_return + $sale_return;
            $warehouse->update(["sales_return" => $newSale_return]);
        }
        return back()->with('message',[
            'content' => 'Edit Warehouse is successful.',
            'type' => 'success'
        ]);
    }


    public function updateAvailability(Request $request){
        $id = $request['id'];
        $productID = $request['productID'];
        $quantity = $request['quantity'];
        $warehouse = Warehouse::find($productID);
        $factory = Factory::where('id', $id)->first();
        if($warehouse && $factory){
            $oldAvailability = $warehouse -> availability;
            $newAvailability = $oldAvailability + $quantity;
            $warehouse->update(["availability" => $newAvailability]);
            $oldReceived = $warehouse -> received;
            $newReceived = $oldReceived + $quantity;
            $warehouse->update(["received" => $newReceived]);
            $factory->update(["stored" => true]);
        }
        return back()->with('message',[
            'content' => 'Product is successfully added to Warehouse.',
            'type' => 'success'
        ]);
    }

}

