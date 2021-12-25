@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Member</h1>
        </div>
        <form action="{{ route('members.update', ['id' => $member->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label label-font">Nama Lengkap</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ $member->name }}"
                                    placeholder="Nama Lengkap">
                                @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label label-font">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ $member->email }}"
                                    placeholder="Email" required>
                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label label-font">Phone</label>
                                <input type="text" name="phone" id="phone"
                                    class="form-control @error('phone') is-invalid @enderror" value="{{ $member->phone_no  }}"
                                    placeholder="Phone" required>
                                @error('phone')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="age" class="form-label label-font">Age</label>
                                <input type="number" name="age" id="age"
                                    class="form-control @error('age') is-invalid @enderror" value="{{ $member->age }}"
                                    placeholder="age" required>
                                @error('age')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                    name="address" rows="3" required>{{ $member->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender" class="form-label label-font">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror selectric" id="gender"
                                    name="gender">
                                    <option value="L" {{ $member->gender === 'L' ? 'selected' : '' }}>Male</option>
                                    <option value="P" {{ $member->gender === 'P' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_option" class="form-label label-font">Gender</label>
                                <select class="form-control @error('status_option') is-invalid @enderror selectric" id="status_option"
                                    name="status_option">
                                    <option value="1" {{ $member->is_active === 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $member->is_active === 0 ? 'selected' : '' }}>Non Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ktp">KTP</label>
                                <input type="file" class="form-control-file" name="ktp" id="ktp" accept=".jpg, .jpeg, .png">
                                @error('ktp')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ktp') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sim">SIM</label>
                                <input type="file" class="form-control-file" name="sim" id="sim" accept=".jpg, .jpeg, .png">
                                @error('sim')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sim') }}</strong>
                                    </div>
                                @enderror
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
