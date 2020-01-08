<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const CART = 'CART';
    const ORDERED = 'ORDERED';
    const SHIPPED = 'SHIPPED';
    const FULFILLED = 'FULFILLED';
    const STATUSES = [self::CART, self::ORDERED, self::SHIPPED, self::FULFILLED];

    protected $with = ['orderItems'];

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'order_items');
    }

    public static function addItem($itemId, $orderId, $quantity = null) {
        $order = Order::find($orderId);
        if($order == null){
            $order = new Order();
            $order->user_id = 1;
            $order->status = self::CART;
            $order->save();
        }
        $product = Product::findOrFail($itemId);
        $orderItem = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();
        if(!$orderItem){
            $orderItem = new OrderItem();
            $orderItem->quantity = 1;
            $orderItem->price = $product->price;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
        } elseif($quantity) {
            $orderItem->quantity = (int) $quantity;
        } else {
            $orderItem->quantity++;
        }
        $orderItem->save();
        return $orderItem;
    }

    public function setStatus($status) {
        if(in_array($status, self::STATUSES)) {
            $this->status = $status;
        } else {
            throw new \Exception('status not found');
        }
    }
}
