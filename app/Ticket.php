<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{

    protected $table = 'tickets';

    /**
     * The relation to the Order table
     *
     * @return void
     */
    public function Order(){
        $this->belongsTo(App::Order);
    }

}
