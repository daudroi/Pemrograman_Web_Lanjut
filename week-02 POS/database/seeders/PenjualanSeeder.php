<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('t_penjualan')->insert([
            [
                'user_id' => 3,
                'penjualan_kode' => 'PJL-001',
                'pembeli' => 'Budi Santoso',
                'penjualan_tanggal' => '2026-03-01 10:00:00',
            ],
            [
                'user_id' => 3,
                'penjualan_kode' => 'PJL-002',
                'pembeli' => 'Siti Rahayu',
                'penjualan_tanggal' => '2026-03-01 13:30:00',
            ],
            [
                'user_id' => 3,
                'penjualan_kode' => 'PJL-003',
                'pembeli' => 'Agus Wijaya',
                'penjualan_tanggal' => '2026-03-02 09:15:00',
            ],
        ]);
    }
}
