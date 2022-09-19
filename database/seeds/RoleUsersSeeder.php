<?php
use Illuminate\Database\Seeder;
use App\Models\AuthRoleUser;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        AuthRoleUser::insert([
            ['role_cd' => 'superuser','user_id'=> 'super','created_by'=> 'admin','created_at'=> date('Y-m-d H:i:s')],
            ['role_cd' => 'admin','user_id'=> 'admin','created_by'=> 'admin','created_at'=> date('Y-m-d H:i:s')],
            // ['role_cd' => 'mitra','user_id'=> 'mitra1','created_by'=> 'admin','created_at'=> date('Y-m-d H:i:s')],
            // ['role_cd' => 'pemohon','user_id'=> 'pemohon1','created_by'=> 'admin','created_at'=> date('Y-m-d H:i:s')],
            ['role_cd' => 'regas','user_id'=> 'regas1','created_by'=> 'admin','created_at'=> date('Y-m-d H:i:s')]
        ]);
    }
}
