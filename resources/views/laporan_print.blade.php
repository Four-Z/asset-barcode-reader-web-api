<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('compiled/css/app-dark.css') }}">

    <title>Laporan Aset {{ $judul }}</title>

    <script>
        window.print();
    </script>
</head>

<body>
    <center>
        <table>
            <tr>
                <td>
                    <img src="{{ asset('asset/bpjs_logo.png') }}" width="200px" alt="logo"
                        style="margin-right: 20px">
                </td>
                <td colspan="4">
                    <h2 style="text-align: center;">LAPORAN {{ $judul }}</h2>
                    <h2 style="text-align: center;"> BPJS KETENAGAKERJAAN </h2>
                    @isset($start_date)
                        <h4 style="text-align: center;">Periode :{{ $start_date }} -
                            {{ $end_date }}</h4>
                    @endisset
                </td>
            </tr>
        </table>
        <hr style="border-width: 2px">
        <br>
    </center>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>ID Barcode</th>
                                            <th>Nama Aset</th>
                                            <th>Merk Aset</th>
                                            <th>Tahun Beli</th>
                                            <th>Harga Beli</th>
                                            <th>Kondisi Aset</th>
                                            <th>Lokasi Aset</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($asets as $aset)
                                            <tr>
                                                <td class="text-bold-500">{{ $aset->id_barcode }}</td>
                                                <td>{{ $aset->nama_aset }}</td>
                                                <td>{{ $aset->merk_aset }}</td>
                                                <td>{{ $aset->tahun_beli }}</td>
                                                <td>{{ number_format($aset->harga_beli) }}</td>
                                                <td>{{ $aset->kondisiAset->kondisi }}</td>
                                                <td>{{ $aset->lokasi_aset }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->

    <section class="section">
        <center>
            <h3>Informasi Aset</h3>
        </center>
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    @if (isset($jumlah_aset_kondisi))
                                        <th>Total Aset</th>
                                        <td>{{ $jumlah_aset_kondisi }}</td>
                                        <td>Rp. {{ number_format($total_harga_aset_kondisi) }}</td>
                                    @else
                                        <tr>
                                            <th>Total Aset Baik</th>
                                            <td>{{ $jumlah_aset_kondisi_baik }}</td>
                                            <td>Rp. {{ number_format($total_harga_aset_kondisi_baik) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Aset Rusak</th>
                                            <td>{{ $jumlah_aset_kondisi_rusak }}</td>
                                            <td>Rp. {{ number_format($total_harga_aset_kondisi_rusak) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Aset Usang</th>
                                            <td>{{ $jumlah_aset_kondisi_usang }}</td>
                                            <td>Rp. {{ number_format($total_harga_aset_kondisi_usang) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Aset Ilang</th>
                                            <td>{{ $jumlah_aset_kondisi_hilang }}</td>
                                            <td>Rp. {{ number_format($total_harga_aset_kondisi_hilang) }}</td>
                                        </tr>
                                        <tr style="font-weight: bold">
                                            <td >Total</td>
                                            <td>{{ $jumlah_aset_kondisi_baik + $jumlah_aset_kondisi_rusak + $jumlah_aset_kondisi_usang + $jumlah_aset_kondisi_hilang }}
                                            </td>
                                            <td>Rp. {{ number_format($total_harga_aset_kondisi_baik + $total_harga_aset_kondisi_rusak + $total_harga_aset_kondisi_usang + $total_harga_aset_kondisi_hilang) }}
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-end">
                <p>2024 &copy; Pratiwi Amalia - D4 TIMD - BPJS Ketenagakerjaan</p>
            </div>

        </div>
    </footer>

</body>

</html>
