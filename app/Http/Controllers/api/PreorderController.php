<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PreorderRequest;
use App\Models\Preorder;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PreorderController extends Controller
{
    // get all orders' list from the customer
    public function getPreorders($id)
    {
        $perPage = 12;
        $pageCount = ceil(count(Preorder::all()) / $perPage);
        $orders = Preorder::where('customer_id', $id)->latest()->paginate(12);

        return response()->json([
            'orders' => $orders,
            'pageCount' => $pageCount,
        ]);
    }

    // create order
    public function createPreorder(Request $request)
    {
        $pId = request('product_id');
        if ($pId) {
            $preorderCleanData = $request->validate([
                'user_id' => ['required',Rule::exists('users','id')],
                'order_quantity' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'full_location' => 'required',
                'deliver_price'=>'required',
                'total_price'=>'required'
            ]);
            if(request('is_urgent')){
                $isUrgentData = request()->validate([
                    'date'=>'required',
                    'is_urgent'=>'required',
                    'truck_number'=>'required',
                    'capacity'=>['required','numeric','min:1'],
                    'driver_nrc'=>'required',
                    'total_price'=>'required|numeric|min:1'
                ]);
                $preorderCleanData['is_urgent'] = $isUrgentData['is_urgent'];
                $preorderCleanData['truck_number'] = $isUrgentData['truck_number'];
                $preorderCleanData['capacity'] = $isUrgentData['capacity'];
                $preorderCleanData['driver_nrc'] = $isUrgentData['driver_nrc'];
                $preorderCleanData['date'] = $isUrgentData['date'];
            }
            $preorderCleanData['preorder_date'] = now();
            $preorder = Preorder::create($preorderCleanData);
            for($i = 0; $i < count($pId);$i++){
                $preorder->products()->attach($pId[$i]);
            }
        }
    }

    // edit order list
    public function update(Preorder $preorder, PreorderRequest $request)
    {
        $cleandata = $request->validated();
        $preorder->update($cleandata);
        return response()->json([
            'message' => 'Your order has been updated successfully.'
        ]);

    }
}
