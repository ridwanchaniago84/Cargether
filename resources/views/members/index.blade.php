@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Member</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>List Member</h4>
                        <div class="card-header-action">
                            <a href="{{ route('members.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="member-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($commodities as $commodity)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $members->category->name}}</td>
                                            <td>{{ $members->name }}</td>
                                            <td><span class="badge {{ $members->is_active == 1 ? "badge-success" : "badge-danger"}}">{{ $members->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                                            <td>
                                                <a href="{{ route('members.edit', ['id' => $members->id]) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('members.destroy', ['id' => $members->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This member?')">
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
