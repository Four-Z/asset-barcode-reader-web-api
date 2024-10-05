@extends('layout.dashboard_admin_layout')

@section('title_page')
    <h3>Detail Aset</h3>
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('extensions/choices.js/public/assets/styles/choices.css') }}">
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Aset</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('edit_aset', $aset->id_barcode) }}" method="POST" class="form form-vertical">
                    @csrf
                    @method('put')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="id_barcode">ID Barcode</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" value="{{ $aset->id_barcode }}"
                                            name="id_barcode" readonly>
                                        <div class="form-control-icon">
                                            <i class="fas fa-regular fa-barcode"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">

                                <div class="form-group has-icon-left">
                                    <label for="nama_aset">Nama Aset</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" value="{{ $aset->nama_aset }}"
                                            name="nama_aset" required>
                                        <div class="form-control-icon">
                                            <i class="fas fa-solid fa-tag"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="merk_aset">Merk Aset</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" value="{{ $aset->merk_aset }}"
                                            name="merk_aset" required>
                                        <div class="form-control-icon">
                                            <i class="fas fa-solid fa-tags"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="tahun_beli">Tahun Beli</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" value="{{ $aset->tahun_beli }}"
                                            name="tahun_beli" required>
                                        <div class="form-control-icon">
                                            <i class="fas fa-solid fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="harga_beli">Harga Beli</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" value="{{ $aset->harga_beli }}"
                                            name="harga_beli" required>
                                        <div class="form-control-icon">
                                            <i class="fas fa-solid fa-money-bill-wave"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="kondisi_aset">Kondisi Aset</label>
                                <div class="form-group">
                                    <select class="choices form-select" id="kondisi_aset" name="kondisi_aset">
                                        @php
                                            $options = [
                                                1 => 'Baik',
                                                2 => 'Rusak',
                                                3 => 'Usang',
                                                4 => 'Hilang',
                                            ];
                                        @endphp

                                        @foreach ($options as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ $value == $aset->kondisi_aset ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="lokasi_aset">Lokasi Aset</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" value="{{ $aset->lokasi_aset }}"
                                            name="lokasi_aset" required>
                                        <div class="form-control-icon">
                                            <i class="fas fa-solid fa-map"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="keterangan">Keterangan</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" value="{{ $aset->keterangan }}"
                                            name="keterangan">
                                        <div class="form-control-icon">
                                            <i class="fas fa-solid fa-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center mt-5">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Edit Aset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('static/js/pages/form-element-select.js') }}"></script>
@endsection
