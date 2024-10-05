@extends('layout.dashboard_admin_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('compiled/css/table-datatable.css') }}">
@endsection

@section('title_page')
    <h3>Aset Gudang Kondisi {{ ucfirst($kondisi) }}</h3>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Daftar Aset
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Id Barcode</th>
                        <th>Nama Aset</th>
                        <th>Kondisi</th>
                        <th>Tanggal Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asets as $aset)
                        <tr>
                            <td>{{ $aset->id_barcode }}</td>
                            <td>{{ $aset->nama_aset }}</td>
                            <td>{{ $aset->kondisiAset->kondisi }}</td>
                            <td>{{ $aset->updated_at->format('d/m/Y') }}</td>
                            <td>
                                <center>

                                    <button type="button" class="btn btn-success btn-icon-split" data-bs-toggle="modal"
                                        data-bs-target="#restoreModal-{{ $aset->id_barcode }}">
                                        <span class="icon text-black-50">
                                            <i class="fas fa-solid fa-caret-left"></i>
                                        </span>
                                        <span class="text">&nbsp Restore</span>
                                    </button>

                                    <button type="button" class="btn btn-danger btn-icon-split" data-bs-toggle="modal"
                                        data-bs-target="#deleteAset-{{ $aset->id_barcode }}">
                                        <span class="icon text-black-50">
                                            <i class="fas fa-solid fa-trash"></i>
                                        </span>
                                        <span class="text">&nbsp Hapus</span>
                                    </button>

                                    {{-- MODAL RESTORE --}}
                                    <div class="modal fade" id="restoreModal-{{ $aset->id_barcode }}" tabindex="-1"
                                        role="dialog" aria-labelledby="restoreModal-{{ $aset->id_barcode }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="restoreModal-{{ $aset->id_barcode }}">
                                                        Konfirmasi
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Apa anda yakin ingin mengembalikan aset?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Tutup</span>
                                                    </button>
                                                    <form action="{{ route('restore_aset', $aset->id_barcode) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-primary ms-1"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Terima</span>
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- MODAL RESTORE --}}

                                    {{-- MODAL DELETE --}}
                                    <div class="modal fade" id="deleteAset-{{ $aset->id_barcode }}" tabindex="-1"
                                        role="dialog" aria-labelledby="deleteAset-{{ $aset->id_barcode }}Title"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteAset-{{ $aset->id_barcode }}Title">
                                                        Konfirmasi
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Apa anda yakin ingin menghapus permanen aset?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Tutup</span>
                                                    </button>
                                                    <form action="{{ route('hapus_aset_permanen', $aset->id_barcode) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger ms-1"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Terima</span>
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- MODAL DELETE --}}
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <form action="{{ route('cetak_aset_berdasarkan_kondisi', ['kondisi' => $kondisi]) }}" method="POST"
                target="_blank">
                @csrf
                <button type="submit" class="btn btn-primary ms-1">
                    <span class="d-none d-sm-block">Cetak Aset Gudang Kondisi {{ ucfirst($kondisi) }}</span>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('static/js/pages/simple-datatables.js') }}"></script>
@endsection
