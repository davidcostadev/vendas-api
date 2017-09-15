<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $filltable = ['name'];

    protected function serializeDate(\DateTimeInterface $date) {
        return $date->getTimestamp();
    }
}
