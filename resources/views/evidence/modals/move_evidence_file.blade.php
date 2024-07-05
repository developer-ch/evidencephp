<!-- Modal Structure -->
<div id="modal_move_file" class="modal">
    <form id="form_move_file" method="POST">
        @csrf
        @method('POST')
        <div class="modal-content">
            <b>AGRUPADOR DESTINO</b> <i class="modal-close material-icons right">close</i>
            <hr>
            <div class="row">
                <select class="select2 browser-default" name="new_evidence">
                    <option value="" selected disabled></option>
                    @isset($evidences)
                        @foreach ($evidences as $evidence)
                            <option value="{{ $evidence->id }}">{{ $evidence->reference }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn waves-effect waves-light teal darken-4"><i
                    class="material-icons left">check</i>MOVIMENTAR</button>
        </div>
    </form>
</div>
