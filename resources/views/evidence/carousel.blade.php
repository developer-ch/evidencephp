@extends('layouts.main')
@section('title', 'AGRUPADOR DE FOTOS')
@section('page')
<a href="#" id="btn-back"
    class="btn-floating right indigo darken-4 tooltipped" data-tooltip='Fechar Visualização' data-position="bottom">
    <i class="small material-icons">close</i>
</a>
AGRUPADOR: <b>{{ $evidence->reference }}</b>
<div class="carousel carousel-slider" style="height: 92vh" oncontextmenu="return false;">
    <div class="carousel-item">
        <form id="frmDescriptionFile"
            action="{{ route('file.evidence.description', $evidenceFile->id) }}" method="POST"
            autocomplete="off">
            @csrf
            <div class="row">
                <div class="input-field col s12 m6">
                    <label for="text-legenda">Legenda:</label>
                    <input id="text-legenda" type="text" name="description" maxlength="32" data-length="32" value="{{ $evidenceFile->description}}" oninput="postDescriptionFile(this.form)">
                </div>
            </div>
        </form>
        <img height="86%" width="100%" src=" {{ asset('storage/' . $evidenceFile->file) }}?{{ rand() }}">
    </div>
    @foreach ($evidenceFiles as $f_evd)
    @if ($f_evd->id != $evidenceFile->id)
    <div class="carousel-item">
        <form id="frmDescriptionFile"
            action="{{ route('file.evidence.description', $f_evd->id) }}" method="POST"
            autocomplete="off">
            @csrf
            <div class="row">
                <div class="input-field col s12 m6">
                    <label for="text-legenda">Legenda:</label>
                    <input id="text-legenda" type="text" name="description" data-length="32" maxlength="32" value="{{ $f_evd->description}}" oninput="postDescriptionFile(this.form)">
                </div>
            </div>
        </form>
        <img height="86%" width="100%" src=" {{ asset('storage/' . $f_evd->file) }}?{{ rand() }}">
    </div>
    @endif
    @endforeach
</div>
@endsection
@push('scripts')
<script>
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
    });
    $(".dropdown-trigger").dropdown({
        constrainWidth: false
    });
    const postDescriptionFile = (e) => {
        $.post(e.action, $(e).serialize());
    }
    $('form#frmDescriptionFile').submit((e) => {
        e.preventDefault();
        postDescriptionFile(e.currentTarget)
    });

    $('a#btn-back').click((e) => {
        e.preventDefault()
        history.back()
    })

    $('input#text-legenda').characterCounter();
</script>
@endpush