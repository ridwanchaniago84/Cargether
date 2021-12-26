<html>

<head>
    <style>
        @page {
            margin: 15px;
        }
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            font-size: 14px;
        }

        .wrapper {
            margin: 15px;
            border: 3px solid #d3d3d3;
            padding: 15px;
        }

        .bordered-table {
            margin: 15px 0;
            width: 100%;
            border-collapse: collapse;
        }

        .bordered-table th {
            background-color: black;
            color: white;
            text-align: center;
        }

        .bordered-table th,
        .bordered-table td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <h1 style="text-align: center;">Invoice</h1>

        <table style="width: 100%;">
            <tr>
                <td style="width: 33.33%;vertical-align: top;">
                    <table>
                        <tr>
                            <td><b>CARGETHER</b></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                        </tr>
                        <tr>
                            <td>Kontak</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 33.33%;">
                </td>
                <td style="width: 33.33%; vertical-align: top;">
                    <table>
                        <tr>
                            <td style="font-weight: bold;">No.</td>
                            <td>{{ $transaction->id }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Tanggal</td>
                            <td>{{ date_format($transaction->created_at,"d/m/Y") }}</td>
                        </tr>
                        {{-- <tr>
                            <td style="font-weight: bold;">PO. No</td>
                            <td>Nomor PO</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Quo. No</td>
                            <td>Nomor Quo</td>
                        </tr> --}}
                    </table>
                </td>
            </tr>
        </table>

        <table style="margin-top: 15px;">
            <tr>
                <td style="font-weight: bold;">Ditujukan kepada:</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">{{ $transaction->name }}</td>
            </tr>
            <tr>
                <td>{{ $transaction->address }}</td>
            </tr>
        </table>

        <table class="bordered-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Lama Sewa</th>
                    <th>Harga 1 Hari</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">{{ $no }}</td>
                    <td>{{ $transaction->brand }} {{ $transaction->brand_type }}({{ $transaction->plate_no }})
                    </td>
                    <td>{{ $transaction->period }} Hari</td>
                    <td>Rp. {{ number_format($transaction->pricePerDay, 0, ',', '.') }}</td>
                    <td>RP. {{ number_format($transaction->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="border: none;" colspan="3">

                    </td>
                    <td>Total</td>
                    <td style="font-weight: bold;">Rp. {{ number_format($transaction->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="border: none;" colspan="3">

                    </td>
                    <td style="border: none; text-align: center;" colspan="2">
                        <div style="font-weight: bold; margin-top: 100px;">CARGETHER</div>
                        <div style="margin-top: 100px;">Nama Penanggung Jawab</div>
                        <div>Jabatan</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
