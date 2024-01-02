<?php

namespace App\Http\Controllers;

use App\Models\Preorder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaleController extends Controller
{
    public function index(){
        return Inertia::render('SaleDepartment/Index',[
            'preorders' => Preorder::where('is_urgent',false)->where('status','pending')->get(),
            'urgents' => Preorder::where('is_urgent',true)->where('status','pending')->get(),
            'user' => auth()->user(),
            'confrim_preorders' =>  Preorder::where('is_urgent',false)->where('status','!=','pending')->get(),
            'urgent_orders' => Preorder::where('is_urgent',true)->where('status','!=','pending')->get()
        ]);
    }

    public function confrim(Preorder $preorder){
        $preorder->update(['status'=>'order']);
        return back()->with('message',[
            'content'=>'Confrim preorder is successful.',
            'type' => 'success'
        ]);
    }

    public function storeEditPreorder(Preorder $preorder,Request $request){
        $cleanData =$request->validate([
            'cancel_reason' => 'required'
        ]);
        $cleanData['status'] = 'cancel';
        $preorder->update($cleanData);
        return back()->with('message',[
            'content' => 'Cancel is successful',
            'type' => 'success'
        ]);
    }
}
