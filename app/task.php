<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $table = 'tasks';
    protected $filltable = [
        'name'
    ]
    protected $guarded;
    \App \Author::create (['name' => 'aiueo']);
}
