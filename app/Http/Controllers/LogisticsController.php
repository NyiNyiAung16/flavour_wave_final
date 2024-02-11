<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverStoreRequest;
use App\Http\Requests\LogisticsStoreRequest;
use App\Models\Driver;
use App\Models\Logistic;
use App\Models\Order;
use App\Models\Preorder;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class LogisticsController extends Controller
{

    public function index(){
        return Inertia::render('LogisticsDepartment/Index',[
            'drivers' => Driver::latest('created_at')->get(),
            'logistics' => Logistic::with('received_orders','driver_info')->latest()->get()->map(function($item){
                return [
                    'id' => $item->id,
                    'preorder_id' => $item->received_orders->id,
                    'driver_id' => $item->driver_info->id,
                    'quantity' => $item->quantity,
                    'status'=>$item->received_orders->status,
                    'created_at' => $item->created_at
                ];
            }),
            'inprocess' => Preorder::where('status','processing')->where('is_urgent',false) ->get(),
            'preorders' => Preorder::where('status','order')->where('is_urgent',false)->get(),
            'user' => auth()->user()
        ]);
    }

    public function store(LogisticsStoreRequest $request)
    {

        $cleanData = $request -> validated();
        $itemQuantity = $cleanData['item_quantity'];
        if (isset($cleanData['item_quantity'])) {
            unset($cleanData['item_quantity']);
        }
        $p = Preorder::where('id',$cleanData['preorder_id'])
                        ->where('is_urgent',false)
                        ->where('order_quantity','>=',$cleanData['quantity'])
                        ->first();
        if($p){
            if($cleanData['quantity'] == ($p->order_quantity - $p->delivered_quantity)){
                $p->update(['status'=>'deliver','delivered_quantity' => $cleanData['quantity']]);
                Logistic::create($cleanData);
            }else{
                $p->update(['status'=>'processing','delivered_quantity' => $cleanData['quantity']]);
            }
            Driver::where('id', $cleanData['driver_id'])->update(['isFree' => '0']);
            $products = $p->products;
            foreach ($products as $product) {
                $warehouse = Warehouse::find($product->id);
                if ($warehouse) {
                    $newAvailability = max(0, $warehouse->availability - $itemQuantity[$product->id]);
                    $warehouse->update(['availability' => $newAvailability]);
                }
                $left_qty = $product->pivot->quantity - $itemQuantity[$product->id];
                $product -> pivot -> update(['quantity' => $left_qty]);
            }
            return back()->with('message',[
                'content' => 'Create Deliver is successful.',
                'type' => 'success'
            ]);
        }
    }

    public function storeEditData(Logistic $logistic,LogisticsStoreRequest $request){
        $cleanData = $request->validated();
        $logistic->update($cleanData);
        return back()->with('message',[
            'content' => 'Edit Deliver is successful.',
            'type' => 'success'
        ]);
    }

    public function destroy(Logistic $logistic){
        $logistic->delete();
        return back()->with('message',[
            'content' => 'Delete Logistic is successful.',
            'type' => 'success'
        ]);
    }

    public function getPreorder(Request $request, $preorderId){
        $p = Preorder::where('id', $preorderId)
            ->whereIn('status', ['order', 'processing'])
            ->where('is_urgent', false)
            ->first();

        if($p){
            return response()->json($p); // Return data directly
        }
        return response()->json(['error' => 'Preorder not found'], 404);
    }



}
