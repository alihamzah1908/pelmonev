<?php

namespace Modules\KuotaProposal\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxKuotaProposal;
// use App\Models\PublicKuotaProposal;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KuotaWilayahController extends Controller
{
    private $folder_path = '';
    private $kuotaTp     = 'wilayah';

    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Index
     *
     * @return \Illuminate\Http\Response
     */
    function index($id = NULL){
        $filename_page 	= "index-$this->kuotaTp";
        $title 			= 'Kuota Wilayah';
        
        \LogActivity::saveLog(
            $logTp = 'visit', 
            $logNm = "Membuka Menu $title"
        );

        return view('kuotaproposal::' . $this->folder_path . '.' . $filename_page, compact('title'));
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicTrxKuotaProposal::leftJoin('public.com_region as prop','prop.region_cd','trx_kuota_proposal.kuota_cd')
                ->select(
                    "trx_kuota_proposal_id",
                    "trx_year",
                    "trx_kuota_proposal.kuota_cd",
                    DB::Raw("prop.region_nm as kuota_nm"),
                    "kuota"
                )
                ->where(function ($query) use($request)
                {
                    $query->where('kuota_tp',$this->kuotaTp);

                    if ($request->nama) {
                        $query->where("prop.region_nm", "ILIKE" ,'%'.$request->nama.'%');
                    }

                    if ($request->has('tahun')) {
                        $query->where('trx_year',$request->tahun);
                    }else{
                        $query->where('trx_year',date('Y'));
                    }
                })
                ;

        return DataTables::of($data)
        ->addColumn('actions', function($data){
            $actions = '';
            // $actions .= "<button type='button' class='detail btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='detail'><i class='icon icon-enlarge'></i> </button> &nbsp";
            $actions .= "<button type='button' class='ubah btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Ubah Data'><i class='icon icon-pencil'></i> </button> &nbsp";
            // $actions .= "<button type='button' class='hapus btn btn-danger btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Hapus Data'><i class='icon icon-trash'></i> </button> &nbsp";
            
            return $actions;
        })
        ->editColumn('kuota',function($data){
            return round($data->kuota);
        })
        ->rawColumns(['actions'])
        ->addIndexColumn()
        ->make(true);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(Request $request, $id){
        try {
            DB::beginTransaction();

            $kuotaproposal                = PublicTrxKuotaProposal::find($id);
            $oldData = $kuotaproposal;

            $kuotaproposal->kuota = uang($request->kuota);

            $kuotaproposal->updated_by    = Auth::user()->user_id;
            $kuotaproposal->save();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Kuota Proposal $id", 
                $table      = $kuotaproposal->getTable(), 
                $oldData    = $oldData, 
                $newData    = $kuotaproposal
            );
            DB::commit();
            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

}
