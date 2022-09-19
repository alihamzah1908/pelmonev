<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PublicTrxAssessmentMk extends Model
{
    use Uuid;

    protected $table            = 'public.trx_assessment_mk';
    private static $tableName   = 'public.trx_assessment_mk';
    protected $primaryKey       = 'trx_assessment_mk_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_assessment_mk_id',
        'trx_proposal_id',
        'photo',
        'uji_kelayakan',
        'summary_assess'
    ];
}
