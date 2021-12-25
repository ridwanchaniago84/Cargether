@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Harga</h1>
        </div>
        <form action="{{ route('prices.update', $price->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="type" class="form-label label-font">Type</label>
                                <input type="text" name="type" id="type"
                                    class="form-control @error('type') is-invalid @enderror" value="{{ $price->type }}"
                                    placeholder="Type" required>
                                @error('type')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price" class="form-label label-font">Price</label>
                                <input type="number" name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror" value="{{ $price->price }}"
                                    placeholder="Price" required>
                                @error('price')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
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
