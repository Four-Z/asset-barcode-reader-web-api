<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;

class AsetsWebController extends Controller
{
    public function daftar_aset()
    {
        $asets = Aset::orderBy('created_at', 'desc')->get();
        return view("daftar_aset", [
            'asets' => $asets,
        ]);
    }

    public function detail_aset($id)
    {
        $aset = Aset::findOrFail($id);
        return view('detail_aset', [
            'aset' => $aset,
        ]);
    }

    public function edit_aset(Request $request, $id)
    {
        try {
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'id_barcode' => 'required|string|max:20',
                'nama_aset' => 'required|string|max:30',
                'merk_aset' => 'required|string|max:30',
                'tahun_beli' => 'required|string|max:4',
                'harga_beli' => 'required|string',
                'kondisi_aset' => 'required|exists:kondisi_aset,id', // Memastikan kondisi_aset ada di tabel kondisi_aset
                'lokasi_aset' => 'required|string|max:20',
                'keterangan' => 'nullable|string',
            ]);

            // Temukan aset berdasarkan ID
            $aset = Aset::findOrFail($id);

            // Update data Aset
            $aset->update($validatedData);

            alert()->success('Edit Berhasil', 'Berhasil Mengedit Aset.');
            return redirect()->route('daftar_aset_page');
        } catch (ValidationException $e) {
            alert()->error('Edit Gagal', $e->getMessage());
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error('Edit Gagal', $e->getMessage());
            return redirect()->back();
        }
    }

    public function gudang()
    {
        $softDeletedAsets = Aset::onlyTrashed()->orderBy('updated_at', 'desc')->get();
        return view('gudang', [
            'asets' => $softDeletedAsets,
        ]);
    }

    public function hapus_aset($id)
    {
        try {
            // Temukan aset berdasarkan ID
            $aset = Aset::findOrFail($id);

            // Soft delete data Aset
            $aset->delete();

            alert()->success('Berhasil', 'Aset Berhasil Dipindahkan ke Gudang');
            return redirect()->route('daftar_aset_page');
        } catch (Exception $e) {
            alert()->success('Gagal', $e->getMessage());
            return redirect()->route('daftar_aset_page');
        }
    }

    public function restore_aset($id)
    {
        try {
            // Temukan aset yang terhapus berdasarkan ID
            $aset = Aset::onlyTrashed()->findOrFail($id);

            // Restore data Aset
            $aset->restore();

            alert()->success('Berhasil', 'Aset Berhasil Direstore');
            return redirect()->back();
        } catch (Exception $e) {
            alert()->success('Gagal', $e->getMessage());
            return redirect()->back();
        }
    }

    public function hapus_aset_permanen($id)
    {
        try {
            // Temukan aset yang terhapus berdasarkan ID
            $aset = Aset::onlyTrashed()->findOrFail($id);

            // Hapus permanen data Aset
            $aset->forceDelete();

            alert()->success('Berhasil', 'Aset Berhasil Dihapus permanen');
            return redirect()->back();
        } catch (Exception $e) {
            alert()->success('Gagal', $e->getMessage());
            return redirect()->back();
        }
    }


    public function klasifikasi_aset(Request $request)
    {
        $kondisiAset = $request->query('kondisi');
        switch ($kondisiAset) {
            case 'baik':
                $asets = Aset::onlyTrashed()->where('kondisi_aset', 1)->get();
                break;
            case 'rusak':
                $asets = Aset::onlyTrashed()->where('kondisi_aset', 2)->get();
                break;
            case 'usang':
                $asets = Aset::onlyTrashed()->where('kondisi_aset', 3)->get();
                break;
            case 'hilang':
                $asets = Aset::onlyTrashed()->where('kondisi_aset', 4)->get();
                break;
            default:
                alert()->success('Gagal', 'gagal mendapatkan aset');
                return redirect()->back();
        }

        return view('klasifikasi_aset', [
            'asets' => $asets,
            'kondisi' => $kondisiAset
        ]);
    }
}
