<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Product extends Model
{
    use PimpableTrait;
    protected $sortParameterName = 'sortBy';

    public function category(){
        return $this->belongsTo(Category::class);
    }

    protected $hidden = ['category_id'];

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_items');
    }
}
