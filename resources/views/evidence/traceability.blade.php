@extends('layouts.main')
@section('title', 'Evidence Logs')
@section('page')
<p><b>RASTREABILIDADE</b> <a href="{{route('evidence.index')}}"
        class="btn-floating right indigo darken-4 tooltipped" data-tooltip='Fechar Visualização' data-position="bottom">
        <i class="small material-icons">close</i>
    </a></p>
<hr />
<table>
    <thead>
        <tr>
            <th>Mensagem</th>
            <th>Tipo</th>
            <th>Usuario</th>
            <th>Data</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($traceabilities as $log)
        <tr>
            <td>{{ $log->message }}</td>
            <td>{{ $log->type }}</td>
            <td>{{ $log->user->name }}</td>
            <td>{{ $log->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
@push('scripts')
<script>
</script>
@endpush