@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Transaction</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>List Transaction</h4>
                        <div class="card-header-action">
                            <a href="{{ route('transaction.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="member-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Plot No</th>
                                        <th>Rent Date</th>
                                        <th>Return Date</th>
                                        <th>Period</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <th>{{ $transaction->name }}</th>
                                            <th>{{ $transaction->plate_no }}</th>
                                            <td>{{ $transaction->rent_date }}</td>
                                            <td>{{ $transaction->return_date }}</td>
                                            <td>{{ $transaction->period }} hari</td>
                                            <td>Rp. {{ number_format($transaction->price,0,',','.') }}</td>
                                            <td>
                                                <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <a href="{{ route('printTransaction', $transaction->id) }}" class="btn btn-success text-white btn-sm"> <i class="fas fa-print"></i></a>
                                                @hasanyrole('owner')
                                                    <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This Transaction?')">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                @endhasanyrole
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-additional')
    <script>
        $("#members-table").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [4] }
            ]
        });
    </script>
@endpush
