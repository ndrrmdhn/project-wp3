<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyewa;
use App\Models\User;
use App\Models\Kamar;
use Illuminate\Support\Facades\Storage;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewa = Penyewa::orderBy('id', 'desc')->get();
        return view('backend.v_penyewa.index', [
            'judul' => 'Data Penyewa',
            'penyewa' => $penyewa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Dapatkan semua ID yang sudah dipilih dari tabel penyewa
        $usedUserIds = Penyewa::pluck('user_id')->toArray();
        $usedKamarIds = Penyewa::pluck('kamar_id')->toArray();

        // Filter user dan kamar yang belum dipilih
        $user = User::whereNotIn('id', $usedUserIds)->get();
        $kamar = Kamar::whereNotIn('id', $usedKamarIds)->get();
        
        return view('backend.v_penyewa.create', [
            'judul' => 'Tambah Penyewa',
            'user' => $user,
            'kamar' => $kamar,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:user,id',
            'kamar_id' => 'required|exists:kamar,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kartu_identitas' => 'required|image|max:2048', // Kartu identitas sebagai file gambar maksimal 2MB
            'gender' => 'required|in:laki-laki,perempuan',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        // Mengunggah file kartu identitas ke penyimpanan

        if ($request->file('kartu_identitas')) {
            $file = $request->file('kartu_identitas');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/kartu_identitas/';
            $file->move($directory, $originalFileName);
            $validatedData['kartu_identitas'] = $originalFileName;
        }

        Penyewa::create($validatedData);

        return redirect('/penyewa')->with('success', 'Penyewa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penyewa = Penyewa::findOrFail($id);
        return view('backend.v_penyewa.show', [
            'judul' => 'Detail Penyewa',
            'penyewa' => $penyewa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penyewa = Penyewa::findOrFail($id);

        // Dapatkan semua ID yang sudah dipilih kecuali milik penyewa yang sedang diedit
        $usedUserIds = Penyewa::where('id', '!=', $id)->pluck('user_id')->toArray();
        $usedKamarIds = Penyewa::where('id', '!=', $id)->pluck('kamar_id')->toArray();

        // Filter user dan kamar yang belum dipilih, atau yang milik penyewa ini
        $user = User::whereNotIn('id', $usedUserIds)->orWhere('id', $penyewa->user_id)->get();
        $kamar = Kamar::whereNotIn('id', $usedKamarIds)->orWhere('id', $penyewa->kamar_id)->get();
        
        return view('backend.v_penyewa.edit', [
            'judul' => 'Ubah Penyewa',
            'penyewa' => $penyewa,
            'user' => $user,
            'kamar' => $kamar,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penyewa = Penyewa::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'required|exists:user,id',
            'kamar_id' => 'required|exists:kamar,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kartu_identitas' => 'nullable|image|max:2048', // Kartu identitas sebagai file gambar maksimal 2MB
            'gender' => 'required|in:laki-laki,perempuan',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        // Mengunggah file kartu identitas ke penyimpanan jika ada perubahan
        if ($request->file('kartu_identitas')) {
            if ($penyewa->kartu_identitas) {
                $oldImagePath = public_path('storage/kartu_identitas/') . $penyewa->kartu_identitas;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('kartu_identitas');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/kartu_identitas/';
            $file->move($directory, $originalFileName);
            $validatedData['kartu_identitas'] = $originalFileName;
        }

        $penyewa->update($validatedData);

        return redirect('/penyewa')->with('success', 'Penyewa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penyewa = Kamar::findOrFail($id);
        if ($penyewa->kartu_identitas) {
            $oldImagePath = public_path('storage/kartu_identitas/') . $penyewa->kartu_identitas;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $penyewa->delete();
        return redirect('/kamar')->with('msgSuccess', 'Penyewa berhasil dihapus');
    }
}