<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $casts = [
        'author' => 'array'
    ];

    public $timestamps = false;
    protected $fillable = ['title', 'description', 'author'];

    public function setCreatedAtAttribute($value) {
        $this->attributes['created_at'] = \Carbon\Carbon::now();
    }
}

