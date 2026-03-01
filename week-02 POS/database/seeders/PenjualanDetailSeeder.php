<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('t_penjualan_detail')->insert([
            // PJL-001
            ['penjualan_id' => 1, 'barang_id' => 1, 'harga' => 3500, 'jumlah' => 3],
            ['penjualan_id' => 1, 'barang_id' => 3, 'harga' => 3000, 'jumlah' => 2],
            // PJL-002
            ['penjualan_id' => 2, 'barang_id' => 2, 'harga' => 10000, 'jumlah' => 1],
            ['penjualan_id' => 2, 'barang_id' => 4, 'harga' => 5000, 'jumlah' => 2],
            ['penjualan_id' => 2, 'barang_id' => 5, 'harga' => 6000, 'jumlah' => 1],
            // PJL-003
            ['penjualan_id' => 3, 'barang_id' => 6, 'harga' => 8000, 'jumlah' => 2],
            ['penjualan_id' => 3, 'barang_id' => 1, 'harga' => 3500, 'jumlah' => 5],
        ]);
    }
}
