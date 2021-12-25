@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Harga Baru</h1>
        </div>
        <form action="{{ route('spendings.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                            <div class="form-group">
                                <label for="name" class="form-label label-font">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('type') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="Name" required>
                                @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
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
                            <div class="form-group">
                                <label for="date" class="form-label label-font">Date</label>
                                <input type="date" name="date" id="date"
                                    class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}"
                                    placeholder="Date" required>
                                @error('date')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
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
