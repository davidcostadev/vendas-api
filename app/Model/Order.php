<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $filltable = ['product_id', 'user_id', 'quant'];

    public function product() {
        return $this->belongsTo('App\Model\Product');
    }

    public function user() {
        return $this->belongsTo('App\Model\User');
    }

    public function order_histories() {
        return $this->hasMany('App\Model\OrderHistory');
    }

    protected function serializeDate(\DateTimeInterface $date) {
        return $date->getTimestamp();
    }
}
