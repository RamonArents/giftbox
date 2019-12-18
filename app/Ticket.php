<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{

    protected $table = 'tickets';

    public function Order(){
        $this->belongsTo(App::Order);
    }

}
