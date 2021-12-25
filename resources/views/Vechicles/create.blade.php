@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Kendaraan Baru</h1>
        </div>
        <form action="{{ route('vechicles.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label label-font">Plate No</label>
                                <input type="text" name="plate_no" id="plate_no"
                                    class="form-control @error('plate_no') is-invalid @enderror" value="{{ old('plate_no') }}"
                                    placeholder="Plat No" required>
                                @error('plate_no')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('plate_no') }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name" class="form-label label-font">Brand</label>
                                <input type="text" name="brand" id="brand"
                                    class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}"
                                    placeholder="Brand" required>
                                @error('brand')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('brand') }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name" class="form-label label-font">Brand Type</label>
                                <input type="text" name="brand_type" id="brand_type"
                                    class="form-control @error('brand_type') is-invalid @enderror" value="{{ old('brand_type') }}"
                                    placeholder="Brand Type" required>
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
                                    @foreach($prices as $price)
                                        <option value="{{ $price->id }}">{{ $price->type }} - Rp. {{ number_format($price->price,0,',','.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="is_active" class="form-label label-font">Status</label>
                                <select class="form-control @error('is_active') is-invalid @enderror selectric" id="is_active"
                                    name="is_active">
                                    <option value="1">Active</option>
                                    <option value="0">Non Active</option>
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
