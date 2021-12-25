@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Data Transaksi</h1>
        </div>
        <form action="{{ route('transaction.update', ['id' => $transaction->id]) }}" method="POST">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                            <div class="form-group">
                                <label for="id_member" class="form-label label-font">Member</label>
                                <select class="form-control @error('id_member') is-invalid @enderror selectric" id="id_member"
                                    name="id_member">
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}" {{ $transaction->member_id == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_vehicle" class="form-label label-font">Plat No</label>
                                <select class="form-control @error('id_vehicle') is-invalid @enderror selectric" id="id_vehicle"
                                    name="id_vehicle">
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ $transaction->vehicle_id == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->plate_no }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="rent_date" class="form-label label-font">Rent Date</label>
                                <input type="date" name="rent_date" id="rent_date"
                                    class="form-control @error('rent_date') is-invalid @enderror" value="{{ $transaction->rent_date }}"
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
                                    class="form-control @error('return_date') is-invalid @enderror" value="{{ $transaction->return_date }}"
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
                    <input type="submit" value="Update" class="btn btn-success btn-text">
                </div>
            </div>
        </form>
    </section>
@endsection
