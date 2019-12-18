<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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
