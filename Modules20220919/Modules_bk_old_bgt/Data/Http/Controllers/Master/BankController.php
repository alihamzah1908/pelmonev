<?php
namespace Modules\Data\Http\Controllers\Master;

use DB;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComBank;

class BankController extends Controller{
    private $folder_path = 'master.bank';
    
    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Index
     *
     * @return \Illuminate\Http\Response
     */
    function index($id = NULL){
        $filename_page 	= 'index';
        $title 			= 'Data Bank';

        return view('data::' . $this->folder_path . '.' . $filename_page, compact('title'));
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = ComBank::query();

        return DataTables::of($data)->make(true);
		
		
		/* $data   =  ComBank::all();
		
		return DataTables::of($data)->make(true); */
    }

    /**
     * Create
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
		$this->validate($request,[
            'bank_cd'     => 'required',
            'bank_nm'     => 'required',
        ]);
		
        $bank             = new ComBank;
        $bank->bank_cd    = str_replace(' ','',$request->bank_cd);
        $bank->bank_nm    = ucwords($request->bank_nm);
        $bank->note       = '';
        $bank->created_by = Auth::user()->user_id;
        $bank->save();

        return response()->json(['status' => 'ok'],200); 
    }

    /**
     * Show by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function show($id){
        $bank = ComBank::find($id);

        if($bank){
            return response()->json(['status' => 'ok', 'data' => $bank],200);
        }else{
            return response()->json(['status' => 'failed', 'data' => 'not found'],200);
        }
    }

    /**
     * Update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(Request $request, $id){
        $this->validate($request,[
            'bank_nm'       => 'required',
        ]);
        
        $bank             = ComBank::find($id);
        $bank->bank_nm    = ucwords($request->bank_nm);
        $bank->updated_by = Auth::user()->user_id;

        $bank->save();

        return response()->json(['status' => 'ok'],200); 
    }

    /** 
     * Delete
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function destroy($id){
        ComBank::destroy($id);

        return response()->json(['status' => 'ok'],200);
    }

    function getListData(Request $request, $id=NULL){
        $searchParam = $request->get('term');
		$bank = ComBank::select("bank_cd as id", "bank_nm as text") 
                        ->where("bank_nm", "ILIKE", "%$searchParam%")
                        ->get()
                        ->toArray();

        array_unshift($bank,array('id' => '','text'=>'=== Pilih Bank ==='));
        return response()->json($bank);
    }
}
