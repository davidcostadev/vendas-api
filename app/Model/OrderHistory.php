<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $fillable = ['order_id', 'status_id', 'date_event'];

    public function order() {
        return $this->belongsTo('App\Model\Order');
    }

    public function status() {
        return $this->belongsTo('App\Model\Status');
    }

    protected function serializeDate(\DateTimeInterface $date) {
        return $date->getTimestamp();
    }
}
