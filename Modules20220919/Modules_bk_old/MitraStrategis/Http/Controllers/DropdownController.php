<?php

namespace Modules\MitraStrategis\Http\Controllers;

use App\Models\PublicTrxMitraStrategis;

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
        $data       = PublicTrxMitraStrategis::select(
                        "trx_mitra_strategis_id as id",
                        "mitra_strategis_nm as text",
                        "jabatan",
                        "instansi"
                    )
                    ->orderBy('mitra_strategis_nm')
                    ->where("mitra_strategis_nm", "LIKE", "%$paramText%")
                    ->get()
                    ->toArray();

        array_unshift($data,array('id' => '','text'=>'=== Pilih Data ==='));
        return response()->json($data);
    }
}
