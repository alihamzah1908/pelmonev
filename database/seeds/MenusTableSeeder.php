<?php
use Illuminate\Database\Seeder;
use App\Models\AuthMenu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        AuthMenu::truncate();
		
		AuthMenu::insert(array (
            array (
                'menu_cd' => 'SYS',
                'menu_nm' => 'Sistem',
                'menu_no' => '01',
                'menu_root' => NULL,
                'menu_level' => 1,
                'menu_url' => 'sistem',
                'menu_image' => 'icon-cog2',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'SYS01',
                'menu_nm' => 'User',
                'menu_no' => '0101',
                'menu_root' => 'SYS',
                'menu_level' => 2,
                'menu_url' => 'sistem/user',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'SYS02',
                'menu_nm' => 'Autorisasi',
                'menu_no' => '0102',
                'menu_root' => 'SYS',
                'menu_level' => 2,
                'menu_url' => 'sistem/autorisasi',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'SYS03',
                'menu_nm' => 'Pengaturan',
                'menu_no' => '0103',
                'menu_root' => 'SYS',
                'menu_level' => 2,
                'menu_url' => 'sistem/configuration',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'SYS04',
                'menu_nm' => 'Negara',
                'menu_no' => '0104',
                'menu_root' => 'SYS',
                'menu_level' => 2,
                'menu_url' => 'data/nation',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'SYS05',
                'menu_nm' => 'Propinsi',
                'menu_no' => '0105',
                'menu_root' => 'SYS',
                'menu_level' => 2,
                'menu_url' => 'data/region',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'SYS06',
                'menu_nm' => 'Bank',
                'menu_no' => '0106',
                'menu_root' => 'SYS',
                'menu_level' => 2,
                'menu_url' => 'sistem/bank',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'PEMOHON',
                'menu_nm' => 'Pemohon',
                'menu_no' => '02',
                'menu_root' => '',
                'menu_level' => 1,
                'menu_url' => 'pemohon',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'SYS07',
                'menu_nm' => 'Log Aktifitas',
                'menu_no' => '0106',
                'menu_root' => 'SYS',
                'menu_level' => 2,
                'menu_url' => 'sistem/log-activity',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'PROPOSAL',
                'menu_nm' => 'Proposal',
                'menu_no' => '03',
                'menu_root' => '',
                'menu_level' => 1,
                'menu_url' => 'proposal',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'PROPOSALST',
                'menu_nm' => 'Status Proposal',
                'menu_no' => '04',
                'menu_root' => '',
                'menu_level' => 1,
                'menu_url' => 'status-proposal',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'PROPOSALLT',
                'menu_nm' => 'Proposal Layak Teknis',
                'menu_no' => '05',
                'menu_root' => '',
                'menu_level' => 1,
                'menu_url' => 'proposal-layak-teknis',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'PROPOSALPEN',
                'menu_nm' => 'Penilaian Proposal',
                'menu_no' => '06',
                'menu_root' => '',
                'menu_level' => 1,
                'menu_url' => 'proposal-penilaian',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'PROPOSALMON',
                'menu_nm' => 'Monitoring Proposal',
                'menu_no' => '07',
                'menu_root' => '',
                'menu_level' => 1,
                'menu_url' => 'proposal-monitoring',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'MITRA',
                'menu_nm' => 'Mitra Kemaslahatan',
                'menu_no' => '09',
                'menu_root' => '',
                'menu_level' => 1,
                'menu_url' => 'mitra-kemaslahatan',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'MITRAST',
                'menu_nm' => 'Mitra Strategis',
                'menu_no' => '10',
                'menu_root' => '',
                'menu_level' => 1,
                'menu_url' => 'mitra-strategis',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            ),
            array (
                'menu_cd' => 'MSCOO',
                'menu_nm' => 'Master COO',
                'menu_no' => '10',
                'menu_root' => '',
                'menu_level' => 1,
                'menu_url' => 'master-coo',
                'menu_image' => '',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            )
        ));
    }
}
