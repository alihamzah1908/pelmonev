<?php
namespace App\Http\Controllers;

use URL;
use Auth;
use Illuminate\Http\Request;
use App\Models\AuthMenu;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct(){
        $this->middleware('auth');
    }

    public function getMenuSide(){
        return AuthMenu::where('menu_level',1)
                ->join('auth.role_menus as rm','rm.menu_cd','=','menus.menu_cd')
                ->join('auth.role_users as ru','ru.role_cd','=','rm.role_cd')
                ->where('ru.user_id',Auth::user()->user_id)
                ->select('menus.menu_cd','menu_nm','menu_root','menu_level','menu_no','menu_url', 'menu_image')
                ->orderBy('menu_no')
                ->distinct()
                ->get();
    }

    function getActiveMenus(){
        $activeMenu = array();
        $routePath = request()->path();
        if(request()->route('id')){
            $routePath = str_replace("/".request()->route('id'),"",$routePath);
        }

        $data = AuthMenu::where('menu_url',$routePath)->first();
        return Self::getMenuById($data ? $data->menu_cd : '', $activeMenu);
    }

    static function getMenuById($id, $activeMenu){
        $data = AuthMenu::find($id);
        if ($data) {
            array_push($activeMenu, $data->menu_cd);
            if ($data->menu_root) {
                return Self::getMenuById($data->menu_root, $activeMenu);
            }
        }

        return $activeMenu;
    }
}
