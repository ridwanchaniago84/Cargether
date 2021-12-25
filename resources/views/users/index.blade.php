@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Administrator</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>List Administrator</h4>
                        <div class="card-header-action">
                            @hasrole('owner')
                                <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            @endhasrole
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="userslist">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role_name }}</td>
                                            <td>
                                                @if (Auth::user()->id != $user->id)
                                                    @hasrole('owner')
                                                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This User?')">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    @endhasrole
                                                @else
                                                    {{__('-')}}
                                                @endif
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
        $("#userslist").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [3,5] }
            ]
        });
    </script>
@endpush