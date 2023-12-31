<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Logistic;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class LogisticsController extends Controller
{

    public function index(){
        return Inertia::render('LogisticsDepartment/Index',[
            'drivers' => Driver::latest()->get(),
            'logistics' => Logistic::all()->load('received_orders','driver_info')->map(function($item){
                return [
                    'id' => $item->id,
                    'preorder_id' => $item->received_orders->id,
                    'driver_name' => $item->driver_info->name,
                    'driver_vehicle_number' => $item->driver_info->vehicle_number,
                    'quantity' => $item->quantity,
                    'created_at' => $item->created_at
                ];
            }),
            'orders' => Order::with('preorder')->latest()->get()
        ]);
    }

    public function make(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'preorder_id' => ['required', Rule::exists('preorders', 'order_id')],
            'driver_id' => ['required', Rule::exists('drivers', 'id')],
            'quantity' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Logistic::create($validator->validate());
        return response()->json([
            'message' => 'Making deliver is successful.'
        ]);
    }
    public function getCount()
    {
        return Logistic::count();
    }
}
