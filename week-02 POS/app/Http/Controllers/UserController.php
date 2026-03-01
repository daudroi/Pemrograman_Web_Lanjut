<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Praktikum 6 - Eloquent ORM
    public function index()
    {
        // INSERT
        UserModel::firstOrCreate(
            ['username' => 'staff2'],
            [
                'level_id' => 3,
                'nama_lengkap' => 'Staff Kasir Dua',
                'password' => Hash::make('password123'),
            ]
        );

        // UPDATE
        UserModel::where('username', 'staff2')
            ->update(['nama_lengkap' => 'Staff Kasir 2']);

        // SELECT - with relation
        $data = UserModel::with('level')->get();

        return view('user.index', ['data' => $data]);
    }

    public function profile($id, $name)
    {
        return view('user.profile', ['id' => $id, 'name' => $name]);
    }
}
