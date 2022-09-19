<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalFiles;
use App\Models\PublicTrxPemohon;
use App\Models\PublicTrxMitraKemaslahatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;

class ProposalFilesController extends Controller
{
    private $folder_path = '';
    
    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Index
     *
     * @return \Illuminate\Http\Response
     */
    function index($id = NULL){
        $filename_page 	= 'detail';
        $title 			= 'File Proposal';

        $proposalFile = PublicTrxProposalFiles::select(
            'trx_proposal_files_id',
            'trx_proposal_id',
            'file_tp',
            'filetp.code_nm as file_tp_nm',
            'file_ext',
            'file_path',
            'note'
        )
        ->leftJoin('public.com_code as filetp','filetp.com_cd','trx_proposal_files.file_tp')
        ->find($id);

        \LogActivity::saveLog(
            $logTp = 'visit', 
            $logNm = "Download $title $proposalFile->file_tp_nm"
        );

        return response()->download(storage_path("app/public/proposal-file/$proposalFile->file_path"), "$proposalFile->file_tp_nm.$proposalFile->file_ext");
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicTrxProposalFiles::select(
                    'trx_proposal_files_id',
                    'trx_proposal_id',
                    'file_tp',
                    'filetp.code_nm as file_tp_nm',
                    'file_ext',
                    'file_path',
                    'filetp.code_value as required_st',
                    'note'
                )
                ->leftJoin('public.com_code as filetp','filetp.com_cd','trx_proposal_files.file_tp')
                ->where(function($query) use($request){
                   $query->where('trx_proposal_id',$request->id);
                });

        return DataTables::of($data)
            ->editColumn('file_tp_nm', function($data){
                return $data->file_tp_nm.($data->required_st == '1' ? ' <span class="text-danger">*</span>' : '');
            })
            ->addColumn('actions', function($data){
                $actions = '';
                if ($data->file_path) {
                    $actions .= "<button type='button' class='upload-file btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Upload Ulang File'><i class='icon icon-upload'></i></button> &nbsp";

                    $actions .= "<button type='button' class='download-file btn btn-primary btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Download File'><i class='icon icon-download'></i></button> &nbsp";
                    $actions .= "<button type='button' class='preview-file btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Preview File'><i class='icon icon-eye'></i></button> &nbsp";
                }else{
                    // if (isRoleUser('pemohon')) {
                        $actions .= "<button type='button' class='upload-file btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Upload File'><i class='icon icon-upload'></i></button> &nbsp";
                    // }
                }
    
                return $actions;
            })
            ->rawColumns(['file_tp_nm','actions'])
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
        try {
            $this->validate($request,[
                'proposal_id'   => 'required',
                'proposal_file' => 'required',
            ]);

            DB::beginTransaction();
                $name = NULL;
                $proposalFile               = PublicTrxProposalFiles::find($request->proposal_id);
                $oldData = $proposalFile;

                $proposalFile->note         = $request->file_note;

                if($request->hasFile('proposal_file')) {
                    $file = $request->file('proposal_file');
                    $name = Uuid::uuid4().".".$file->getClientOriginalExtension();
                    $image['filePath'] = $name;     
                    $file->move(storage_path('app/public/proposal-file/'), $name);
                    
                    $proposalFile->file_path    = $name;
                    $proposalFile->file_ext     = strtoupper($file->getClientOriginalExtension());
                }

                $proposalFile->updated_by   = Auth::user()->user_id;
                $proposalFile->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Upload Dokumen Proposal $request->proposal_id", 
                $table      = $proposalFile->getTable(), 
                $newData    = $proposalFile,
                $oldData    = $oldData
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
     * @return \Illuminate\Http\Response
     */
    function update(Request $request){
        try {
            $this->validate($request,[
                'proposal_id'   => 'required',
                'file_note' => 'nullable',
            ]);

            DB::beginTransaction();
                $name = NULL;
                $proposalFile               = PublicTrxProposalFiles::find($request->proposal_id);
                $oldData = $proposalFile;

                $proposalFile->note         = $request->file_note;

                $proposalFile->updated_by   = Auth::user()->user_id;
                $proposalFile->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Ubah Dokumen Proposal $request->proposal_id", 
                $table      = $proposalFile->getTable(), 
                $newData    = $proposalFile,
                $oldData    = $oldData
            );
 
            return response()->json(['status' => 'ok'],200); 
 
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
