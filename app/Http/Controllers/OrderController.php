<?php

namespace App\Http\Controllers;

use App\Orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function makeOrder(Request $request)
    {
        $data = $request->input('order');

        $order = new Orders();
        $order->product_name = $data['name'];
        $order->quantity = $data['quantity'];
        $order->price = $data['price'];
        $order->total_value = $order->quantity * $order->price;
        $order->toJson();

        Storage::put("/orders/file_" .date('Y:m:d_h:i:s'). ".json",$order);

        //return $order->save();
    }
}
