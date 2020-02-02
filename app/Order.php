<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //use SoftDeletes to prevent deleting all data
    use SoftDeletes;
    //table name is orders. This should be changed if the table name is changed.
    protected $table = 'orders';

    /**
     * The relation to the codes table (1 to many)
     *
     * @return void
     */
    public function Code(){
        $this->hasMany(App::Code);
    }
}
