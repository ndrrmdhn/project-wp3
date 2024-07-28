<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Penyewa;
use App\Models\Kamar;

class PembayaranController extends Controller
{
    /**
     * Menampilkan daftar pembayaran.
     */
    public function index()
    {
        $pembayaran = Pembayaran::with(['penyewa', 'kamar'])->orderBy('created_at', 'desc')->get();
        return view('backend.v_pembayaran.index', [
            'judul' => 'Data Pembayaran',
            'pembayaran' => $pembayaran
        ]);
    }

    /**
     * Menampilkan form untuk membuat pembayaran baru.
     */
    public function create()
    {
        $penyewa = Penyewa::all();
        $kamar = Kamar::all();
        return view('backend.v_pembayaran.create', [
            'judul' => 'Tambah Pembayaran',
            'penyewa' => $penyewa,
            'kamar' => $kamar
        ]);
    }

    /**
     * Menyimpan pembayaran baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_pembayaran' => 'required|string|unique:pembayaran,nomor_pembayaran',
            'tanggal_pembayaran' => 'required|date',
            'jumlah_pembayaran' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'penyewa_id' => 'required|exists:penyewa,id',
            'kamar_id' => 'required|exists:kamar,id'
        ]);

        Pembayaran::create($validatedData);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data pembayaran berhasil tersimpan');
    }

    /**
     * Menampilkan detail pembayaran.
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with(['penyewa', 'kamar'])->findOrFail($id);
        return view('backend.v_pembayaran.show', [
            'judul' => 'Detail Pembayaran',
            'pembayaran' => $pembayaran
        ]);
    }

    /**
     * Menampilkan form untuk mengedit data pembayaran.
     */
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $penyewa = Penyewa::all();
        $kamar = Kamar::all();
        return view('backend.v_pembayaran.edit', [
            'judul' => 'Edit Pembayaran',
            'pembayaran' => $pembayaran,
            'penyewa' => $penyewa,
            'kamar' => $kamar
        ]);
    }

    /**
     * Memperbarui data pembayaran yang sudah ada di database.
     */
    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validatedData = $request->validate([
            'nomor_pembayaran' => 'required|string|unique:pembayaran,nomor_pembayaran,' . $pembayaran->id,
            'tanggal_pembayaran' => 'required|date',
            'jumlah_pembayaran' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'penyewa_id' => 'required|exists:penyewa,id',
            'kamar_id' => 'required|exists:kamar,id'
        ]);

        $pembayaran->update($validatedData);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data pembayaran berhasil diperbarui');
    }

    /**
     * Menghapus data pembayaran dari database.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data pembayaran berhasil dihapus');
    }
}