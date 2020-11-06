<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminPost extends Model
{
    //
    protected $table = 'admin_post';
    protected $fillable = [
        'post_title','user_id','post_thumb','post_content','date_create','status','category'];
}
