<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected  $fillable=[
        'first_name',
        'last_name',
        'email',
        'job_title',
        'adress',
        'avatar',
        'isdeleted'
    ];
}
