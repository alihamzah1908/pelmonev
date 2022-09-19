<?php

namespace Modules\Pemohon\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxPemohon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PemohonController extends Controller
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
        if ($id || isRoleUser('pemohon')) {
            isRoleUser('pemohon') ? $id = Auth::user()->default_key : $id = $id;
            $filename_page 	= 'detail';
            $title 			= 'Detail Pemohon';
            $pemohon        = PublicTrxPemohon::find($id);
            $userPemohon    = AuthUser::where('default_key',$id)->first();
            $banks          = ComBank::all();
            
            \LogActivity::saveLog(
                $logTp = 'visit', 
                $logNm = "Membuka Menu $title $id"
            );

            return view('pemohon::' . $this->folder_path . '.' . $filename_page, compact('title', 'pemohon','userPemohon','banks'));
        }else{
            $filename_page 	= 'index';
            $title 			= 'Pemohon';
            
            \LogActivity::saveLog(
                $logTp = 'visit', 
                $logNm = "Membuka Menu $title"
            );

            return view('pemohon::' . $this->folder_path . '.' . $filename_page, compact('title'));
        }
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicTrxPemohon::where(function($query) use($request){
            if ($request->nama) {
                $query->where("pemohon_nm", "ILIKE" ,'%'.$request->nama.'%');
            }
        });

        return DataTables::of($data)
        ->addColumn('actions', function($data){
            $actions = '';
            $actions .= "<button type='button' class='detail btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='detail'><i class='icon icon-enlarge'></i> </button> &nbsp";
            // $actions .= "<button type='button' class='ubah btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Ubah Data'><i class='icon icon-pencil'></i> </button> &nbsp";
            // $actions .= "<button type='button' class='hapus btn btn-danger btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Hapus Data'><i class='icon icon-trash'></i> </button> &nbsp";
            
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(Request $request, $id){
        try {
            DB::beginTransaction();

            $pemohon                = PublicTrxPemohon::find($id);
            $oldData = $pemohon;
            
            if($request->has('pemohon_nm')) $pemohon->pemohon_nm = $request->pemohon_nm;
            if($request->has('region_prop')) $pemohon->region_prop = $request->region_prop;
            if($request->has('region_kab')) $pemohon->region_kab = $request->region_kab;
            if($request->has('region_kel')) $pemohon->region_kel = $request->region_kel;
            if($request->has('region_kec')) $pemohon->region_kec = $request->region_kec;
            if($request->has('phone')) $pemohon->phone = $request->phone;
            if($request->has('address')) $pemohon->address = $request->address;

            if($request->has('pemohon_latitude')) $pemohon->pemohon_latitude = $request->pemohon_latitude;
            if($request->has('pemohon_longitude')) $pemohon->pemohon_longitude = $request->pemohon_longitude;

            if($request->has('akta_pendirian')) $pemohon->akta_pendirian = $request->akta_pendirian;
            if($request->has('akta_perubahan_terakhir')) $pemohon->akta_perubahan_terakhir = $request->akta_perubahan_terakhir;
            if($request->has('sk_pengesahan_pendirian_no')) $pemohon->sk_pengesahan_pendirian_no = $request->sk_pengesahan_pendirian_no;
            if($request->has('sk_pengesahan_perubahan_terakhir_no')) $pemohon->sk_pengesahan_perubahan_terakhir_no = $request->sk_pengesahan_perubahan_terakhir_no;
            if($request->has('ktp_no_pimpinan')) $pemohon->ktp_no_pimpinan = $request->ktp_no_pimpinan;
            if($request->has('npwp_no_lembaga')) $pemohon->npwp_no_lembaga = $request->npwp_no_lembaga;
            if($request->has('kriteria_mitra')) $pemohon->kriteria_mitra = $request->kriteria_mitra;
            if($request->has('profil_singkat')) $pemohon->profil_singkat = $request->profil_singkat;

            if($request->hasFile('struktur_organisasi_file')) {
                $file = $request->file('struktur_organisasi_file');
     
                //you also need to keep file extension as well
                $name = $id."-STRUKTUR.".$file->getClientOriginalExtension();
     
                //using the array instead of object
                $image['filePath'] = $name;     
                $file->move(storage_path('app/public/pemohon-file/'), $name);
                $pemohon->struktur_organisasi_file      = $name;
            }

            if($request->has('phone')) $pemohon->phone = $request->phone;
            if($request->has('website')) $pemohon->website = $request->website;
            if($request->has('socmed')) $pemohon->socmed = $request->socmed;
            if($request->has('penanggung_jawab_nm')) $pemohon->penanggung_jawab_nm = $request->penanggung_jawab_nm;
            if($request->has('penanggung_jawab_email')) $pemohon->penanggung_jawab_email = $request->penanggung_jawab_email;
            if($request->has('penanggung_jawab_phone')) $pemohon->penanggung_jawab_phone = $request->penanggung_jawab_phone;
            if($request->has('bank_cd')) $pemohon->bank_cd = $request->bank_cd;
            if($request->has('bank_branch')) $pemohon->bank_branch = $request->bank_branch;
            if($request->has('bank_holder')) $pemohon->bank_holder = $request->bank_holder;
            if($request->has('bank_account_no')) $pemohon->bank_account_no = $request->bank_account_no;

            if($request->hasFile('bank_account_file')) {
                $file               = $request->file('bank_account_file');
                $name               = $id."-BANK ACCOUNT.".$file->getClientOriginalExtension();
                $image['filePath']  = $name;     
                $file->move(storage_path('app/public/pemohon-file/'), $name);
                $pemohon->bank_account_file      = $name;
            }

            $pemohon->updated_by    = Auth::user()->user_id;
            $pemohon->save();

            $user               = AuthUser::where('default_key', $pemohon->trx_pemohon_id)->first();
            $user->email        = $pemohon->email;
            $user->phone        = $pemohon->phone;
            $user->updated_by   = Auth::user()->user_id;
            $user->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Pemohon $id", 
                $table      = $pemohon->getTable(), 
                $oldData    = $oldData, 
                $newData    = $pemohon
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

}
