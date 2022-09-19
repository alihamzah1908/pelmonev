<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PublicTrxProsesStatus
 *
 * @property string $trx_proses_status_id
 * @property string $proses_nm
 * @property string|null $proses_next_yes
 * @property string|null $proses_next_no
 * @property string|null $proses_form_title
 * @property string|null $proses_btn_yes_title
 * @property string|null $proses_btn_no_title
 * @property string|null $proses_file_nm
 * @property mixed|null $proses_roles
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereProsesBtnNoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereProsesBtnYesTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereProsesFileNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereProsesFormTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereProsesNextNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereProsesNextYes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereProsesNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereProsesRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereTrxProsesStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProsesStatus whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProsesStatus extends Model
{
    protected $table            = 'public.trx_proses_status';
    private static $tableName   = 'public.trx_proses_status';
    protected $primaryKey       = 'trx_proses_status_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proses_status_id',
        'proses_nm',
        'proses_next_yes',
        'proses_next_no',
        'proses_form_title',
        'proses_btn_yes_title',
        'proses_btn_no_title',
        'proses_file_nm',
        'proses_roles',
        'created_by',
        'updated_by'
    ];

    static function getStatus($id)
    {
        $proposal   = PublicTrxProposal::find($id);
        $data       = PublicTrxProsesStatus::find($proposal->proses_st);
        if ($data) {
            if (in_array(roleUser(),json_decode($data->proses_roles))) {
                // dd($data);
                return $data;
            }
        }
        return NULL;
    }

    static function getProsesName($id){
        $data = PublicTrxProsesStatus::find($id);

        if ($data) {
            return $data->proses_nm;
        }else{
            return "NOT_FOUND";
        }
    }
}
