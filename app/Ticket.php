<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ticket extends Model
{
    use SoftDeletes;

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
