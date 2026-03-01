<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_kategori')->insert([
            ['kategori_kode' => 'KTG1', 'kategori_nama' => 'Makanan'],
            ['kategori_kode' => 'KTG2', 'kategori_nama' => 'Minuman'],
            ['kategori_kode' => 'KTG3', 'kategori_nama' => 'Kebersihan'],
            ['kategori_kode' => 'KTG4', 'kategori_nama' => 'Kesehatan'],
        ]);
    }
}
