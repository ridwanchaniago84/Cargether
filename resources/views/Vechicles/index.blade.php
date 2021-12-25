@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Vehicle</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>List Vehicle</h4>
                        <div class="card-header-action">
                            <a href="{{ route('vechicles.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="member-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Plate</th>
                                        <th>Price</th>
                                        <th>Brand</th>
                                        <th>Brand Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $vehicle->plate_no }}</td>
                                            <td>Rp. {{ number_format($vehicle->price,0,',','.') }}</td>
                                            <td>{{ $vehicle->brand }}</td>
                                            <td>{{ $vehicle->brand_type }}</td>
                                            <td><span class="badge {{ $vehicle->is_active == 1 ? "badge-success" : "badge-danger"}}">{{ $vehicle->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                                            <td>
                                                <a href="{{ route('vechicles.edit', $vehicle->id) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('vechicles.destroy', $vehicle->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This Transaction?')">
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
