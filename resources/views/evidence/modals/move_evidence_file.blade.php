<!-- Modal Structure -->
<div id="modal_move_file" class="modal">
    <form id="form_move_file" method="POST">
        @csrf
        @method('POST')
        <div class="modal-content">
            <b>AGRUPADOR DESTINO</b> 
            <hr>
            <div class="row">
                <select class="select2 browser-default" name="new_evidence" onchange="this.form.submit()">
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
