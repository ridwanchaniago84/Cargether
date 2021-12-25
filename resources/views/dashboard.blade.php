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
        </div>
    </section>
@endsection