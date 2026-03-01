<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        // Praktikum 5 - Query Builder

        // INSERT
        DB::table('m_kategori')->insertOrIgnore([
            'kategori_kode' => 'OTH',
            'kategori_nama' => 'Lainnya',
        ]);

        // UPDATE
        DB::table('m_kategori')
            ->where('kategori_kode', 'OTH')
            ->update(['kategori_nama' => 'Produk Lainnya']);

        // SELECT
        $data = DB::table('m_kategori')->get();

        return view('kategori.index', ['data' => $data]);
    }
}
