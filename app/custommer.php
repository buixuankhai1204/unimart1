<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class custommer extends Model
{
    //
    protected $table = 'custommers';
    protected $fillable = ['fullname','note','phone','address','email','qty','total_price','status','product_cart','product_code'];
}
