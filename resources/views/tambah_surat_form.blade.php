@extends('layout.dashboard_admin_layout')

@section('title_page')
    <h3>Form Tambah Surat Pengadaan</h3>
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('extensions/choices.js/public/assets/styles/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('extensions/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Surat Pengadaan</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('tambah_surat') }}" method="POST" class="form form-vertical"
                    onsubmit="return validateForm()">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="nomor_surat">No Surat</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="nomor_surat">
                                        <div class="form-control-icon">
                                            <i class="fas fa-solid fa-hashtag"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="tujuan_surat">Tujuan Surat</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="tujuan_surat" required>
                                        <div class="form-control-icon">
                                            <i class="fas fa-solid fa-building"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="nama_penanda_tangan">Penanda Tangan</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="nama_penanda_tangan" required>
                                        <div class="form-control-icon">
                                            <i class="fas fa-solid fa-signature"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Pengadaan Aset</label>
                                    <div id="aset-container">
                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="kode_barang[]"
                                                    placeholder="Kode Barang" required>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="rincian[]"
                                                    placeholder="Rincian" required>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="number" class="form-control" name="jumlah[]"
                                                    placeholder="Jumlah" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-2" onclick="addAsetField()">Tambah
                                        Aset</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="tanggal_surat">Tanggal Surat</label>
                                    <div class="position-relative">
                                        <input type="date" name="tanggal_surat" id="tanggal_surat"
                                            class="form-control mb-3 flatpickr-no-config" placeholder="Pilih Tanggal..."
                                            required>
                                        <div class="form-control-icon">
                                            <i class="fas fa-solid fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-12 d-flex justify-content-center mt-5">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Tambah Surat</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function validateForm() {
            const tanggal_surat = document.getElementById("tanggal_surat").value;

            if (tanggal_surat === "") {
                alert("Tanggal surat harus diisi");
                return false;
            }

            return true;
        }

        function addAsetField() {
            const container = document.getElementById('aset-container');
            const div = document.createElement('div');
            div.classList.add('row', 'mb-2');

            div.innerHTML = `
                <div class="col-md-4">
                    <input type="text" class="form-control" name="kode_barang[]" placeholder="Kode Barang" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="rincian[]" placeholder="Rincian" required>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah" required>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger" onclick="removeAsetField(this)">Hapus</button>
                </div>
            `;

            container.appendChild(div);
        }

        function removeAsetField(button) {
            const div = button.parentNode.parentNode;
            div.remove();
        }
    </script>

    <script src="{{ asset('extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('static/js/pages/date-picker.js') }}"></script>
    <script src="{{ asset('extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('static/js/pages/form-element-select.js') }}"></script>
@endsection
