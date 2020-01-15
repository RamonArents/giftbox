<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Code extends Model
{
    use SoftDeletes;

    protected $table = 'codes';

    /**
     * The relation to the Order table
     *
     * @return void
     */
    public function Order(){
        $this->belongsTo(App::Order);
    }

}
