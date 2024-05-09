<!-- Modal Structure -->
<div id="modal_search_group" class="modal">
    <form action="{{ route('evidence.index') }}" method="GET">
        <div class="modal-content">
            <b>AGRUPADOR</b> <a href="#create" id='btn-add-selected'
                class="hoverable btn-floating right teal darken-4 tooltipped modal-trigger" data-tooltip='NOVO AGRUPADOR'
                data-position="bottom">
                <i class="small material-icons">add</i>
            </a>
            <hr>
            <div class="row">
                <select class="select2 browser-default" name="search_evidence" onchange="this.form.submit()">
                    <option value="" selected disabled>INFORME O AGRUPADOR</option>
                    @isset($evidences)
                        @foreach ($evidences as $evidence)
                            <option value="{{ $evidence->id }}"
                                @isset($searchEvidence){{ $searchEvidence == $evidence->id ? 'selected' : '' }}@endisset>
                                {{ $evidence->reference }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
    </form>
</div>
