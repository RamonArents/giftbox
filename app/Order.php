<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    /**
     * The relation to the Ticket table
     *
     * @return void
     */
    public function Ticket(){
        $this->hasMany(App::Ticket);
    }
}
