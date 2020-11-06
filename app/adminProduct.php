<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminProduct extends Model
{
    //
    protected $table = 'admin_product';
    protected $fillable = [
        'product_name','user_id','product_thumb','product_content','date_create','status', 'product_price', 'product_detail','product_configuration','category'
    ];
}
