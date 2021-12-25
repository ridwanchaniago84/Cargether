@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-user-lock fa-2x"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Member</h4>
                        </div>
                        <div class="card-body">
                            {{ $members }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info text-white">
                        <i class="fas fa-tag fa-2x"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            {{ $vehicles }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning text-white">
                        <i class="fas fa-seedling fa-2x"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi</h4>
                        </div>
                        <div class="card-body">
                            {{ $transactions }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger text-white">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pengeluaran</h4>
                        </div>
                        <div class="card-body">
                            {{ $spendings }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-statistic-1">
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="chartPenjualan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
        
        const chartPenjualan = (sellingData, date, totalHargaPenjualan) => {
            var ctx = document.getElementById("chartPenjualan");
            let title = [];

            sellingData.forEach(() => {
                title.push('');
            });

            elementChartPenjualan = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: title,
                    datasets: [{
                        label: "Penjualan",
                        backgroundColor: "#4e73df",
                        hoverBackgroundColor: "#2e59d9",
                        borderColor: "#4e73df",
                        data: sellingData,
                        maxBarThickness: 25
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            },
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                maxTicksLimit: 5,
                                padding: 10,
                                callback: function(value, index, values) {
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            title: function() {},
                            beforeLabel: function(tooltipItem, chart) {
                                return `Jumlah Produk Terjual: ${chart.datasets[0].data[tooltipItem.index]}`;
                            },
                            label: function(tooltipItem) {
                                return `Tanggal: ${date[tooltipItem.index]}`;
                            },
                            afterLabel: function(tooltipItem) {
                                return `Total Penjualan: Rp. ${number_format(totalHargaPenjualan[tooltipItem.index])}`;
                            }
                        }
                    },
                }
            });

            return elementChartPenjualan;
        }

        window.onload = function() {
            $.ajax({
                url: '{{ route('barchart') }}',
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    chartPenjualan(response.totalPenjualan, response.date, response.totalHargaPenjualan);
                }
            });
        };

    </script>
@endsection
