<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogBalance extends Model
{
    protected $table = "log_balance";
    protected $fillable = [
        'type', 'amount', 'previous_balance','new_balance','deposit_id','buy_id','user_id'
    ];

    /**
     * Returns the user that the log belongs to
     * @author   Wagner Silveira <wagner.resta@outlook.com>
     */
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Returns the deposit the log belongs to
     * @author   Wagner Silveira <wagner.resta@outlook.com>
     */
    public function deposit(){
        return $this->belongsTo(Deposits::class,'deposit_id');
    }

     /**
     * Returns the purchase that the log belongs to
     * @author   Wagner Silveira <wagner.resta@outlook.com>
     */
    public function buy(){
        return $this->belongsTo(Buys::class,'buy_id');
    }
}
