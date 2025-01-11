<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->get();
        return view('backend.v_user.index', [
            'judul' => 'Data User',
            'index' => $users
        ]);
    }

    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'hp' => 'required|min:10|max:13',
            'password' => 'required|min:6|confirmed',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ]);

        $validatedData['status'] = 1; // Default status aktif

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $directory = 'storage/img-user/';
            $fileName = uniqid() . '_' . $file->getClientOriginalName(); // Nama file unik
            $file->move(public_path($directory), $fileName);
            $validatedData['foto'] = $fileName;
        }

        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
        if (preg_match($pattern, $password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::create($validatedData);
            return redirect('/user')->with('success', 'Data berhasil tersimpan');
        } else {
            return redirect()->back()->withErrors(['password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.']);
        }
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.v_user.show', [
            'judul' => 'Detail User',
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.v_user.edit', [
            'judul' => 'Ubah User',
            'edit' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'nama' => 'required|max:255',
            'role' => 'required',
            'status' => 'required',
            'hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|unique:users';
        }

        $validatedData = $request->validate($rules);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-user/') . $user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('foto');
            $directory = 'storage/img-user/';
            $fileName = uniqid() . '_' . $file->getClientOriginalName(); // Nama file unik
            $file->move(public_path($directory), $fileName);
            $validatedData['foto'] = $fileName;
        }

        $user->update($validatedData);
        return redirect('/user')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
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
