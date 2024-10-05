@extends('layout.dashboard_admin_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('compiled/css/table-datatable.css') }}">
@endsection

@section('title_page')
    <h3>Daftar Surat Pengadaan Aset</h3>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Daftar Surat Pengadaan Aset
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tambah_surat_page') }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-primary ms-1">
                    <span class="d-none d-sm-block">Tambah Surat</span>
                </button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Tujuan Surat</th>
                        <th>Penanda Tangan</th>
                        <th>Tanggal Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surat_pengadaan_barang as $surat)
                        <tr>
                            <td>{{ $surat->nomor_surat }}</td>
                            <td>{{ $surat->tujuan_surat }}</td>
                            <td>{{ $surat->nama_penanda_tangan }}</td>
                            <td>{{ $surat->tanggal_surat->format('d-m-Y') }}</td>
                            <td>
                                <center>
                                    <form action="{{ route('cetak_surat_pengadaan', $surat->id) }}" method="GET"
                                        class="d-inline-block" target="_blank">
                                        @csrf
                                        <button class="btn btn-info btn-icon-split">
                                            <span class="icon text-black-50">
                                                <i class="fas fa-regular fa-print"></i>
                                            </span>
                                            <span class="text">Cetak</span>
                                        </button>
                                    </form>

                                    <button type="button" class="btn btn-danger btn-icon-split" data-bs-toggle="modal"
                                        data-bs-target="#deleteSurat-{{ $surat->id }}">
                                        <span class="icon text-black-50">
                                            <i class="fas fa-solid fa-trash"></i>
                                        </span>
                                        <span class="text">&nbsp Hapus</span>
                                    </button>
                                </center>
                            </td>
                        </tr>

                        {{-- MODAL DELETE --}}
                        <div class="modal fade" id="deleteSurat-{{ $surat->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="deleteSurat-{{ $surat->id }}Title" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteSurat-{{ $surat->id }}Title">
                                            Konfirmasi
                                        </h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Apa anda yakin ingin menghapus permanen surat?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Tutup</span>
                                        </button>
                                        <form action="{{ route('hapus_surat', $surat->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger ms-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Terima</span>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- MODAL DELETE --}}
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('static/js/pages/simple-datatables.js') }}"></script>
@endsection
