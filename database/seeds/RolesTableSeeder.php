<?php
use Illuminate\Database\Seeder;
use App\Models\AuthRole;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        AuthRole::truncate();
		
        AuthRole::insert([
            ['role_cd' => 'superuser','role_nm' => 'Super User','rule_tp' => '1111','created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
			['role_cd' => 'admin','role_nm' => 'Administrator','rule_tp' => '1111','created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['role_cd' => 'pemohon','role_nm' => 'Pemohon','rule_tp' => '1111','created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['role_cd' => 'mitra','role_nm' => 'Mitra','rule_tp' => '1111','created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['role_cd' => 'regas','role_nm' => 'Divisi Regas','rule_tp' => '1111','created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['role_cd' => 'kemaslahatan','role_nm' => 'Bidang Kemaslahatan','rule_tp' => '1110','created_by'=>'syaddamm','created_at'=> date('Y-m-d H:i:s')],
            ['role_cd' => 'kepbp','role_nm' => 'Kepala BP' ,'rule_tp' => '1110','created_by'=>'syaddamm','created_at'=> date('Y-m-d H:i:s')],
            ['role_cd' => 'penelaah','role_nm' => 'Tim Penelaah' ,'rule_tp' => '1110','created_by'=>'syaddamm','created_at'=> date('Y-m-d H:i:s')],
            ['role_cd' => 'bidmr','role_nm' => 'Bidang MR' ,'rule_tp' => '1110','created_by'=>'syaddamm','created_at'=> date('Y-m-d H:i:s')],
            ['role_cd' => 'bidhk','role_nm' => 'Bidang HK' ,'rule_tp' => '1110','created_by'=>'syaddamm','created_at'=> date('Y-m-d H:i:s')],
            ['role_cd' => 'bidkeu','role_nm' => 'Bidang Keuangan' ,'rule_tp' => '1110','created_by'=>'syaddamm','created_at'=> date('Y-m-d H:i:s')],
            ['role_cd' => 'bidpenempatan','role_nm' => 'Bidang Penempatan','rule_tp' => '1110','created_by'=>'syaddamm','created_at'=> date('Y-m-d H:i:s')],
        ]);
    }
}
