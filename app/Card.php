<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    //use SoftDeletes to prevent deleting all data
    use SoftDeletes;
    //table name is codes. This should be changed if the table name is changed.
    protected $table = 'card';
}
