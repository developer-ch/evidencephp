@extends('layouts.main')
@section('title', 'Evidence Logs')
@section('page')
<div class="title_box" id="subject">
    <div id="title"><span style="font-size: 18px;text-align: center"><b>RASTREABILIDADE</b></span></div>
    <a href="{{route('evidence.index')}}"
        class="btn-floating right indigo darken-4 tooltipped" data-tooltip='Fechar Visualização' data-position="bottom">
        <i class="small material-icons">close</i>
    </a>
    <p>Encontrei {{ $traceabilities->count() }} registros</p>
    <div id="content" style="overflow:auto;height:85vh;overflow:auto;width:99.8%">
        <table class="hide-on-med-and-down">
            <thead>
                <tr>
                    <th>Mensagem</th>
                    <th>Momento</th>
                    <th>Autor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($traceabilities as $log)
                <tr>
                    <td>{{ $log->message }}</td>
                    <td>{{ date('d/m/Y H:i', strtotime($log->created_at)) }}</td>
                    <td>{{ $log->user->name }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <ul class="collection hide-on-large-only">
            @foreach ($traceabilities as $log)
            <li class="collection-item">
                <span class="title"><b>Mensagem:</b> {{ $log->message }}</span>
                <p>
                    <b>Momento:</b> {{ date('d/m/Y H:i', strtotime($log->created_at)) }} <br>
                    <b>Autor:</b> {{ $log->user->name }}
                </p>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
@push('scripts')
<script>
</script>
@endpush