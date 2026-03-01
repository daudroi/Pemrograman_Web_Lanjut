<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_barang')->insert([
            ['kategori_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Indomie Goreng', 'harga_beli' => 2500, 'harga_jual' => 3500],
            ['kategori_id' => 1, 'barang_kode' => 'BRG002', 'barang_nama' => 'Biskuit Oreo', 'harga_beli' => 8000, 'harga_jual' => 10000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG003', 'barang_nama' => 'Aqua 600ml', 'harga_beli' => 2000, 'harga_jual' => 3000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG004', 'barang_nama' => 'Teh Botol Sosro', 'harga_beli' => 3500, 'harga_jual' => 5000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG005', 'barang_nama' => 'Sabun Lifebuoy', 'harga_beli' => 4000, 'harga_jual' => 6000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG006', 'barang_nama' => 'Panadol', 'harga_beli' => 5000, 'harga_jual' => 8000],
        ]);
    }
}
