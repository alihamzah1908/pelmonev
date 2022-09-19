<?php

namespace Modules\Proposal\Http\Controllers\ProposalMonitoring;

use DB;
use Auth;
use DataTables;

use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxProposalLaporanMonitoring;

use App\Models\PublicTrxPemohon;
use App\Models\PublicTrxProposalTimeline;
use App\Models\PublicTrxMitraKemaslahatan;
use App\Models\PublicTrxProposalLayakTeknis;
use App\Models\ComCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalLaporanMonitoringController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicTrxProposalLaporanMonitoring::select(
                    'trx_proposal_id',
                    'jenis_kegiatan',
                    'nama_kegiatan',
                    'metode_pelaksanaan',
                    'tanggal_monitoring',
                    'periode_monitoring',
                    'bukti_foto_monitoring',
                    'kesimpulan_monitoring',
                    'status',
                    'created_at',
                    'created_by',
                    'updated_at',
                    'updated_by'
                )
                ->where(function($query) use($request){
                    $query->where('trx_proposal_id', $request->id);

                    if ($request->has('periode')) {
                        $query->where('periode_monitoring', $request->periode);
                    }

                    $query->where('status',$request->status);
                });

        return DataTables::of($data)
            ->addColumn('actions', function($data){
                $actions = '';
                if (isRoleUser('regas')) {
                    // $actions .= "<button type='button' class='lengkapi-proposal btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Lengkapi Proposal'><i class='icon icon-stack-check'></i> </button> &nbsp";
                }
    
                return $actions;
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
        // return $request->all();
        try {
            DB::beginTransaction();
            $photos = [];

            $proposal                       = new PublicTrxProposalLaporanMonitoring;
            $proposal->trx_proposal_id      = $request->trx_proposal_id;
            $proposal->jenis_kegiatan       = $request->laporan_jenis_kegiatan;
            $proposal->nama_kegiatan        = $request->laporan_nama_kegiatan;
            $proposal->metode_pelaksanaan   = $request->laporan_metode_pelaksanaan;
            $proposal->tanggal_monitoring   = formatDate($request->laporan_tanggal_monitoring);
            $proposal->periode_monitoring   = $request->laporan_periode_monitoring;

            if($request->hasFile('laporan_bukti_foto_monitoring')) {

                foreach ($request->file('bukti_foto_monitoring') as $file) { 
                    $name               = Uuid::uuid4().".".$file->getClientOriginalExtension();
                    $image['filePath']  = $name;     
                    $file->move(storage_path('app/public/proposal-file/'), $name);
                    array_push($photos,$name);
                }

                $proposal->bukti_foto_monitoring = json_encode($photos);
            }

            $proposal->note                 = $request->note;
            $proposal->status               = $request->status;
            $proposal->created_by           = Auth::user()->user_id;
            $proposal->save();
            
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Membuat Proposal Laporan Monitoring", 
                $table      = $proposal->getTable(), 
                $newData    = $proposal
            );
 
            return response()->json(['status' => 'ok'],200); 
 
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
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

            $proposal                       = PublicTrxProposalLaporanMonitoring::find($id);
            $oldData = $proposal;

            $proposal->jenis_kegiatan       = $request->jenis_kegiatan;
            $proposal->nama_kegiatan        = $request->nama_kegiatan;
            $proposal->metode_pelaksanaan   = $request->metode_pelaksanaan;
            $proposal->tanggal_monitoring   = formatDate($request->tanggal_monitoring);
            $proposal->periode_monitoring   = $request->periode_monitoring;
            $proposal->note                 = $request->note;
            $proposal->updated_by           = Auth::user()->user_id;
            $proposal->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Proposal Laporan Monitoring $id", 
                $table      = $proposal->getTable(), 
                $oldData    = $oldData, 
                $newData    = $proposal
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
