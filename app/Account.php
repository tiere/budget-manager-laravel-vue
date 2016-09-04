<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['name', 'description'];
    protected $visile   = ['id', 'name', 'description'];
}
