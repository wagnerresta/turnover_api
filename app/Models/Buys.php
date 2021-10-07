<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buys extends Model
{
    protected $fillable = [
        'user_id', 'description','amount','created_at',
    ];

    /**
     * Returns user who made the buy
     * @author   Wagner Silveira <wagner.resta@outlook.com>
     */
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }


}
