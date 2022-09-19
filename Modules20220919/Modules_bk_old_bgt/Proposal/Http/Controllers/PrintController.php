<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use PDF;
use Auth;
use DataTables;

use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxPemohon;
use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalTimeline;
use App\Models\PublicTrxProsesStatus;
use App\Models\PublicTrxMitraKemaslahatan;
use App\Models\PublicTrxProposalPejabatRekomendasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrintController extends Controller
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
        if ($id) {
            $filename_page 	= 'detail';
            $title 			= 'Detail Proposal';
            $proposal       = PublicTrxProposal::join('trx_proses_status','trx_proses_status.trx_proses_status_id','trx_proposal.proses_st')->find($id);
            $pemohon        = PublicTrxPemohon::find($proposal->trx_pemohon_id);
            $userPemohon    = AuthUser::where('default_key',$proposal->trx_pemohon_id)->first();
            $banks          = ComBank::all();
            $disposisi      = PublicTrxProposalTimeline::join('trx_proses_status','trx_proses_status.trx_proses_status_id','trx_proposal_timeline.status')->where('trx_proposal_id',$id)
                                ->select(
                                    "trx_proposal_timeline_id",
                                    "trx_proposal_id",
                                    "timeline_by",
                                    "status",
                                    "file_asesmen",
                                    "note",
                                    "trx_proposal_timeline.created_at",
                                    "trx_proses_status_id",
                                    "proses_nm",
                                    "proses_next_yes",
                                    "proses_next_no",
                                    "proses_form_title",
                                    "proses_btn_yes_title",
                                    "proses_btn_no_title",
                                    "proses_file_nm",
                                    "proses_roles"
                                )->orderBy('trx_proposal_timeline.created_at', 'DESC')->get();
            $lastStatus         = PublicTrxProposalTimeline::getLastStatus($id);
            $status             = PublicTrxProsesStatus::getStatus($id);
            $rekomendasiPejabat = PublicTrxProposalPejabatRekomendasi::where('trx_proposal_id', $id)->first();
            // dd($rekomendasiPejabat);
            \LogActivity::saveLog(
                $logTp = 'visit', 
                $logNm = "Membuka Menu $title $id"
            );

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal', 'pemohon','userPemohon','banks','disposisi','lastStatus', 'status','rekomendasiPejabat'));
        }else{
            $filename_page 	= 'index';
            $title 			= 'Proposal';
            
            \LogActivity::saveLog(
                $logTp = 'visit', 
                $logNm = "Membuka Menu $title"
            );

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title'));
        }
    }

    function sk($id){
        $data       = PublicTrxProposal::join('trx_proses_status','trx_proses_status.trx_proses_status_id','trx_proposal.proses_st')
                    ->leftJoin('trx_mitra_kemaslahatan','trx_mitra_kemaslahatan.trx_mitra_kemaslahatan_id','trx_proposal.trx_mitra_kemaslahatan_id')
                    ->find($id);

        if ($data) {
            $resultName = date('Ymd_His')."_SK_$id.pdf";

            $view       = view('proposal::print.sk.pelayanan-haji', compact('data'))->render();
            // return $view;
            $pdf        = PDF::loadHtml($view);
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'setIsRemoteEnabled' => true]);
            $pdf->setPaper('Legal', 'potrait');
            return $pdf->stream($resultName);
        }else{
            return redirect()->back()->with('error',"Tidak ada data yang sesuai dengan kriteria yang dipilih");
        }
    }

    function ringkasan($id){
        $data       = PublicTrxProposal::join('trx_proses_status','trx_proses_status.trx_proses_status_id','trx_proposal.proses_st')
                    ->leftJoin('trx_mitra_kemaslahatan','trx_mitra_kemaslahatan.trx_mitra_kemaslahatan_id','trx_proposal.trx_mitra_kemaslahatan_id')
                    ->find($id);

        if ($data) {
            $resultName = date('Ymd_His')."_SK_$id.pdf";

            $view       = view('proposal::print.ringkasan.ringkasan', compact('data'))->render();
            // return $view;
            $pdf        = PDF::loadHtml($view);
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'setIsRemoteEnabled' => true]);
            $pdf->setPaper('Legal', 'potrait');
            return $pdf->stream($resultName);
        }else{
            return redirect()->back()->with('error',"Tidak ada data yang sesuai dengan kriteria yang dipilih");
        }
    }

    function spjtm($id){
        $data       = PublicTrxProposal::join('trx_proses_status','trx_proses_status.trx_proses_status_id','trx_proposal.proses_st')
                    ->leftJoin('com_bank','com_bank.bank_cd','trx_proposal.bank_cd')
                    ->leftJoin('trx_mitra_kemaslahatan','trx_mitra_kemaslahatan.trx_mitra_kemaslahatan_id','trx_proposal.trx_mitra_kemaslahatan_id')
                    ->find($id);

        if ($data) {
            $resultName = date('Ymd_His')."_SPJTM_$id.pdf";

            $view       = view('proposal::print.spjtm.spjtm', compact('data'))->render();
            // return $view;
            $pdf        = PDF::loadHtml($view);
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'setIsRemoteEnabled' => true]);
            $pdf->setPaper('Legal', 'potrait');
            return $pdf->stream($resultName);
        }else{
            return redirect()->back()->with('error',"Tidak ada data yang sesuai dengan kriteria yang dipilih");
        }
    }

    function pks($id){
        $data       = PublicTrxProposal::join('trx_proses_status','trx_proses_status.trx_proses_status_id','trx_proposal.proses_st')
                    ->leftJoin('com_bank','com_bank.bank_cd','trx_proposal.bank_cd')
                    ->leftJoin('trx_mitra_kemaslahatan','trx_mitra_kemaslahatan.trx_mitra_kemaslahatan_id','trx_proposal.trx_mitra_kemaslahatan_id')
                    ->find($id);

        if ($data) {
            $resultName = date('Ymd_His')."_SPJTM_$id.pdf";

            $view       = view('proposal::print.pks.pks', compact('data'))->render();
            // return $view;
            $pdf        = PDF::loadHtml($view);
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'setIsRemoteEnabled' => true]);
            $pdf->setPaper('A4', 'potrait');
            return $pdf->stream($resultName);
        }else{
            return redirect()->back()->with('error',"Tidak ada data yang sesuai dengan kriteria yang dipilih");
        }
    }
}
