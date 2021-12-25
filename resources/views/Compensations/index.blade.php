@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Compensation</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>List Compensation</h4>
                        <div class="card-header-action">
                            <a href="{{ route('compensations.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                                        <th>Complaint</th>
                                        <th>Compensation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compensations as $compensation)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <th>{{ $compensation->name }}</th>
                                            <th>{{ $compensation->plate_no }}</th>
                                            <td>{{ $compensation->complaint }}</td>
                                            <td>Rp. {{ number_format($compensation->price,0,',','.') }}</td>
                                            <td>
                                                <a href="{{ route('compensations.edit', $compensation->id) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('compensations.destroy', $compensation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This Compensations?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                </form>
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
