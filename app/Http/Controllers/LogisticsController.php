<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverStoreRequest;
use App\Http\Requests\LogisticsStoreRequest;
use App\Models\Driver;
use App\Models\Logistic;
use App\Models\Order;
use App\Models\Preorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class LogisticsController extends Controller
{

    public function index(){
        return Inertia::render('LogisticsDepartment/Index',[
            'drivers' => Driver::latest()->get(),
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
            'preorders' => Preorder::where('status','=','order')->get()
        ]);
    }

    public function store(LogisticsStoreRequest $request)
    {
        $cleanData = $request->validated();
        Preorder::find($cleanData['preorder_id'])->update(['status'=>'deliver']);
        Logistic::create($cleanData);
        return back()->with('message',[
            'content' => 'Create Deliver is successful.',
            'type' => 'success'
        ]);
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
}
