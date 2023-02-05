<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    //
    public function store(Request $request)
    {
        $status = false;

        try{
            foreach($request->purchase_order as $key => $value)
            {
                $inputData = [
                    'product_name' => $value['product_name'],
                    'qty' => $value['qty'],
                    'price' => $value['price']
                ];

                DB::table('purchase_orders')
                    ->insert($inputData);
            }
            $status = true;
            $data['message'] = 'Saved';
            $response = [
                'status' => $status,
                'data' => $data
            ];
            return response()->json($response);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            $response = [
                'status' => $status,
                'data' => $data
            ];
            return response()->json($response);
        }
    }
}
