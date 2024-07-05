<!-- Modal Structure -->
<div id="modal_search_group" class="modal">
    <form action="{{ route('evidence.index') }}" method="GET">
        <div class="modal-content">
            <b>AGRUPADOR</b> 
            @guest
                <a href="{{ route('login') }}" class="hoverable btn-floating right indigo darken-4 indigo-text text-darken-4 tooltipped modal-trigger" data-tooltip='LOGIN'><i
                                class="small material-icons">lock_open</i><b>LOGIN</b></a>
            @endguest
            <a href="#create" id='btn-add-selected'
                class="hoverable btn-floating right teal darken-4 tooltipped modal-trigger" data-tooltip='NOVO AGRUPADOR'
                data-position="bottom">
                <i class="small material-icons">add</i>
            </a>
            <hr>
            <div class="row">
                <select class="select2 browser-default" name="search_evidence" onchange="this.form.submit()">
                    <option value="" selected disabled></option>
                    @isset($evidences)
                        @foreach ($evidences as $evidence)
                            <option value="{{ $evidence->id }}">{{ $evidence->reference }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
    </form>
</div>
