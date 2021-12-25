@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Administrator Baru</h1>
        </div>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label label-font">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Lengkap" required>
                                @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label label-font">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required>
                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role" class="form-label label-font">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror selectric" id="role" name="role">
                                    <option value="staff">Staff</option>
                                    @role('webmaster')
                                        <option value="owner">Owner</option>
                                        <option value="treasurer">Treasurer</option>
                                    @endrole
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <input type="submit" value="Tambah" class="btn btn-success btn-text-size">
                    <input type="reset" value="Reset" class="btn btn-danger btn-text-size">
                </div>
            </div>
        </form>
    </section>
@endsection