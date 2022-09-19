<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\PublicTrxMitraKemaslahatan;
use App\Models\ComRegion;
use App\Models\ComCode;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxKuotaProposal
 *
 * @property string $trx_kuota_proposal_id
 * @property int $trx_year
 * @property string $region_cd
 * @property string|null $ruang_lingkup
 * @property string $kuota
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal whereKuota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal whereRegionCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal whereRuangLingkup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal whereTrxKuotaProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal whereTrxYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxKuotaProposal whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxKuotaProposal extends Model
{
    use Uuid;
    protected $table            = 'public.trx_kuota_proposal';
    private static $tableName   = 'public.trx_kuota_proposal';
    protected $primaryKey       = 'trx_kuota_proposal_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_kuota_proposal_id',
        'trx_year',
        'kuota_cd',
        'kuota_tp',
        'kuota',
        'created_by',
        'updated_by'
    ];

    static function checkKuota($kuotaCd, $kuotaTp, $nominal)
    {
        $kuota = PublicTrxKuotaProposal::where('kuota_cd', $kuotaCd)
                ->where('trx_year', date('Y'))
                ->where('kuota_tp', $kuotaTp)
                ->select(
                    "kuota"
                )
                ->first();
        
        if ($kuotaTp == 'wilayah') {
            $semua = PublicTrxProposal::where('kuota_wilayah', $kuotaCd)
                    ->select(
                        DB::Raw("sum(nominal) as nominal")
                    )
                    ->groupBy("kuota_wilayah")
                    ->first();
        }else{
            $semua = PublicTrxProposal::where('kuota_ruang_lingkup', $kuotaCd)
                    ->select(
                        DB::Raw("sum(nominal) as nominal")
                    )
                    ->groupBy("kuota_ruang_lingkup")
                    ->first();
        }

        $selisih = ($kuota ? $kuota->kuota : 0 ) - ($semua ? $semua->nominal : 0);
        // dd($selisih);
        if ($selisih > 0 && $selisih >= $nominal) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    static function createKuota(){
        try {
            DB::beginTransaction();

            $mitra          = PublicTrxMitraKemaslahatan::all();
            foreach ($mitra as $item) {
                $kuotaproposal          = new PublicTrxKuotaProposal;
                $kuotaproposal->trx_year    = date('Y');
                $kuotaproposal->kuota_cd    = $item->trx_mitra_kemaslahatan_id;
                $kuotaproposal->kuota_tp    = 'mitra';
                $kuotaproposal->kuota       = 0;
                $kuotaproposal->created_by  = "COMMAND";
                $kuotaproposal->save();
    
                \LogActivity::saveLog(
                    $logTp      = 'update', 
                    $logNm      = "Menambah Data Kuota Mitra $item->trx_mitra_kemaslahatan_id", 
                    $table      = $kuotaproposal->getTable(), 
                    $newData    = $kuotaproposal
                );
            }

            $wilayah        = ComRegion::where('region_level',1)->get();
            foreach ($wilayah as $item) {
                $kuotaproposal              = new PublicTrxKuotaProposal;
                $kuotaproposal->trx_year    = date('Y');
                $kuotaproposal->kuota_cd    = $item->region_cd;
                $kuotaproposal->kuota_tp    = 'wilayah';
                $kuotaproposal->kuota       = 0;
                $kuotaproposal->created_by  = "COMMAND";
                $kuotaproposal->save();
    
                \LogActivity::saveLog(
                    $logTp      = 'update', 
                    $logNm      = "Menambah Data Kuota Wilayah $item->trx_mitra_kemaslahatan_id", 
                    $table      = $kuotaproposal->getTable(), 
                    $newData    = $kuotaproposal
                );
            }

            $ruangLingkup   = ComCode::where('code_group','RUANG_LINGKUP')->get();
            foreach ($ruangLingkup as $item) {
                $kuotaproposal              = new PublicTrxKuotaProposal;
                $kuotaproposal->trx_year    = date('Y');
                $kuotaproposal->kuota_cd    = $item->com_cd;
                $kuotaproposal->kuota_tp    = 'ruanglingkup';
                $kuotaproposal->kuota       = 0;
                $kuotaproposal->created_by  = "COMMAND";
                $kuotaproposal->save();
    
                \LogActivity::saveLog(
                    $logTp      = 'update', 
                    $logNm      = "Menambah Data Kuota Ruang Lingkup $item->trx_mitra_kemaslahatan_id", 
                    $table      = $kuotaproposal->getTable(), 
                    $newData    = $kuotaproposal
                );
            }
            
            DB::commit();
            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        
    }
}
