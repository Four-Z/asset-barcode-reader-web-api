<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/surat_pengadaan_barang.css') }}">
    <title>Surat Pengadaan Barang</title>

    <script>
        window.print();
    </script>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('asset/bpjs_logo_surat.png') }}" alt="logo bpjs">
            <hr>
        </div>

        <div class="body">
            <p>Nomor: {{ $surat_pengadaan->nomor_surat }}</p>
            <p>Hal: Permohonan Pengadaan Barang</p>
            <br>
            <p>Yang Terhormat,</p>
            <p>{{ $surat_pengadaan->tujuan_surat }}</p>
            <p>di Tempat</p>
            <br>
            <p>Dengan hormat,</p>
            <p>
                Bersamaan dengan surat ini kami ingin mengajukan permintaan barang untuk perusahaan, berikut ini daftar
                barang yang kami ingin adakan:
            </p>

            <table>
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Rincian</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aset_pengadaan as $aset)
                        <tr>
                            <td>{{ $aset->kode_barang }}</td>
                            <td>{{ $aset->rincian }}</td>
                            <td>{{ $aset->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p>
                Mohon untuk memproses permintaan ini sesuai dengan kebijakan dan prosedur yang berlaku. Harap diketahui
                bahwa barang-barang tersebut sangat diperlukan untuk kelancaran operasional perusahaan.
            </p>
            <p>
                Demikian surat pengadaan barang ini kami sampaikan, atas perhatiannya kami ucapkan terima kasih
            </p>
            <br>
            <br>
            <p>Palembang, {{ $surat_pengadaan->tanggal_surat->format('d-m-Y') }}</p>
            <p>Hormat saya,</p>
            <br>
            <br>
            <p>{{ $surat_pengadaan->nama_penanda_tangan }}</p>
        </div>
    </div>



</body>

</html>
