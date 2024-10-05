<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aset;
use Illuminate\Validation\ValidationException;
use Exception;

class AsetsController extends Controller
{

    public function get_aset_by_idBarcode($id)
    {
        try {
            // Dapatkan seluruh aset yang tidak di soft delete
            $aset = Aset::findOrFail($id);

            // Kembalikan respon JSON jika berhasil
            return response()->json([
                'message' => 'Berhasil mendapatkan aset',
                'asets' => $aset
            ], 200);
        } catch (Exception $e) {
            // Kembalikan respon JSON jika gagal
            return response()->json([
                'message' => 'Gagal mendapatkan daftar aset',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function get_all_asets()
    {
        try {
            // Dapatkan seluruh aset yang tidak di soft delete
            $asets = Aset::all();

            // Kembalikan respon JSON jika berhasil
            return response()->json([
                'message' => 'Berhasil mendapatkan daftar aset',
                'asets' => $asets
            ], 200);
        } catch (Exception $e) {
            // Kembalikan respon JSON jika gagal
            return response()->json([
                'message' => 'Gagal mendapatkan daftar aset',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function get_asets_gudang()
    {
        try {
            // Dapatkan seluruh aset yang di-soft delete
            $softDeletedAsets = Aset::onlyTrashed()->get();

            // Kembalikan respon JSON jika berhasil
            return response()->json([
                'message' => 'Berhasil mendapatkan daftar seluruh aset yang di gudang',
                'asets' => $softDeletedAsets
            ], 200);
        } catch (Exception $e) {
            // Kembalikan respon JSON jika gagal
            return response()->json([
                'message' => 'Gagal mendapatkan daftar aset yang di gudang',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Store a newly created Aset in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tambah_aset(Request $request)
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

            // Buat dan simpan data Aset
            $aset = Aset::create($validatedData);

            // Kembalikan respon JSON jika berhasil
            return response()->json([
                'message' => 'Aset berhasil ditambahkan',
                'aset' => $aset
            ], 200);
        } catch (ValidationException $e) {
            // Kembalikan respon JSON jika validasi gagal
            return response()->json([
                'message' => 'Gagal menambahkan aset',
                'error' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            // Kembalikan respon JSON jika gagal
            return response()->json([
                'message' => 'Gagal menambahkan aset',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified Aset in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit_aset(Request $request, $id)
    {
        try {
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'kondisi_aset' => 'required|exists:kondisi_aset,id', // Memastikan kondisi_aset ada di tabel kondisi_aset
            ]);

            // Temukan aset berdasarkan ID
            $aset = Aset::findOrFail($id);

            // Update data Aset
            $aset->update($validatedData);

            // Kembalikan respon JSON jika berhasil
            return response()->json([
                'message' => 'Aset berhasil diperbarui',
                'aset' => $aset
            ], 200);
        } catch (ValidationException $e) {
            // Kembalikan respon JSON jika validasi gagal
            return response()->json([
                'message' => 'Gagal memperbarui aset',
                'error' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            // Kembalikan respon JSON jika gagal
            return response()->json([
                'message' => 'Gagal memperbarui aset',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function hapus_aset($id)
    {
        try {
            // Temukan aset berdasarkan ID
            $aset = Aset::findOrFail($id);

            // Soft delete data Aset
            $aset->delete();

            // Kembalikan respon JSON jika berhasil
            return response()->json([
                'message' => 'Aset berhasil dipindahkan ke Gudang'
            ], 200);
        } catch (Exception $e) {
            // Kembalikan respon JSON jika gagal
            return response()->json([
                'message' => 'Gagal memindahkan aset',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore_aset($id)
    {
        try {
            // Temukan aset yang terhapus berdasarkan ID
            $aset = Aset::onlyTrashed()->findOrFail($id);

            // Restore data Aset
            $aset->restore();

            // Kembalikan respon JSON jika berhasil
            return response()->json([
                'message' => 'Aset berhasil dipulihkan',
                'aset' => $aset
            ], 200);
        } catch (Exception $e) {
            // Kembalikan respon JSON jika gagal
            return response()->json([
                'message' => 'Gagal memulihkan aset',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function hapus_permanen_aset($id)
    {
        try {
            // Temukan aset yang terhapus berdasarkan ID
            $aset = Aset::onlyTrashed()->findOrFail($id);

            // Hapus permanen data Aset
            $aset->forceDelete();

            // Kembalikan respon JSON jika berhasil
            return response()->json([
                'message' => 'Aset berhasil dihapus secara permanen'
            ], 200);
        } catch (Exception $e) {
            // Kembalikan respon JSON jika gagal
            return response()->json([
                'message' => 'Gagal menghapus aset secara permanen',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
