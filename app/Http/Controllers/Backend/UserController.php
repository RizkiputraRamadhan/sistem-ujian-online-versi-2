<?php

namespace App\Http\Controllers\Backend;
// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('updated_at', 'desc')->get();
        return view('backend.v_user.index', [
            'judul' => 'User',
            'sub' => 'Data User',
            'index' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Akun',
            'sub' => 'Tambah Akun',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ddd($request);
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:user',
            'is_admin' => 'required',
            'hp' => 'required|min:10|max:13',
            'password' => 'required|min:4|confirmed',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ], $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ]);
        // $validatedData['password'] = Hash::make($validatedData['password']);

        //simpan gambar
        // if ($request->file('foto')) {
        //     $validatedData['foto'] = $request->file('foto')->store('img-user');
        // }
        //simpan gambar dg nama tanggal
        // if ($request->file('foto')) {
        //     $foto = $request->file('foto');
        //     $fileName = date('YmdHis') . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
        //     $validatedData['foto'] = $foto->storeAs('img-user', $fileName);
        // }
        //simpan gambar dg nama tgl, resize, tanpa direktori
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $fileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $destinationPath = public_path('storage/img-user/');
            $image = Image::make($file);
            //resize manual
            $image->fit(400, 430, function ($constraint) {
                $constraint->upsize();
            });
            //resize otomatis
            // $image->resize(400, null, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });
            $image->save($destinationPath . $fileName);
            $validatedData['foto'] = $fileName;
        }
        //password
        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
        // huruf kecil ([a-z]), huruf besar ([A-Z]), dan angka (\d) (?=.*[\W_]) simbol karakter (non-alphanumeric)
        if (preg_match($pattern, $password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);

            User::create($validatedData);
            return redirect('/user')->with('success', 'Data berhasil tersimpan');
        } else {
            return redirect()->back()->withErrors(['password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.v_user.edit', [
            'judul' => 'User',
            'sub' => 'Ubah User',
            'edit' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //ddd($request);
        $user = User::findOrFail($id);
        $rules = [
            'nama' => 'required|max:255',
            'is_admin' => 'required',
            'hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];
        $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|unique:user';
        }

        $validatedData = $request->validate($rules, $messages);
        //simpan gambar dg nama tgl, resize, tanpa direktori
        if ($request->file('foto')) {
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-user/') . $user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $fileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $destinationPath = public_path('storage/img-user/');
            $image = Image::make($file);
            //resize manual
            $image->fit(400, 430, function ($constraint) {
                $constraint->upsize();
            });
            //resize otomatis
            // $image->resize(400, null, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });
            $image->save($destinationPath . $fileName);
            $validatedData['foto'] = $fileName;
        }

        $user->update($validatedData);
        return redirect('/user')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = user::findOrFail($id);
        if ($user->foto) {
            $oldImagePath = public_path('storage/img-user/') . $user->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $user->delete();
        return redirect('/user')->with('msgSuccess', 'Data berhasil dihapus');
    }
}