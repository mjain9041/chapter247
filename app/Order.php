<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_id','invoice_number','total_amount','status'];

    public function customerdata()
    {
        return $this->hasOne('App\Customer','id','user_id');
    }
    
}
