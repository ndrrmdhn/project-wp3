<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    /**
     * Menampilkan daftar pemilik.
     */
    public function index()
    {
        $pemilik = Pemilik::orderBy('created_at', 'desc')->get();
        return view('backend.v_pemilik.index', [
            'judul' => 'Data Pemilik',
            'pemilik' => $pemilik
        ]);
    }

    /**
     * Menampilkan form untuk membuat pemilik baru.
     */
    public function create()
    {
        return view('backend.v_pemilik.create', [
            'judul' => 'Tambah Pemilik'
        ]);
    }

    /**
     * Menyimpan pemilik baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:pemilik',
        ]);

        Pemilik::create($validatedData);

        return redirect()->route('pemilik.index')
            ->with('success', 'Data pemilik berhasil tersimpan');
    }

    /**
     * Menampilkan detail pemilik.
     */
    public function show($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        return view('backend.v_pemilik.show', [
            'judul' => 'Detail Pemilik',
            'pemilik' => $pemilik
        ]);
    }

    /**
     * Menampilkan form untuk mengedit data pemilik.
     */
    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        return view('backend.v_pemilik.edit', [
            'judul' => 'Edit Pemilik',
            'pemilik' => $pemilik
        ]);
    }

    /**
     * Memperbarui data pemilik yang sudah ada di database.
     */
    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:pemilik,email,' . $id,
        ]);

        $pemilik->update($validatedData);

        return redirect()->route('pemilik.index')
            ->with('success', 'Data pemilik berhasil diperbarui');
    }

    /**
     * Menghapus data pemilik dari database.
     */
    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();

        return redirect()->route('pemilik.index')
            ->with('success', 'Data pemilik berhasil dihapus');
    }
}