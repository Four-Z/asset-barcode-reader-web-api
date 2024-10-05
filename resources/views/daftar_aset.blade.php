@extends('layout.dashboard_admin_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('compiled/css/table-datatable.css') }}">
@endsection

@section('title_page')
    <h3>Daftar Aset</h3>
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
                        <th>Tanggal Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asets as $aset)
                        <tr>
                            <td>{{ $aset->id_barcode }}</td>
                            <td>{{ $aset->nama_aset }}</td>
                            <td>{{ $aset->kondisiAset->kondisi }}</td>
                            <td>{{ $aset->created_at->format('d/m/Y') }}</td>
                            <td>
                                <center>
                                    <form action={{ route('detail_aset_page', $aset->id_barcode) }} method="GET"
                                        class="d-inline-block">
                                        @csrf
                                        <button class="btn btn-info btn-icon-split">
                                            <span class="icon text-black-50">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <span class="text">Lihat Detail</span>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-warning btn-icon-split" data-bs-toggle="modal"
                                        data-bs-target="#modal-{{ $aset->id_barcode }}">
                                        <span class="icon text-black-50">
                                            <i class="fas fa-solid fa-truck-moving"></i>
                                        </span>
                                        <span class="text">&nbsp Gudang</span>
                                    </button>
                                    <form action={{ route('generate_barcode', $aset->id_barcode) }} method="GET"
                                        class="d-inline-block">
                                        @csrf
                                        <button class="btn btn-info btn-icon-split">
                                            <span class="icon text-black-50">
                                                <i class="fas fa-regular fa-barcode"></i>
                                            </span>
                                            <span class="text">Generate Barcode</span>
                                        </button>
                                    </form>

                                    {{-- MODAL --}}
                                    <div class="modal fade" id="modal-{{ $aset->id_barcode }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Apa anda yakin ingin memindahkan aset ke gudang?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Tutup</span>
                                                    </button>
                                                    <form action="{{ route('hapus_aset', $aset->id_barcode) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')

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
                                    {{-- MODAL --}}
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-body">
            <form action="{{ route('cetak_semua_aset') }}" method="GET" target="_blank">
                @csrf
                <button type="submit" class="btn btn-primary ms-1">
                    <span class="d-none d-sm-block">Cetak Semua Aset</span>
                </button>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('static/js/pages/simple-datatables.js') }}"></script>
@endsection
