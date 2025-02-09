<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\LaporanPenjualan;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->subWeek()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $startDate = date('Y-m-d 00:00:00', strtotime($startDate));
        $endDate = date('Y-m-d 23:59:59', strtotime($endDate));

        $riwayat = LaporanPenjualan::with(['pelanggan'])
            ->whereBetween('tanggal_transaksi', [$startDate, $endDate])
            ->get();

        return view('kasir.riwayat.index', compact('riwayat', 'startDate', 'endDate'));
    }

    // public function show($id)
    // {
    //     // Ambil detail riwayat penjualan berdasarkan ID dengan relasi pelanggan dan detail penjualan
    //     $riwayat = riwayatPenjualan::with(['pelanggan', 'detail.produk', 'Petugas'])
    //         ->findOrFail($id);

    //     return view('kasir.riwayat.detail', compact('riwayat'));
    // }
}