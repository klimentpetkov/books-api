<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $casts = [
        'author' => 'array'
    ];

    public $timestamps = false;

    protected $fillable = ['title', 'description', 'author', 'created_at'];
}

