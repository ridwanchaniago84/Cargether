<html>

<head>
    <style>
        @page {
            margin: 15;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td, {
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
        </tbody>
    </table>
</body>

</html>
