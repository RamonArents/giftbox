<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GregoryDuckworth\Encryptable\EncryptableTrait;


class Ticket extends Model
{
    //The ticket codes should be encrypted, otherwise anyone can use them
    use EncryptableTrait;

    protected $table = 'tickets';

    /**
     * Encryptable Rules
     *
     * @var array
     */
    protected $encryptable = [
        'orderNumber',
    ];

}
