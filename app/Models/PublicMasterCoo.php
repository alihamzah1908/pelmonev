<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PublicMasterCoo extends Model
{
    use Uuid;

    protected $table            = 'public.master_coo';
    private static $tableName   = 'public.master_coo';
    protected $primaryKey       = 'coo_id';
    public $incrementing        = false;

    protected $fillable = [
        'coo_id',
        'coo_desc',
        'created_by',
        'updated_by'
    ];
}
