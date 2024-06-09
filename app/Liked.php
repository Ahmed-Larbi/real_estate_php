<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liked extends Model
{

    protected $fillable = [
        'property_id',
        'account_id'
    ];

    public function property()
    {
        return $this->belongsTo(Post::class, 'property_id');
    }
}
