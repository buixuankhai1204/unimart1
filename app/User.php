<?php
namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    //

    protected $table = 'Users';
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
