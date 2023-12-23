<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PreorderRequest;
use App\Models\Preorder;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function createPreorder(PreorderRequest $request)
    {
        $pId = request('product_id');
        if ($pId) {
            $preorderCleanData = $request->validated();
            if(request('is_urgent')){
                $isUrgentData = request()->validate([
                    'date'=>'required',
                    'is_urgent'=>'required',
                    'truck_number'=>'required',
                    'capacity'=>'required',
                    'driver_nrc'=>'required'
                ]);
                array_push($preorderCleanData,$isUrgentData);
            }
            $preorder = Preorder::create($preorderCleanData);
            for($i = 0; $i < count($pId);$i++){
                $preorder->products()->attach($pId[$i]);
            }
            return back()->with('message', [
                'content' => 'create preorder is successful.',
                'type' => 'success'
            ]);
        }
    }


    // edit page order
    public function getPreOrder($id)
    {
        $preorder = Preorder::where('order_id', $id)->get();
        return response()->json([
            'preorder' => $preorder,
        ]);
    }
    public function getPreordersCountFor12Months()
    {
        return response()->json([
            [
                'product_name' => 'Burmese Bliss',
                'monthly_preorder_count' => [100, 200, 900, 400, 600, 500, 7000, 4900, 5900, 4000, 300, 1800],
            ],
            [
                'product_name' => 'Golden Sunshine Tea',
                'monthly_preorder_count' => [4900, 5900, 4000, 300, 1800, 100, 200, 900, 400, 600, 500, 7000]
            ],
            [
                'product_name' => 'Mango Tango Delight',
                'monthly_preorder_count' => [100, 200, 900, 4900, 400, 600, 500, 7000, 5900, 4000, 300, 1800]
            ],
            [
                'product_name' => 'Rangoon Rosewater Elixir',
                'monthly_preorder_count' => [100, 200, 900, 400, 5900, 4000, 300, 7000, 4900, 1800, 600, 500,]
            ],
            [
                'product_name' => 'Emerald Green Chai',
                'monthly_preorder_count' => [500, 7000, 4900, 5900, 1800, 400, 600, 4000, 100, 200, 900, 300]
            ],
        ]);
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
