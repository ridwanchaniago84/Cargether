@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Transaksi Baru</h1>
        </div>
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                            <div class="form-group">
                                <label for="id_member" class="form-label label-font">Member</label>
                                <select class="form-control @error('id_member') is-invalid @enderror selectric" id="id_member"
                                    name="id_member">
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_vehicle" class="form-label label-font">Plat No</label>
                                <select class="form-control @error('id_vehicle') is-invalid @enderror selectric" id="id_vehicle"
                                    name="id_vehicle">
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->plate_no }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="rent_date" class="form-label label-font">Rent Date</label>
                                <input type="date" name="rent_date" id="rent_date"
                                    class="form-control @error('rent_date') is-invalid @enderror" value="{{ old('rent_date') }}"
                                    placeholder="Rent Date" required>
                                @error('rent_date')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rent_date') }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="return_date" class="form-label label-font">Return Date</label>
                                <input type="date" name="return_date" id="return_date"
                                    class="form-control @error('return_date') is-invalid @enderror" value="{{ old('return_date') }}"
                                    placeholder="Return Date" required>
                                @error('return_date')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('return_date') }}</strong>
                                    </div>
                                @enderror
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
