<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VwNotif extends Model
{
    protected $table        = 'vw_notif';
    protected $primaryKey   = 'trx_proposal_id'; 
    public $incrementing    = false;
}
