<?php

namespace Modules\MitraKemaslahatan\Http\Controllers;

use App\Models\PublicTrxMitraKemaslahatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DropdownController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $paramText  = $request->get('term');
        $data       = PublicTrxMitraKemaslahatan::select(
                        "trx_mitra_kemaslahatan_id as id",
                        "mitra_kemaslahatan_nm as text"
                    )
                    ->orderBy('mitra_kemaslahatan_nm')
                    ->where("mitra_kemaslahatan_nm", "LIKE", "%$paramText%")
                    ->get()
                    ->toArray();

        array_unshift($data,array('id' => '','text'=>'=== Pilih Data ==='));
        return response()->json($data);
    }
}
