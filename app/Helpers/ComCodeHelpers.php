<?php 
if (! function_exists('comCodeItem')) {
    function comCodeItem($id){
        $comCodeList = App\Models\ComCode::where('code_group', $id)
                    ->orderBy('com_cd')
                    ->get();

        return $comCodeList;
    }
}

if (! function_exists('comCodeOptions')) {
    function comCodeOptions($id){
        $comCodeList = App\Models\ComCode::where('code_group', $id)
                    ->orderBy('com_cd')
                    ->get();

        $options='<option value="">Pilih Data</option>';

        foreach($comCodeList as $item){
            $options .='<option value="'.$item->com_cd.'">'.$item->code_nm.'</option>';
        }

        return $options;
    }
}

if (! function_exists('mitraOptions')) {
    function mitraOptions(){
        $mitraList = App\Models\PublicTrxMitraKemaslahatan::get();

        $options='<option value="">Pilih Data</option>';

        foreach($mitraList as $item){
            $options .='<option value="'.$item->trx_mitra_kemaslahatan_id.'">'.$item->mitra_kemaslahatan_nm.'</option>';
        }

        return $options;
    }
}

if (! function_exists('comCodeName')) {
    function comCodeName($id){
        $comCodeName = App\Models\ComCode::where('com_cd', $id)->first();
        return !empty($comCodeName) ? $comCodeName->code_nm : "CODE NOT FOUND";
    }
}

if (! function_exists('comCodeValue')) {
    function comCodeValue($id){
        $comCodeValue = App\Models\ComCode::where('com_cds', $id)->first();
        return $comCodeValue->code_value;
    }
}

if (! function_exists('comCodeByValue')) {
    function comCodeByValue($id){
        $comCodeValue = App\Models\ComCode::where('code_value', $id)->first();
        return $comCodeValue->com_cd;
    }
}

if (! function_exists('listStatus')) {
    function listStatus(){
        $listStatus = App\Models\PublicTrxProsesStatus::orderBy('trx_proses_status_id')->get();

        $options='<option value="">Pilih Data</option>';

        foreach($listStatus as $item){
            $options .='<option value="'.$item->trx_proses_status_id.'">'.$item->proses_nm.'</option>';
        }

        return $options;
    }
}