<?php
use Illuminate\Database\Seeder;
use App\Models\AuthConfiguration;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        AuthConfiguration::truncate();
		
        AuthConfiguration::insert([
            [ "configuration_cd" => "APP_DESC", "configuration_nm" => "Deskripsi Aplikasi", "configuration_group" => "APP_CD", "configuration_value" => "SISTEM INFORMASI KEMASLAHATAN", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "configuration_cd" => "APP_NAME", "configuration_nm" => "Nama Aplikasi", "configuration_group" => "APP_CD", "configuration_value" => "SISTEM INFORMASI KEMASLAHATAN", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "configuration_cd" => "INST_NAME", "configuration_nm" => "Nama Organisasi", "configuration_group" => "APP_CD", "configuration_value" => "BPKH", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "configuration_cd" => "INST_LOGO", "configuration_nm" => "Logo Organisasi", "configuration_group" => "APP_CD", "configuration_value" => "images/logo-bpkh-s.png", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "configuration_cd" => "LOG_ST", "configuration_nm" => "Status Log", "configuration_group" => "APP_CD", "configuration_value" => "ON", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "configuration_cd" => "APP_ALIAS_DESC", "configuration_nm" => "Deskripsi Aplikasi", "configuration_group" => "APP_CD", "configuration_value" => "SISTEM INFORMASI KEMASLAHATAN", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "configuration_cd" => "APP_LOGO", "configuration_nm" => "Logo Organisasi", "configuration_group" => "APP_CD", "configuration_value" => "images/logo-bpkh-s.png", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "configuration_cd" => "APP_ALIAS_LOGO", "configuration_nm" => "Logo Organisasi", "configuration_group" => "APP_CD", "configuration_value" => "images/logo-bpkh-s.png", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "configuration_cd" => "DEF_PROP", "configuration_nm" => "Default Propinsi", "configuration_group" => "APP_CD", "configuration_value" => "31", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "configuration_cd" => "DEF_KAB", "configuration_nm" => "Default Kabupaten", "configuration_group" => "APP_CD", "configuration_value" => "", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            //[ "configuration_cd" => "DEFAULT_REGION3", "configuration_nm" => "Default Kecamatan", "configuration_group" => "APP_CD", "configuration_value" => "31", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            //[ "configuration_cd" => "DEFAULT_REGION4", "configuration_nm" => "Default Kelurahan", "configuration_group" => "APP_CD", "configuration_value" => "31", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
        ]);
    }
}
