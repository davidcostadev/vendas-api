<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $filltable = ['name', 'description', 'price'];

    public function orders() {
        return $this->hasMany('App\Model\Order');
    }

    protected function serializeDate(\DateTimeInterface $date) {
        return $date->getTimestamp();
    }
}
