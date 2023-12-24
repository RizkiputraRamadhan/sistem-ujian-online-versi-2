<?php

namespace App\Http\Controllers\Backend;
// namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Result;
use App\Models\Categories;
use Illuminate\Support\Str;
use App\Models\Backend\Akun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = User::where('typeuser', 2)->get();
        return view('backend.v_siswa.index', [
            'judul' => 'Akun Siswa Ujian',
            'sub' => 'Data Akun Siswa',
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
            'typeuser' => 2,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Siswa Berhasil Didaftarkan.');
    }

    public function edit(string $id)
    {
        $siswa = User::findOrFail($id);
        return view('backend.v_siswa.edit', [
            'judul' => 'Akun Siswa Ujian',
            'sub' => $siswa->nama,
            'siswa' => $siswa,
        ]);
    }
    public function show(string $id)
    {
        $siswa = User::findOrFail($id);
        $profil = Siswa::where('users_id', $id)->first();
        $histori = Result::where('users_id', $id)->get();
        return view('backend.v_siswa.detail', [
            'judul' => 'Detail Akun Siswa Ujian',
            'sub' => $siswa->nama,
            'siswa' => $siswa,
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

        return redirect('/siswa')->with('success', 'Akun Siswa Berhasil diupdate.');
    }

    public function profil(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $Extension = $image->getClientOriginalExtension();
            $imagePath = Str::random(10) . '_' . time() . '.' . $Extension;
            $image->move('storage/siswa', $imagePath);
        }

        $user = auth()->user();
        Siswa::create([
            'name' => $user->nama,
            'users_id' => $user->id,
            'kelas' => $request->kelas,
            'image' => $imagePath,
            'status' => 1,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Profil Lengkap.');
    }

    public function destroy($id)
    {
        $siswa = User::find($id);
        try {
            $siswa->delete();
            return redirect()
                ->back()
                ->with('success', 'Akun Siswa deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error deleting akun karena akun masih aktif');
        }
    }
}
