<?php
use Illuminate\Database\Seeder;
use App\Models\AuthUser;
use App\Models\PublicTrxPemohon;
use App\Models\PublicTrxMitraKemaslahatan;

use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        AuthUser::truncate();
		
		//--Password = adminadmin
        AuthUser::insert([
            ['user_id' => 'super','user_nm' => 'Super User','email' => 'super@mail.com','password' => Hash::make('adminadmin'),'phone' => '', "email_verified_at" => date('Y-m-d H:i:s'), "active" => true,'token_register' => "",'created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
        ]);
		AuthUser::insert([
            ['user_id' => 'admin','user_nm' => 'Administrator','email' => 'admin@mail.com','password' => Hash::make('adminadmin'),'phone' => '', "email_verified_at" => date('Y-m-d H:i:s'),"active" => true,'token_register' => "",'created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
        ]);
        
        // user BPKH
        AuthUser::insert([
            ['user_id' => 'regas1','user_nm' => 'Divisi Regas','email' => 'regas1@mail.com','password' => Hash::make('password'),'phone' => '', "email_verified_at" => date('Y-m-d H:i:s'),"active" => true,'token_register' => "",'created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 'kemaslahatan1','user_nm' => 'Bidang Kemaslahatan','email' => 'kemaslahatan1@mail.com','password' => Hash::make('password'),'phone' => '', "email_verified_at" => date('Y-m-d H:i:s'),"active" => true,'token_register' => "",'created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 'kepbp1','user_nm' => 'Kepala BP','email' => 'kepbp1@mail.com','password' => Hash::make('password'),'phone' => '', "email_verified_at" => date('Y-m-d H:i:s'),"active" => true,'token_register' => "",'created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 'penelaah1','user_nm' => 'Tim Penelaah','email' => 'penelaah1@mail.com','password' => Hash::make('password'),'phone' => '', "email_verified_at" => date('Y-m-d H:i:s'),"active" => true,'token_register' => "",'created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 'bidmr1','user_nm' => 'Bidang MR','email' => 'bidmr1@mail.com','password' => Hash::make('password'),'phone' => '', "email_verified_at" => date('Y-m-d H:i:s'),"active" => true,'token_register' => "",'created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 'bidhk1','user_nm' => 'Bidang HK','email' => 'bidhk1@mail.com','password' => Hash::make('password'),'phone' => '', "email_verified_at" => date('Y-m-d H:i:s'),"active" => true,'token_register' => "",'created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 'bidkeu1','user_nm' => 'Bidang Keuangan','email' => 'bidkeu1@mail.com','password' => Hash::make('password'),'phone' => '', "email_verified_at" => date('Y-m-d H:i:s'),"active" => true,'token_register' => "",'created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 'bidpenempatan1','user_nm' => 'Bidang Penempatan','email' => 'bidpenempatan1@mail.com','password' => Hash::make('password'),'phone' => '', "email_verified_at" => date('Y-m-d H:i:s'),"active" => true,'token_register' => "",'created_by' => 'admin','created_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
