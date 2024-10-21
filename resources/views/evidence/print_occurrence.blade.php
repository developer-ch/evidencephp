@extends('layouts.main')
@section('title', 'AGRUPADOR ARQUIVOS COM LEGENDA')
@section('page')
AGRUPADOR: <b>{{ $evidence->reference }}</b>
<div class="row">
    @foreach ($evidenceFiles as $f_evd)
    <div class="col s4">
        <div class="card">
            <div class="card-image">
                <img height="200px" src=" {{ asset('storage/' . $f_evd->file) }}">
            </div>
            <div class="card-content">
                <p>{{ $f_evd->description}}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
@push('scripts')
<script>
    (() => {
        window.print();
        window.addEventListener("afterprint", () => history.back())
    })()
</script>
@endpush