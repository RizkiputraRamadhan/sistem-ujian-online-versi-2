<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $profil = Siswa::where('users_id', auth()->user()->id)->first();
        return view('backend.v_home.index', [
            'judul' => 'Beranda',
            'sub' => 'Data Beranda',
            'profil' => $profil,
        ]);
    }
}
