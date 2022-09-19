<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\LogLogActivity
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LogLogActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogLogActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogLogActivity query()
 * @mixin \Eloquent
 */
class LogLogActivity extends Model
{
    use Uuid;

    protected $table        = 'log.log_activity';
    protected $primaryKey   = 'log_activity_id'; 
    public $incrementing    = false;

    protected $fillable = [
        'log_activity_id',
        'user_id',
        'log_tp',
        'log_nm',
        'table',
        'old_data',
        'new_data',
        'ip_address',
        'user_agent',
        'note',
        'created_by',
        'updated_by',
    ];

    
}
