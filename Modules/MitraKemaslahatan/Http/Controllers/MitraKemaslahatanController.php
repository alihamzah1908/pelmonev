<?php

namespace Modules\MitraKemaslahatan\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxMitraKemaslahatan;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MitraKemaslahatanController extends Controller
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
        if ($id || isRoleUser('mitra')) {
            isRoleUser('mitra') ? $id = Auth::user()->default_key : $id = $id;
            $filename_page 	= 'detail';
            $title 			= 'Detail Mitra';
            $mitra          = PublicTrxMitraKemaslahatan::find($id);
            $userMitra      = AuthUser::where('default_key',$id)->first();
            $banks          = ComBank::all();
            
            \LogActivity::saveLog(
                $logTp = 'visit', 
                $logNm = "Membuka Menu $title $id"
            );

            return view('mitrakemaslahatan::' . $this->folder_path . '.' . $filename_page, compact('title', 'mitra','userMitra','banks'));
        }else{
            $filename_page 	= 'index';
            $title 			= 'Mitra';
            
            \LogActivity::saveLog(
                $logTp = 'visit', 
                $logNm = "Membuka Menu $title"
            );

            return view('mitrakemaslahatan::' . $this->folder_path . '.' . $filename_page, compact('title'));
        }
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicTrxMitraKemaslahatan::where(function($query) use($request){
                    if ($request->nama) {
                        $query->where("mitra_kemaslahatan_nm", "ILIKE" ,'%'.$request->nama.'%');
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
     * Create
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
        try {
            DB::beginTransaction();
            $this->validate($request,[
                'mitra_kemaslahatan_nm' => 'required',
                'region_prop'           => 'required',
                'region_kab'            => 'required',
                'region_kel'            => 'required',
                'region_kec'            => 'required',
                'address'               => 'required',
                'email'                 => 'required',
                'phone'                 => 'required',
            ]);

            $mitra                          = new PublicTrxMitraKemaslahatan;
            $mitra->mitra_kemaslahatan_nm   = $request->mitra_kemaslahatan_nm;
            $mitra->region_prop             = $request->region_prop;
            $mitra->region_kab              = $request->region_kab;
            $mitra->region_kel              = $request->region_kel;
            $mitra->region_kec              = $request->region_kec;
            $mitra->address                 = $request->address;
            $mitra->phone                   = $request->phone;
            $mitra->email                   = $request->email;

            $mitra->updated_by    = Auth::user()->user_id;
            $mitra->save();

            $user             = new AuthUser();
            $user->user_id    = $mitra->trx_mitra_kemaslahatan_id;
            $user->user_nm    = $mitra->mitra_kemaslahatan_nm;
            $user->email      = $mitra->email;
            $user->phone      = $mitra->phone;
		    $user->rule_tp    = '1111';
            $user->default_key= $mitra->trx_mitra_kemaslahatan_id;
		    $user->password   = Hash::make($data['password']);
            $user->created_by = Auth::user()->user_id;
            $user->save();

            $roleUser          = new AuthRoleUser();
            $roleUser->user_id = $user->user_id;
            $roleUser->role_cd = 'mitra';
            $roleUser->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Menambahkan Data Mitra", 
                $table      = $mitra->getTable(), 
                $newData    = $mitra
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
            $this->validate($request,[
                // 'mitra_kemaslahatan_nm' => 'required',
                // 'region_prop'           => 'required',
                // 'region_kab'            => 'required',
                // 'region_kel'            => 'required',
                // 'region_kec'            => 'required',
                'address'               => 'required',
                // 'email'                 => 'required|max:100',
                'phone'                 => 'required|max:20',
            ]);

            $mitra                = PublicTrxMitraKemaslahatan::find($id);
            $oldData = $mitra;
            
            if(!empty($request->region_prop)){
                $mitra->region_prop             = $request->region_prop;
            }

            if(!empty($request->region_kab)){
                $mitra->region_kab              = $request->region_kab;
            }

            if(!empty($request->region_kel)){
                $mitra->region_kel              = $request->region_kel;
            }

            if(!empty($request->region_kec)){
                $mitra->region_kec              = $request->region_kec;
            }


            $mitra->address                 = $request->address;

            $mitra->phone                   = $request->phone;

            $mitra->updated_by    = Auth::user()->user_id;
            $mitra->save();

            $user             = AuthUser::find($id);
            $user->email      = $mitra->email;
            $user->phone      = $mitra->phone;
		    $user->rule_tp    = '1111';
            $user->default_key= $mitra->trx_mitra_kemaslahatan_id;
            $user->created_by = Auth::user()->user_id;
            $user->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Mitra $id", 
                $table      = $mitra->getTable(), 
                $oldData    = $oldData, 
                $newData    = $mitra
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
