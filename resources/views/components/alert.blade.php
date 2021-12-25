<div class="row">
    @if (Session::has('success'))
        <div class="alert alert-success col-12" id="alert">
            {{ Session::get('success') }}
        </div>
    @elseif (Session::has('warning'))
        <div class="alert alert-warning col-12" id="alert">
            {{ Session::get('warning') }}
        </div>
    @elseif (Session::has('danger'))
        <div class="alert alert-danger col-12" id="alert">
            {{ Session::get('danger') }}
        </div>
    @endif
</div>

@push('js-additional')
    <script>
        $("#alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#alert").slideUp(500);
        });
    </script>
@endpush