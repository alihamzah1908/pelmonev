<?php

namespace Modules\Proposal\Http\Controllers\ProposalPengajuan;

use App\Models\AuthUser;
use App\Models\ComCode;
use Auth;
use DB;
use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalFiles;
use App\Models\PublicTrxProposalLayakTeknis;
use App\Models\PublicTrxProposalLayakTeknisAnalisa;
use App\Models\PublicTrxProposalLayakTeknisDeskripsi;
use App\Models\PublicTrxProposalLayakTeknisPelaksanaanPenilaian;
use App\Models\PublicTrxProposalPenilaian;
use App\Models\PublicTrxProposalTimeline;
use Faker\Provider\Uuid;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProposalUploadController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('proposal::proposal-pengajuan.upload');    
    }

    function store(Request $request){
        try {
            DB::beginTransaction();

            $proposal                  = new PublicTrxProposal();
            $proposal->trx_pemohon_id  = Auth::user()->default_key;
            $proposal->proses_st       = 'PROSES_01D';
            
            if (isRoleUser('mitra')) {
                $proposal->trx_mitra_kemaslahatan_id = Auth::user()->default_key;
            }
            
            $proposal->created_by      = Auth::user()->user_id;
            $proposal->save();

            if($request->hasFile('file_short_proposal')) {
                $file               = $request->file('file_short_proposal');
                $name               = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $image['filePath']  = $name;     
                $file->move(storage_path('app/public/proposal-file/'), $name);

                $saveFile                   = new PublicTrxProposalFiles();
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = 'FILE_TP_05';
                $saveFile->file_ext         = $file->getClientOriginalExtension();
                $saveFile->file_path        = $name;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            if($request->hasFile('file_akte_pendirian')) {
                $file               = $request->file('file_akte_pendirian');
                $name               = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $image['filePath']  = $name;     
                $file->move(storage_path('app/public/proposal-file/'), $name);

                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = 'FILE_TP_09';
                $saveFile->file_ext         = $file->getClientOriginalExtension();
                $saveFile->file_path        = $name;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            if($request->hasFile('file_akte_perubahan')) {
                $file               = $request->file('file_akte_perubahan');
                $name               = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $image['filePath']  = $name;     
                $file->move(storage_path('app/public/proposal-file/'), $name);

                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = 'FILE_TP_10';
                $saveFile->file_ext         = $file->getClientOriginalExtension();
                $saveFile->file_path        = $name;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            if($request->hasFile('file_sk_pendirian')) {
                $file               = $request->file('file_sk_pendirian');
                $name               = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $image['filePath']  = $name;     
                $file->move(storage_path('app/public/proposal-file/'), $name);

                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = 'FILE_TP_11';
                $saveFile->file_ext         = $file->getClientOriginalExtension();
                $saveFile->file_path        = $name;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            if($request->hasFile('file_sk_perubahan')) {
                $file               = $request->file('file_sk_perubahan');
                $name               = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $image['filePath']  = $name;     
                $file->move(storage_path('app/public/proposal-file/'), $name);

                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = 'FILE_TP_12';
                $saveFile->file_ext         = $file->getClientOriginalExtension();
                $saveFile->file_path        = $name;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            PublicTrxProposalTimeline::insertTimeline($proposal->trx_proposal_id, Auth::user()->user_nm, 'PROSES_01', '', '');
            PublicTrxProposalTimeline::insertTimeline($proposal->trx_proposal_id, Auth::user()->user_nm, $proposal->proses_st, '', '');
            PublicTrxProposalLayakTeknis::insertLayakTeknis($proposal->trx_proposal_id);
            PublicTrxProposalPenilaian::insertPenilaian($proposal->trx_proposal_id);
            PublicTrxProposalLayakTeknisAnalisa::insertLayakTeknisAnalisa($proposal->trx_proposal_id);
            PublicTrxProposalLayakTeknisDeskripsi::insertLayakTeknisDeskripsi($proposal->trx_proposal_id);
            PublicTrxProposalLayakTeknisPelaksanaanPenilaian::insertLayakTeknisPelaksanaanPenilaian($proposal->trx_proposal_id);

            $files = ComCode::where('code_group','FILE_TP')->whereNotIn('com_cd',['FILE_TP_05','FILE_TP_09','FILE_TP_10','FILE_TP_11','FILE_TP_12'])->get();
            
            foreach ($files as $item) {
                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = $item->com_cd;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            $user               = AuthUser::find(Auth::user()->user_id);
            $user->phone        = $request->phone;
            $user->updated_by   = Auth::user()->user_id;
            $user->save();
            
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Upload Proposal", 
                $table      = $proposal->getTable(), 
                $newData    = $proposal
            );
 
            return redirect('proposal-penerima-manfaat')->with('success', 'Berhasil Kirim Proposal');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
