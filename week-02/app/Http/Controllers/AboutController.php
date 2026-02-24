<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        return 'Nama : Achmad Daud Roichan <br> NIM : 244107020005 <br> Kelas : TI-2F';
    }
}
