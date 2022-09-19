<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AuthMenu
 *
 * @property-read AuthMenu $root
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMenu query()
 * @mixin \Eloquent
 */
class AuthMenu extends Model{
    protected $table            = 'auth.menus';
    public $keyType             = 'string';
    protected Static $tableName = 'auth.menus';
    protected $primaryKey       = 'menu_cd'; 
    public $incrementing        = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_cd',
        'menu_nm',
        'menu_url',
        'menu_no',
        'menu_level',
        'menu_root',
        'menu_image', 
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function childs(){
        return $this->hasMany('App\Models\AuthMenu', 'menu_root', 'menu_cd')
                ->join('auth.role_menus as rm','rm.menu_cd','=','menus.menu_cd')
                ->join('auth.role_users as ru','ru.role_cd','=','rm.role_cd')
                ->where('ru.user_id',Auth::user()->user_id)
                ->orderBy('menu_no')
                ->distinct()
        ;
    }

    public function childMenu2(){
        return $this->childs()->with('childs');
    }

    public function root(){
        return $this->belongsTo('App\Models\AuthMenu', 'menu_root', 'menu_cd');
    }

    public function roleMenu(){
        return $this->hasMany('App\Models\RoleMenu', 'menu_cd', 'menu_cd');
    }
    
    public static function checkActiveMenu($menuCd)
    {
        $data = $this->where('menu_cd', $menuCd)->first();
        return $data->menu_url;
    }

    public static function getUserMenu($id, $url=NULL){
        $query = DB::table(Self::$tableName.' as menu')
                ->join('auth.role_menus as rm','rm.menu_cd','=','menu.menu_cd')
                ->join('auth.role_users as ru','ru.role_cd','=','rm.role_cd')
                ->where('ru.user_id',$id)
                ->select('menu.menu_cd','menu_nm','menu_root','menu_level','menu_no','menu_url', 'menu_image')
                ->orderBy('menu_no')
                ->distinct();

        if ($url != '' || $url != NULL) {
            $query = $query->where('menu.menu_url','=',$url);
        }

        return $query->get();
    }
}
