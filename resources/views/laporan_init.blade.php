@extends('layout.dashboard_admin_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('extensions/flatpickr/flatpickr.min.css') }}">
@endsection

@section('title_page')
    <h3>Laporan</h3>
    <div class="card-body">
        <form action="{{ route('cetak_laporan') }}" method="GET" target="_blank" onsubmit="return validateForm()">
            @csrf

            <p>Tanggal Mulai:</p>
            <input type="date" name="start_date" id="start_date" class="form-control mb-3 flatpickr-no-config"
                placeholder="Select date.." required>

            <p>Tanggal Akhir:</p>
            <input type="date" name="end_date" id="end_date" class="form-control mb-3 flatpickr-no-config"
                placeholder="Select date.." required>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="aset_status" id="flexRadioDefault1" value="masuk"
                    checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    Aset Masuk
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="aset_status" id="flexRadioDefault2" value="keluar">
                <label class="form-check-label" for="flexRadioDefault2">
                    Aset Keluar
                </label>
            </div>

            <button type="submit" class="btn btn-primary ms-1 mt-4">
                <span class="d-none d-sm-block">Cetak</span>
            </button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        function validateForm() {
            var startDate = document.getElementById("start_date").value;
            var endDate = document.getElementById("end_date").value;

            if (startDate === "" || endDate === "") {
                alert("Tanggal mulai dan tanggal akhir harus diisi");
                return false;
            }
        }
    </script>
    <script src="assets/extensions/flatpickr/flatpickr.min.js"></script>
    <script src="assets/static/js/pages/date-picker.js"></script>

    <script src="{{ asset('extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('static/js/pages/date-picker.js') }}"></script>
@endsection
