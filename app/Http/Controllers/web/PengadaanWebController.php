<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\AsetPengadaan;
use App\Models\SuratPengadaanBarang;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengadaanWebController extends Controller
{
    public function daftar_surat_page()
    {
        $surat_pengadaan_barang = SuratPengadaanBarang::all();
        return view('daftar_surat_pengadaan', [
            'surat_pengadaan_barang' => $surat_pengadaan_barang
        ]);
    }

    public function tambah_surat_page()
    {
        return view('tambah_surat_form');
    }

    public function tambah_surat(Request $request)
    {
        // Validasi data form
        $request->validate([
            'nomor_surat' => 'required|string',
            'tujuan_surat' => 'required|string',
            'nama_penanda_tangan' => 'required|string',
            'tanggal_surat' => 'required|date',
            'kode_barang' => 'required|array',
            'rincian' => 'required|array',
            'kode_barang.*' => 'required|string',
            'rincian.*' => 'required|string',
        ]);

        // Ambil data surat dari request
        $nomorSurat = $request->input('nomor_surat');
        $tujuanSurat = $request->input('tujuan_surat');
        $penandaTangan = $request->input('nama_penanda_tangan');
        $tanggalSurat = $request->input('tanggal_surat');
        $tanggalSurat = Carbon::createFromFormat('Y-m-d H:i', $tanggalSurat);

        // Ambil data aset dari request
        $kodeBarangArray = $request->input('kode_barang');
        $rincianArray = $request->input('rincian');
        $jumlahArray = $request->input('jumlah');

        // Gunakan DB Transaction
        DB::beginTransaction();

        try {
            // Create Surat
            $surat_pengadaan = SuratPengadaanBarang::create([
                'nomor_surat' => $nomorSurat,
                'tujuan_surat' => $tujuanSurat,
                'nama_penanda_tangan' => $penandaTangan,
                'tanggal_surat' => $tanggalSurat
            ]);

            // Simpan setiap aset ke dalam tabel aset pengadaaan (foreign key ke id surat pengadaan)
            foreach ($kodeBarangArray as $index => $kodeBarang) {
                AsetPengadaan::create([
                    'kode_barang' => $kodeBarang,
                    'rincian' => $rincianArray[$index],
                    'jumlah' => $jumlahArray[$index],
                    'surat_pengadaan_barang_id' => $surat_pengadaan->id
                ]);
            }

            // Commit transaksi jika semua berhasil
            DB::commit();

            alert()->success('Berhasil', 'Surat berhasil dibuat');
            return redirect()->route('daftar_surat_page');
        } catch (Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();

            alert()->error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('daftar_surat_page');
        }
    }

    public function cetak_surat_pengadaan($id)
    {
        $surat_pengadaan = SuratPengadaanBarang::findOrFail($id);
        $aset_pengadaan = AsetPengadaan::where('surat_pengadaan_barang_id', $surat_pengadaan->id)->get();

        return view('surat_pengadaan_barang', [
            'surat_pengadaan' => $surat_pengadaan,
            'aset_pengadaan' => $aset_pengadaan
        ]);
    }

    public function hapus_surat($id)
    {
        // Gunakan DB Transaction
        DB::beginTransaction();

        try {
            // Cari surat pengadaan berdasarkan ID
            $surat_pengadaan = SuratPengadaanBarang::findOrFail($id);

            // Hapus semua aset yang terkait dengan surat pengadaan
            AsetPengadaan::where('surat_pengadaan_barang_id', $surat_pengadaan->id)->delete();

            // Hapus surat pengadaan
            $surat_pengadaan->delete();

            // Commit transaksi jika semua berhasil
            DB::commit();

            alert()->success('Berhasil', 'Surat pengadaan dan aset terkait berhasil dihapus');
            return redirect()->route('daftar_surat_page');
        } catch (Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();

            alert()->error('Gagal', 'Terjadi kesalahan saat menghapus surat pengadaan: ' . $e->getMessage());
            return redirect()->route('daftar_surat_page');
        }
    }
}
