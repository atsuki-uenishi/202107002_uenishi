<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'uuid' => 'required',
    );


    public function order_details()
    {
        return $this->hasMany("App\Models\Order_detail");
    }


}
