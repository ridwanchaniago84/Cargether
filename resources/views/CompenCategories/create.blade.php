@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Complaint Category Baru</h1>
        </div>
        <form action="{{ route('compencategories.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="complaint" class="form-label label-font">Complaint</label>
                                <input type="text" name="complaint" id="complaint"
                                    class="form-control @error('complaint') is-invalid @enderror" value="{{ old('complaint') }}"
                                    placeholder="Complaint" required>
                                @error('complaint')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('complaint') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price" class="form-label label-font">Price</label>
                                <input type="number" name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
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
                    <input type="submit" value="Tambah" class="btn btn-success btn-text-size">
                    <input type="reset" value="Reset" class="btn btn-danger btn-text-size">
                </div>
            </div>
        </form>
    </section>
@endsection
