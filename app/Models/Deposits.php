<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposits extends Model
{
    protected $fillable = [
        'user_id', 'authorized_by', 'authorized','amount','check_image','created_at',
    ];

    /**
     * Returns user who made the deposit
     * @author   Wagner Silveira <wagner.resta@outlook.com>
     */
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Return user who approved the Deposit
     * @author   Wagner Silveira <wagner.resta@outlook.com>
     */
    public function authorizedBy(){
        return $this->belongsTo(User::class,'authorized_by');
    }
}
