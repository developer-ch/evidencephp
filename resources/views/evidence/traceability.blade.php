@extends('layouts.main')
@section('title', 'Evidence Logs')
@section('page')
<div class="title_box" id="subject">
    <div id="title"><span style="font-size: 18px;text-align: center"><b>RASTREABILIDADE</b></span></div>
    <a href="{{route('evidence.index')}}"
        class="btn-floating right indigo darken-4 tooltipped" data-tooltip='Fechar Visualização' data-position="bottom">
        <i class="small material-icons">close</i>
    </a>
    <div id="content" style="overflow:auto;height:85vh;overflow:auto;width:99.8%">
        <table class="responsive-table">
            <thead>
                <tr>
                    <th>Mensagem</th>
                    <th>Data</th>
                    <th>Usuario</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($traceabilities as $log)
                <tr>
                    <td>{{ $log->message }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>{{ $log->user->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@push('scripts')
<script>
</script>
@endpush