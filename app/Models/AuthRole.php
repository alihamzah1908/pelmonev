<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AuthRole
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AuthRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthRole query()
 * @mixin \Eloquent
 */
class AuthRole extends Model{
    protected $table        = 'auth.roles';
    protected $primaryKey   = 'role_cd'; 
    public $incrementing    = false;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'role_cd', 'role_nm','rule_tp','created_by','updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
