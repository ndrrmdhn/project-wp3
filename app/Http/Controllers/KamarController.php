<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamar = Kamar::orderBy('updated_at', 'desc')->get();
        return view('backend.v_kamar.index', [
            'judul' => 'Data Kamar',
            'kamar' => $kamar
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_kamar.create', [
            'judul' => 'Tambah Kamar'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pemilik' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'luas' => 'required|numeric',
            'tipe_kamar' => 'required|in:putra,putri,campuran',
            'status' => 'required|in:tersedia,disewa,terbooking',
            'alamat' => 'required|string|max:255',
            'fasilitas_ac' => 'boolean',
            'fasilitas_wifi' => 'boolean',
            'fasilitas_tv' => 'boolean',
            'fasilitas_perabotan' => 'boolean',
            'fasilitas_dapur' => 'boolean',
            'fasilitas_kamar_mandi_dalam' => 'boolean',
            'fasilitas_keamanan_24_jam' => 'boolean',
            'fasilitas_tempat_parkir' => 'boolean',
            'foto_utama' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
            'foto_tambahan' => 'nullable|array',
        ], [
            'foto_utama.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto_utama.max' => 'Ukuran file gambar maksimal adalah 1024 KB.'
        ]);

        if ($request->file('foto_utama')) {
            $file = $request->file('foto_utama');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-kamar/';
            $file->move($directory, $originalFileName);
            $validatedData['foto_utama'] = $originalFileName;
        }

        Kamar::create($validatedData);
        return redirect('/kamar')->with('success', 'Data berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('backend.v_kamar.show', [
            'judul' => 'Detail Kamar',
            'kamar' => $kamar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('backend.v_kamar.edit', [
            'judul' => 'Ubah Kamar',
            'kamar' => $kamar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $validatedData = $request->validate([
            'pemilik' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'luas' => 'required|numeric',
            'tipe_kamar' => 'required|in:putra,putri,campuran',
            'status' => 'required|in:tersedia,disewa,terbooking',
            'alamat' => 'required|string|max:255',
            'fasilitas_ac' => 'boolean',
            'fasilitas_wifi' => 'boolean',
            'fasilitas_tv' => 'boolean',
            'fasilitas_perabotan' => 'boolean',
            'fasilitas_dapur' => 'boolean',
            'fasilitas_kamar_mandi_dalam' => 'boolean',
            'fasilitas_keamanan_24_jam' => 'boolean',
            'fasilitas_tempat_parkir' => 'boolean',
            'foto_utama' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
            'foto_tambahan' => 'nullable|array',
        ], [
            'foto_utama.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto_utama.max' => 'Ukuran file gambar maksimal adalah 1024 KB.'
        ]);

        if ($request->file('foto_utama')) {
            if ($kamar->foto_utama) {
                $oldImagePath = public_path('storage/img-kamar/') . $kamar->foto_utama;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('foto_utama');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-kamar/';
            $file->move($directory, $originalFileName);
            $validatedData['foto_utama'] = $originalFileName;
        }

        $kamar->update($validatedData);
        return redirect('/kamar')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        if ($kamar->foto_utama) {
            $oldImagePath = public_path('storage/img-kamar/') . $kamar->foto_utama;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $kamar->delete();
        return redirect('/kamar')->with('msgSuccess', 'Data berhasil dihapus');
    }
}
