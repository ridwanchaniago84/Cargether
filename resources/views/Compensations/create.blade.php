@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Compensation Baru</h1>
        </div>
        <form action="{{ route('compensations.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                            <div class="form-group">
                                <label for="transaction_id" class="form-label label-font">Transaction</label>
                                <select class="form-control @error('transaction_id') is-invalid @enderror selectric" id="transaction_id"
                                    name="transaction_id">
                                    @foreach($transactions as $transaction)
                                        <option value="{{ $transaction->id }}">{{ $transaction->name }} - {{ $transaction->plate_no }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="compen_category_id" class="form-label label-font">Compensation Category</label>
                                <select class="form-control @error('compen_category_id') is-invalid @enderror selectric" id="compen_category_id"
                                    name="compen_category_id">
                                    @foreach($compenCategories as $compenCategory)
                                        <option value="{{ $compenCategory->id }}">{{ $compenCategory->complaint }}</option>
                                    @endforeach
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
