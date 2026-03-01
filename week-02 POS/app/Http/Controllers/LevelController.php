<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        // Praktikum 4 - DB Facade (Raw SQL)

        // INSERT
        DB::insert(
            'insert into m_level(level_kode, level_nama) values(?, ?) ON CONFLICT (level_kode) DO NOTHING',
            ['CUS', 'Pelanggan']
        );

        // UPDATE
        DB::update(
            'update m_level set level_nama = ? where level_kode = ?',
            ['Customer', 'CUS']
        );

        // SELECT
        $data = DB::select('select * from m_level');

        return view('level.index', ['data' => $data]);
    }
}
