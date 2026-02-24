<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

    use SoftDeletes;
     protected $fillable = [
        'first_name',
        'email',
        'phone',
        'last_name',
        'image',
        'bank_account_number',
        'about'
    ];
}
