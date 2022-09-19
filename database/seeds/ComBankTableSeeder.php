<?php

use Illuminate\Database\Seeder;
use App\Models\ComBank;

class ComBankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ComBank::truncate();

        ComBank::insert([
            ['bank_cd' => '451', 'bank_nm' => 'Bank Syariah Indonesia','created_by' => 'seeder', 'created_at' => date('Y-m-d H:i:s')]
        ]);
    }
}
