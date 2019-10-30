<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';

    protected $fillable = ['order_id','product_id'];

    public function productdata()
    {
        return $this->hasOne('App\Product','id','product_id');
    }
    
    
}
