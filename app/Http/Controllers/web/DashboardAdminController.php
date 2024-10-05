<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function home()
    {

        // Menghitung jumlah total aset
        $total_aset = Aset::count();

        // Menghitung jumlah total aset yang dihapus (soft deleted)
        $total_aset_gudang = Aset::onlyTrashed()->count();

        // Menghitung jumlah total aset yang dibuat pada bulan ini
        $total_aset_bulan_ini = Aset::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        // Menghitung jumlah total aset yang dihapus pada bulan ini
        $total_aset_gudang_bulan_ini = Aset::onlyTrashed()
            ->whereYear('deleted_at', Carbon::now()->year)
            ->whereMonth('deleted_at', Carbon::now()->month)
            ->count();

        $jumlah_aset_kondisi_baik = Aset::withTrashed()->where('kondisi_aset', 1)->count();
        $jumlah_aset_kondisi_rusak = Aset::withTrashed()->where('kondisi_aset', 2)->count();
        $jumlah_aset_kondisi_usang = Aset::withTrashed()->where('kondisi_aset', 3)->count();
        $jumlah_aset_kondisi_hilang = Aset::withTrashed()->where('kondisi_aset', 4)->count();

        return view('home_admin', [
            'total_aset' => $total_aset,
            'total_aset_gudang' => $total_aset_gudang,
            'total_aset_bulan_ini' => $total_aset_bulan_ini,
            'total_aset_gudang_bulan_ini' => $total_aset_gudang_bulan_ini,
            'jumlah_aset_kondisi_baik' => $jumlah_aset_kondisi_baik,
            'jumlah_aset_kondisi_rusak' => $jumlah_aset_kondisi_rusak,
            'jumlah_aset_kondisi_usang' => $jumlah_aset_kondisi_usang,
            'jumlah_aset_kondisi_hilang' => $jumlah_aset_kondisi_hilang
        ]);
    }
}
