@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Role Administrator</h1>
        </div>
        <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="role" class="form-label label-font">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror selectric" id="role" name="role">
                                    @role('owner')
                                        <option value="owner" {{ $user->role_name == 'Owner' ? 'selected' : '' }}>Pemilik</option>
                                        <option value="treasurer" {{ $user->role_name == 'Treasurer' ? 'selected' : '' }}>Bendahara</option>
                                    @endrole
                                    <option value="staff" {{ $user->role_name == 'Staff' ? 'selected' : '' }}>Staff</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <input type="submit" value="Update" class="btn btn-success btn-text">
                </div>
            </div>
        </form>
    </section>
@endsection