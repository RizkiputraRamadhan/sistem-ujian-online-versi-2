<?php

namespace App\Http\Controllers\Backend;
// namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Backend\Akun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = User::where('typeuser', 1)->get();
        return view('backend.v_guru.index', [
            'judul' => 'Akun Guru',
            'sub' => 'Data Akun Guru',
            'akun' => $akun,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'typeuser' => 1,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Guru Berhasil Didaftarkan.');
    }
    public function edit(string $id)
    {
        $guru = User::findOrFail($id);
        return view('backend.v_guru.edit', [
            'judul' => 'Akun Guru',
            'sub' => $guru->nama,
            'guru' => $guru,
        ]);
    }
    public function show(string $id)
    {
        $guru = User::findOrFail($id);
        $profil = Guru::where('users_id', $id)->first();
        $histori = Guru::where('users_id', $id)->first();
        return view('backend.v_guru.detail', [
            'judul' => 'Detail Akun Guru',
            'sub' => $guru->nama,
            'guru' => $guru,
            'profil' => $profil,
            'histori' => $histori,
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        $siswa = User::find($id);

        $siswa->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->has('password') ? bcrypt($request->input('password')) : $siswa->password, // Only update the password if provided
        ]);

        return redirect('/guru')
            ->with('success', 'Akun Guru Berhasil diupdate.');
    }

    public function destroy($id)
    {
        $siswa = User::find($id);
        try {
            $siswa->delete();
            return redirect()
                ->back()
                ->with('success', 'Akun Guru deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error deleting akun karena akun masih aktif');
        }
    }
}
