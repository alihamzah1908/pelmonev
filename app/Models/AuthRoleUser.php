<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AuthRoleUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AuthRoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthRoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthRoleUser query()
 * @mixin \Eloquent
 */
class AuthRoleUser extends Model{
    protected $table        = 'auth.role_users';
    protected $primaryKey   = 'user_id';
    public $incrementing    = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'user_id',
       'role_cd', 
       'created_by',
       'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
