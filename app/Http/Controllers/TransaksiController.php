<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Anggota;
use App\Models\User;
use App\Models\Produk;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::orderBy('id', 'desc')->get();
        return view('backend.v_transaksi.index', [
            'judul' => 'Data Transaksi',
            'index' => $transaksi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // no. transaksi otomatis
        $today = now()->format('Ymd');
        $lastNumber = Transaksi::where('notran', 'like', $today . '%')->max('notran');
        $newNumber = $today . str_pad((int) substr($lastNumber, -3) + 1, 3, '0', STR_PAD_LEFT);
        //data anggota
        $anggota = Anggota::join('user', 'anggota.user_id', '=', 'user.id')
            ->where('user.status', 1)
            ->orderBy('user.nama', 'asc')
            ->select('anggota.*', 'user.nama')
            ->get();
        //data produk
        $produk = Produk::where('status', 1)
            ->orderBy('nama_produk', 'asc')
            ->get();
        return view('backend.v_transaksi.create', [
            'judul' => 'Tambah Transaksi',
            'notran' => $newNumber,
            'anggota' => $anggota,
            'produk' => $produk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'notran' => 'required|unique:transaksi,notran',
            'anggota_id' => 'required',
            'produk_id.*' => 'required',
            'jumbel.*' => 'required|integer|min:1'
        ]);

        Transaksi::create([
            'notran' => $request->notran,
            'anggota_id' => $request->anggota_id,
            'user_id' => auth()->id(),
            'tanggal' => now(),
            'status' => 1,
            'total_bayar' => array_sum(array_map(function ($harga, $jumbel) {
                return $harga * $jumbel;
            }, $request->harga, $request->jumbel))
        ]);
        // $validatedData['status'] = 1;

        foreach ($request->produk_id as $index => $produk_id) {
            $produk = Produk::find($produk_id);
            $stok_baru = $produk->stok - $request->jumbel[$index];
            $produk->update(['stok' => $stok_baru]);

            TransaksiDetail::create([
                'notran' => $request->notran,
                'produk_id' => $produk_id,
                'harga' => $request->harga[$index],
                'jumbel' => $request->jumbel[$index]
            ]);
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan');
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
    public function edit(string $id)
    {
        $transaksi = Transaksi::find($id);
        return view('backend.v_transaksi.edit', [
            'judul' => 'Ubah Transaksi',
            'edit' => $transaksi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'nama' => 'required|max:100',
            'hp' => 'required|min:10|max:13',
        ];
        $validatedData = $request->validate($rules);
        Transaksi::where('id', $id)->update($validatedData);
        return redirect('/transaksi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        User::where('id', $transaksi->user_id)->update(['status' => 0]);
        $transaksi->delete();
        return redirect('/transaksi');
    }

    public function getAnggota($id)
    {
        $anggota = Anggota::find($id);
        $user = User::find($anggota->user_id);
        return response()->json([
            'nama' => $user->nama
        ]);
    }

    public function getProduk($id)
    {
        $produk = Produk::find($id);
        return response()->json($produk);
    }
}
