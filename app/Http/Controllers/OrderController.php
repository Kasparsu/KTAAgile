<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends ResourceController
{
    public static $model = Order::class;

    public function addItem($itemId, $orderId) {
        return Order::addItem($itemId, $orderId, \request()->input('quantity', null));
    }
    public function setStatusOrdered($id){
        /**
         * @var Order $order
         */
        $order = Order::find($id);
        $order->setStatus(Order::ORDERED);
        $order->save();
    }
    public function getCart($userId){
        return Order::where([
            ['user_id', $userId],
            ['status', Order::CART]
        ])->first();
    }
}
