<?php
use Illuminate\Database\Seeder;
use App\Models\AuthRoleMenu;

class RoleMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        AuthRoleMenu::insert([
            /*--super--*/
            [ "menu_cd" => "SYS", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS01", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS02", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS03", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS04", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS05", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS06", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS07", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PEMOHON", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "MITRA", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSAL", "role_cd" => "superuser", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],

            /*--admin--*/
            [ "menu_cd" => "SYS", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS01", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS03", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS04", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS05", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS06", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "SYS07", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PEMOHON", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "MITRA", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSAL", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSALPEN", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSALMON", "role_cd" => "admin", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],

            /*--pemohon--*/
            [ "menu_cd" => "PEMOHON", "role_cd" => "pemohon", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSAL", "role_cd" => "pemohon", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],

            /*--mitra--*/
            [ "menu_cd" => "MITRA", "role_cd" => "mitra", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSAL", "role_cd" => "mitra", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSALST", "role_cd" => "mitra", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],

            /*--regas--*/
            [ "menu_cd" => "PROPOSAL", "role_cd" => "regas", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSALLT", "role_cd" => "regas", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSALPEN", "role_cd" => "regas", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSALMON", "role_cd" => "regas", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            
            [ "menu_cd" => "PROPOSAL", "role_cd" => "kemaslahatan","created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSAL", "role_cd" => "kepbp","created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSAL", "role_cd" => "penelaah","created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSAL", "role_cd" => "bidmr","created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSAL", "role_cd" => "bidhk","created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSAL", "role_cd" => "bidkeu","created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "menu_cd" => "PROPOSAL", "role_cd" => "bidpenempatan","created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],


        ]);
    }
}
