<?php

use App\Models\AuthUser;

if (! function_exists('roleUser')) {
    function roleUser(){
        $userId = Auth::user()->user_id;

        $roleUser=App\Models\AuthRoleUser::where('user_id', $userId)->first();
        return $roleUser->role_cd;
    }
}

if (! function_exists('isRoleUser')) {
    function isRoleUser($roleParam){
        $userId = Auth::user()->user_id;

        $roleUser=App\Models\AuthRoleUser::where(function($where) use($userId, $roleParam){
            if (is_array($roleParam)) {
                $where->whereIn('role_cd',$roleParam);
            }else{
                $where->where('role_cd',$roleParam);
            }

            $where->where('user_id',$userId);
        })
        ->count();
        
        if ($roleUser == 1) {
            return TRUE;
        }else {
            return FALSE;
        }
    }
}

if (! function_exists('isJabatanUser')) {
    function isJabatanUser($jabatanParam){
        $userId = Auth::user()->user_id;

        $jabatanUser=App\Models\AuthUser::where(function($where) use($userId, $jabatanParam){
            if (is_array($jabatanParam)) {
                $where->whereIn('jabatan_id', $jabatanParam);
            }else{
                $where->where('jabatan_id', $jabatanParam);
            }

            $where->where('user_id',$userId);
        })
        ->count();
        
        if ($jabatanUser == 1) {
            return TRUE;
        }else {
            return FALSE;
        }
    }
}

if (! function_exists('getRuleofRoleCd')) {
    function getRuleofRoleCd(){
        $roleCd = roleUser();

        $role   = App\Models\AuthRole::find($roleCd);
        return $role->rule_tp;
    }
}

if (! function_exists('isRoleProcess')) {
    function isRoleProcess($roleParam){
        $role = json_decode($roleParam);
        $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();
        foreach ($role as $rl) { 
            if ($rl == $currUserData->role_cd ) {
                return $rl;
            }
        }
    }
}