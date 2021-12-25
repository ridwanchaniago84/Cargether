@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Kendaraan</h1>
        </div>
        <form action="{{ route('vechicles.update', $vehicle->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label label-font">Plate No</label>
                                <input type="text" name="plate_no" id="plate_no"
                                    class="form-control @error('plate_no') is-invalid @enderror"
                                    value="{{ $vehicle->plate_no }}" placeholder="Plat No" required>
                                @error('plate_no')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('plate_no') }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name" class="form-label label-font">Brand</label>
                                <input type="text" name="brand" id="brand"
                                    class="form-control @error('brand') is-invalid @enderror"
                                    value="{{ $vehicle->brand }}" placeholder="Brand" required>
                                @error('brand')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('brand') }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name" class="form-label label-font">Brand Type</label>
                                <input type="text" name="brand_type" id="brand_type"
                                    class="form-control @error('brand_type') is-invalid @enderror"
                                    value="{{ $vehicle->brand_type }}" placeholder="Brand Type" required>
                                @error('brand_type')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('brand_type') }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_price" class="form-label label-font">Price</label>
                                <select class="form-control @error('id_price') is-invalid @enderror selectric" id="id_price"
                                    name="id_price">
                                    @foreach ($prices as $price)
                                        <option value="{{ $price->id }}" {{ $price->id == $vehicle->price_id ? 'selected' : '' }}>{{ $price->type }} - Rp.
                                            {{ number_format($price->price, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="is_active" class="form-label label-font">Status</label>
                                <select class="form-control @error('is_active') is-invalid @enderror selectric"
                                    id="is_active" name="is_active">
                                    <option value="1" {{ $vehicle->is_active == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $vehicle->is_active == 0 ? 'selected' : '' }}>Non Active</option>
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
