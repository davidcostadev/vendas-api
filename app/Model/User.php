<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $filltable = ['name', 'email'];

    public function orders() {
        return $this->hasMany('App\Model\Order');
    }

    protected function serializeDate(\DateTimeInterface $date) {
        return $date->getTimestamp();
    }
}
