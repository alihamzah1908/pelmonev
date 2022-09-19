<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AuthPasswordResets
 *
 * @property string $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|AuthPasswordResets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthPasswordResets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthPasswordResets query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthPasswordResets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthPasswordResets whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthPasswordResets whereToken($value)
 * @mixin \Eloquent
 */
class AuthPasswordResets extends Model{
    protected $table        = 'auth.password_resets';
    protected $primaryKey   = 'email'; 
    public $incrementing    = false;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'email', 'token','created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
