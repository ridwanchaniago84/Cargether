@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Pengeluaran</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>List Spending</h4>
                        <div class="card-header-action">
                            <a href="{{ route('print') }}" class="btn btn-success" data-toggle="modal"
                                data-target="#print"><i class="fas fa-print"></i></a>
                            <a href="{{ route('spendings.create') }}" class="btn btn-primary"><i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="member-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($spendings as $spending)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $spending->name }}</td>
                                            <td>Rp. {{ number_format($spending->price, 0, ',', '.') }}</td>
                                            <td>{{ $spending->date }}</td>
                                            <td>
                                                @hasanyrole('owner')
                                                <a href="{{ route('spendings.edit', $spending->id) }}"
                                                    class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                {{-- <form action="{{ route('spendings.destroy', $spending->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This Spending?')">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                    </form> --}}
                                                @endhasanyrole
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="print" tabindex="-1" role="dialog" aria-labelledby="print"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Print</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('print') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="from" class="col-form-label">From:</label>
                            <input type="date" class="form-control @error('from') s-invalid @enderror" id="from" name="from"
                                value="{{ old('from') }}" required>
                            @error('from')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('from') }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="to" class="col-form-label">To:</label>
                            <input type="date" class="form-control @error('to') s-invalid @enderror" id="to" name="to"
                                value="{{ old('to') }}" required>
                            @error('to')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('to') }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js-additional')
    <script>
        $("#members-table").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [4]
            }]
        });

    </script>
@endpush
