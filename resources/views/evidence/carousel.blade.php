@extends('templates.layout')
@section('title', 'AGRUPADOR DE FOTOS')
@section('page')
    <a href="{{ route('evidence.index', ['search_evidence' => $evidence->id]) }}"
        class="btn-floating right indigo darken-4 tooltipped" data-tooltip='Fechar Visualização' data-position="bottom">
        <i class="small material-icons">close</i>
    </a>
    AGRUPADOR: <b>{{ $evidence->reference }}</b>
    <div class="carousel carousel-slider">
        <div class="carousel-item">
            <img height="95%" src=" {{ asset('storage/' . $evidenceFile->file) }}?{{ rand() }}">
            <p class="black-text center">{{$evidenceFile->description }}</p>
        </div>
        @foreach ($evidenceFiles as $f_evd)
            @if ($f_evd->id != $evidenceFile->id)
                <div class="carousel-item">
                    <img height="95%" width="100%" src=" {{ asset('storage/' . $f_evd->file) }}?{{ rand() }}">
                    <p class="black-text center">{{ $f_evd->description }}</p>
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
    </script>
@endpush
