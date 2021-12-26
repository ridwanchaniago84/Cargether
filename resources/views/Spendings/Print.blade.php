<html>

<head>
    <style>
        @page {
            margin: 15;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td, {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }

    </style>
</head>

<body>
    <h1 style="text-align: center">Data Pengeluaran</h1>
    <table style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($spendings as $spending)
                <tr>
                    <td style="text-align: center;">{{ $no++ }}</td>
                    <td>{{ $spending->name }}</td>
                    <td>Rp. {{ number_format($spending->price, 0, ',', '.') }}</td>
                    <td>{{ $spending->date }}</td>
                </tr>
            @endforeach
            <tr style="border: none;">
                <td style="border: none;"></td>
                <td><b>Total:</b></td>
                <td><b>Rp. {{ number_format($total, 0, ',', '.') }}</b></td>
                <td style="border: none;"></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
