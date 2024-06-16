<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use App\Models\Kamar;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    /**
     * Menampilkan daftar penghuni.
     */
    public function index()
    {
        $penghuni = Penghuni::with(['kamar', 'pemilik'])->orderBy('created_at', 'desc')->get();
        return view('backend.v_penghuni.index', [
            'judul' => 'Data Penghuni',
            'penghuni' => $penghuni
        ]);
    }

    /**
     * Menampilkan form untuk membuat penghuni baru.
     */
    public function create()
    {
        $kamar = Kamar::all();
        $pemilik = Pemilik::all();
        return view('backend.v_penghuni.create', [
            'judul' => 'Tambah Penghuni',
            'kamar' => $kamar,
            'pemilik' => $pemilik
        ]);
    }

    /**
     * Menyimpan penghuni baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:penghuni',
            'kamar_id' => 'required|exists:kamar,id',
            'pemilik_id' => 'required|exists:pemilik,id',
        ]);

        Penghuni::create($validatedData);

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil tersimpan');
    }

    /**
     * Menampilkan detail penghuni.
     */
    public function show($id)
    {
        $penghuni = Penghuni::with(['kamar', 'pemilik'])->findOrFail($id);
        return view('backend.v_penghuni.show', [
            'judul' => 'Detail Penghuni',
            'penghuni' => $penghuni
        ]);
    }

    /**
     * Menampilkan form untuk mengedit data penghuni.
     */
    public function edit($id)
    {
        $penghuni = Penghuni::findOrFail($id);
        $kamar = Kamar::all();
        $pemilik = Pemilik::all();
        return view('backend.v_penghuni.edit', [
            'judul' => 'Edit Penghuni',
            'penghuni' => $penghuni,
            'kamar' => $kamar,
            'pemilik' => $pemilik
        ]);
    }

    /**
     * Memperbarui data penghuni yang sudah ada di database.
     */
    public function update(Request $request, $id)
    {
        $penghuni = Penghuni::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:penghuni,email,' . $id,
            'kamar_id' => 'required|exists:kamar,id',
            'pemilik_id' => 'required|exists:pemilik,id',
        ]);

        $penghuni->update($validatedData);

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil diperbarui');
    }

    /**
     * Menghapus data penghuni dari database.
     */
    public function destroy($id)
    {
        $penghuni = Penghuni::findOrFail($id);
        $penghuni->delete();

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil dihapus');
    }
}