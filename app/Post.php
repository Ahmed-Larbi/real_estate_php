<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'name',
        'pictures',
        'phone_number',
        'sell_or_rent',
        'account_id',
        'size',
        'address'
    ];

    /**
     * Get the account that owns the post.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

}