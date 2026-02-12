<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
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
