@extends('layouts.main')
@section('title', 'AGRUPADOR DE FOTOS')
@section('page')
<a href="#" id="btn-back"
    class="btn-floating right indigo darken-4 tooltipped" data-tooltip='Fechar Visualização' data-position="bottom">
    <i class="small material-icons">close</i>
</a>
AGRUPADOR: <b>{{ $evidence->reference }}</b>
<div class="carousel carousel-slider">
    <div class="carousel-item">
        <form id="frmDescriptionFile"
            action="{{ route('file.evidence.description', $evidenceFile->id) }}" method="POST"
            autocomplete="off">
            @csrf
            <label for="text-legenda">Legenda:</label>
            <input id="text-legenda" type="text" name="description" style="padding-left: 5px; width: 80%"  placeholder="Informe a legenda" maxlength="32" value="{{ $evidenceFile->description}}" oninput="postDescriptionFile(this.form)">
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
                    <label for="text-legenda">Legenda:</label>
                    <input id="text-legenda" type="text" name="description" style="padding-left: 5px; width: 50%"  placeholder="Informe a legenda" maxlength="32" value="{{ $evidenceFile->description}}" oninput="postDescriptionFile(this.form)">
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
</script>
@endpush