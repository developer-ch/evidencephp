@extends('layouts.main')
@section('title', 'Evidence Logs')
@section('page')
<div>
    <div class="navbar-fixed ">
        <nav>
            <div class="nav-wrapper indigo darken-4">
                <form id="frm_search_traceability">
                    <div class="input-field">
                        <input id="search_traceability" type="search" placeholder="Procurar..." autofocus="autofocus" required>
                        <label class="label-icon" for="search"><a href="{{route('evidence.index')}}" class="small tooltipped" data-tooltip='Voltar' data-position="bottom"><i class="material-icons">arrow_back</i></a></label>
                    </div>
                </form>
            </div>
        </nav>
    </div>
    <div>
        <ul class="collection">
            @foreach ($traceabilities as $log)
            <li class="collection-item">
                <span class="message"><b>Mensagem:</b> {{ $log->message }}</span><br>
                <span class="moment"><b>Momento:</b> {{ date('d/m/Y H:i', strtotime($log->created_at)) }}</span><br>
                <span class="autor"><b>Autor:</b> {{ $log->user->name }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
@push('scripts')
<script>
    const inputSearchTraceabilities = document.getElementById('search_traceability');
    const containerList = document.querySelector("ul.collection");
    const frmSearchTraceability = document.getElementById('frm_search_traceability');

    frmSearchTraceability.addEventListener("submit", e => e.preventDefault());
    
    inputSearchTraceabilities.addEventListener("input", (e) => {
        listTraceabilities(e.target.value);
    });

    const listTraceabilities = (valueSearch = "") => {
        const MIN_TEXT_SEARCH = 1;
        const traceabilities = document.querySelectorAll(".collection-item");
        if (valueSearch.length >= MIN_TEXT_SEARCH) {
            traceabilities.forEach(e => {
                let txtEFilter = e.innerText;
                if (txtEFilter.toUpperCase().includes(valueSearch.toUpperCase())) {
                    e.style.display = "";
                    txtEFilter = txtEFilter.replace(new RegExp(valueSearch, "gi"), (match) => {
                        return `<strong style="color:red">${match}</strong>`
                    })
                } else {
                    e.style.display = "none";
                }
                e.innerHTML = txtEFilter.replace('Mensagem:', "<b>Mensagem:</b>").replace('Momento:', "<br><b>Momento:</b>").replace('Autor:', "<br><b>Autor:</b>");
            });
        } else {
            location.href = location.href;
        }
    }
</script>
@endpush