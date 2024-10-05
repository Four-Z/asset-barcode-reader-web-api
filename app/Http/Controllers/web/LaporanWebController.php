<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanWebController extends Controller
{
    public function laporan_init()
    {
        return view('laporan_init');
    }

    public function cetak_laporan(Request $request)
    {
        // Mengonversi string menjadi instance Carbon
        $start_date = Carbon::createFromFormat('Y-m-d H:i', $request->start_date);
        $end_date = Carbon::createFromFormat('Y-m-d H:i', $request->end_date);

        // Ambil nilai dari radio button
        $aset_status = $request->input('aset_status');

        // check status aset
        if ($aset_status == 'masuk') {
            // Filter aset berdasarkan tanggal created_at
            $asets = Aset::whereBetween('created_at', [$start_date, $end_date])->get();
            $judul = "ASET MASUK";
        } else if ($aset_status == 'keluar') {
            $asets = Aset::onlyTrashed()->whereBetween('deleted_at', [$start_date, $end_date])->get();
            $judul = "ASET KELUAR";
        }

        $jumlah_aset_kondisi_baik = $asets->where('kondisi_aset', 1)->count();
        $jumlah_aset_kondisi_rusak = $asets->where('kondisi_aset', 2)->count();
        $jumlah_aset_kondisi_usang = $asets->where('kondisi_aset', 3)->count();
        $jumlah_aset_kondisi_hilang = $asets->where('kondisi_aset', 4)->count();

        $total_harga_aset_kondisi_baik = $asets->where('kondisi_aset', 1)->sum('harga_beli');
        $total_harga_aset_kondisi_rusak = $asets->where('kondisi_aset', 2)->sum('harga_beli');
        $total_harga_aset_kondisi_usang = $asets->where('kondisi_aset', 3)->sum('harga_beli');
        $total_harga_aset_kondisi_hilang = $asets->where('kondisi_aset', 4)->sum('harga_beli');

        return view('laporan_print', [
            'judul' => $judul,
            'start_date' => $start_date->format('d/m/Y'),
            'end_date' => $end_date->format('d/m/Y'),
            'asets' => $asets,
            'jumlah_aset_kondisi_baik' => $jumlah_aset_kondisi_baik,
            'jumlah_aset_kondisi_rusak' => $jumlah_aset_kondisi_rusak,
            'jumlah_aset_kondisi_usang' => $jumlah_aset_kondisi_usang,
            'jumlah_aset_kondisi_hilang' => $jumlah_aset_kondisi_hilang,
            'total_harga_aset_kondisi_baik' => $total_harga_aset_kondisi_baik,
            'total_harga_aset_kondisi_rusak' => $total_harga_aset_kondisi_rusak,
            'total_harga_aset_kondisi_usang' => $total_harga_aset_kondisi_usang,
            'total_harga_aset_kondisi_hilang' => $total_harga_aset_kondisi_hilang,
        ]);
    }

    public function cetak_semua_aset()
    {
        $asets = Aset::all();

        $jumlah_aset_kondisi_baik = $asets->where('kondisi_aset', 1)->count();
        $jumlah_aset_kondisi_rusak = $asets->where('kondisi_aset', 2)->count();
        $jumlah_aset_kondisi_usang = $asets->where('kondisi_aset', 3)->count();
        $jumlah_aset_kondisi_hilang = $asets->where('kondisi_aset', 4)->count();

        $total_harga_aset_kondisi_baik = $asets->where('kondisi_aset', 1)->sum('harga_beli');
        $total_harga_aset_kondisi_rusak = $asets->where('kondisi_aset', 2)->sum('harga_beli');
        $total_harga_aset_kondisi_usang = $asets->where('kondisi_aset', 3)->sum('harga_beli');
        $total_harga_aset_kondisi_hilang = $asets->where('kondisi_aset', 4)->sum('harga_beli');

        return view('laporan_print', [
            'judul' => "SEMUA ASET",
            'asets' => $asets,
            'jumlah_aset_kondisi_baik' => $jumlah_aset_kondisi_baik,
            'jumlah_aset_kondisi_rusak' => $jumlah_aset_kondisi_rusak,
            'jumlah_aset_kondisi_usang' => $jumlah_aset_kondisi_usang,
            'jumlah_aset_kondisi_hilang' => $jumlah_aset_kondisi_hilang,
            'total_harga_aset_kondisi_baik' => $total_harga_aset_kondisi_baik,
            'total_harga_aset_kondisi_rusak' => $total_harga_aset_kondisi_rusak,
            'total_harga_aset_kondisi_usang' => $total_harga_aset_kondisi_usang,
            'total_harga_aset_kondisi_hilang' => $total_harga_aset_kondisi_hilang,
        ]);
    }

    public function cetak_semua_aset_gudang()
    {
        $asets = Aset::onlyTrashed()->get();

        $jumlah_aset_kondisi_baik = $asets->where('kondisi_aset', 1)->count();
        $jumlah_aset_kondisi_rusak = $asets->where('kondisi_aset', 2)->count();
        $jumlah_aset_kondisi_usang = $asets->where('kondisi_aset', 3)->count();
        $jumlah_aset_kondisi_hilang = $asets->where('kondisi_aset', 4)->count();

        $total_harga_aset_kondisi_baik = $asets->where('kondisi_aset', 1)->sum('harga_beli');
        $total_harga_aset_kondisi_rusak = $asets->where('kondisi_aset', 2)->sum('harga_beli');
        $total_harga_aset_kondisi_usang = $asets->where('kondisi_aset', 3)->sum('harga_beli');
        $total_harga_aset_kondisi_hilang = $asets->where('kondisi_aset', 4)->sum('harga_beli');

        return view('laporan_print', [
            'judul' => "SEMUA ASET GUDANG",
            'asets' => $asets,
            'jumlah_aset_kondisi_baik' => $jumlah_aset_kondisi_baik,
            'jumlah_aset_kondisi_rusak' => $jumlah_aset_kondisi_rusak,
            'jumlah_aset_kondisi_usang' => $jumlah_aset_kondisi_usang,
            'jumlah_aset_kondisi_hilang' => $jumlah_aset_kondisi_hilang,
            'total_harga_aset_kondisi_baik' => $total_harga_aset_kondisi_baik,
            'total_harga_aset_kondisi_rusak' => $total_harga_aset_kondisi_rusak,
            'total_harga_aset_kondisi_usang' => $total_harga_aset_kondisi_usang,
            'total_harga_aset_kondisi_hilang' => $total_harga_aset_kondisi_hilang,

        ]);
    }

    public function cetak_aset_berdasarkan_kondisi(Request $request)
    {

        $kondisiAset = $request->query('kondisi');
        switch ($kondisiAset) {
            case 'baik':
                $asets = Aset::onlyTrashed()->where('kondisi_aset', 1)->get();
                $jumlah_aset_kondisi = $asets->where('kondisi_aset', 1)->count();
                $total_harga_aset_kondisi = $asets->where('kondisi_aset', 1)->sum('harga_beli');
                break;
            case 'rusak':
                $asets = Aset::onlyTrashed()->where('kondisi_aset', 2)->get();
                $jumlah_aset_kondisi = $asets->where('kondisi_aset', 2)->count();
                $total_harga_aset_kondisi = $asets->where('kondisi_aset', 2)->sum('harga_beli');
                break;
            case 'usang':
                $asets = Aset::onlyTrashed()->where('kondisi_aset', 3)->get();
                $jumlah_aset_kondisi = $asets->where('kondisi_aset', 3)->count();
                $total_harga_aset_kondisi = $asets->where('kondisi_aset', 3)->sum('harga_beli');
                break;
            case 'hilang':
                $asets = Aset::onlyTrashed()->where('kondisi_aset', 4)->get();
                $jumlah_aset_kondisi = $asets->where('kondisi_aset', 4)->count();
                $total_harga_aset_kondisi = $asets->where('kondisi_aset', 4)->sum('harga_beli');
                break;
            default:
                alert()->success('Gagal', 'gagal mendapatkan aset');
                return redirect()->back();
        }

        return view('laporan_print', [
            'judul' => "ASET GUDANG KONDISI " . strtoupper($kondisiAset),
            'asets' => $asets,
            'jumlah_aset_kondisi' => $jumlah_aset_kondisi,
            'total_harga_aset_kondisi' => $total_harga_aset_kondisi
        ]);
    }
}
