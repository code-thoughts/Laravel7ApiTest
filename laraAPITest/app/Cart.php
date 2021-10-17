<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'carts';
    protected $fillable = [
        'created_at', 'updated_at', 'product','country','user_id'
    ];
}
