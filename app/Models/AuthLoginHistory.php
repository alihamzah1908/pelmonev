<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AuthLoginHistory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AuthLoginHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthLoginHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthLoginHistory query()
 * @mixin \Eloquent
 */
class AuthLoginHistory extends Model{
    protected $table        = 'auth.login_history';
    protected $primaryKey   = 'login_history_id'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'user_id','jwt_token','datetime_login','datetime_logout','ip_address','mac_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
