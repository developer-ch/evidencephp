<!-- Modal Structure -->
<div id="edit" class="modal">
    <form action="{{ route('evidence.update', $evidence->id ?? 0) }}" method="post" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <b>RENOMEAR</b><i class="modal-close material-icons right">close</i>
            <hr>
            <div class="row">
                <button class="btn waves-effect waves-light teal darken-4" type="submit">SALVAR
                    <i class="material-icons left">save</i>
                </button>
            </div>
            <div class="row">
                <div class="input-field col s12 l4">
                    <i class="material-icons prefix">date_range</i>
                    <input id="date_process" type="date" name="date_process"
                        value="{{ $evidence->created_at ?? date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required
                        placeholder="Informe aqui o agrupador.">
                    <label for="date_process">Data do processo</label>
                </div>
                <div class="input-field col s12 l8">
                    <i class="material-icons prefix">description</i>
                    <input id="reference" type="text" name="reference" required placeholder="Exemplo:C1 ABCD1234567"
                        autofocus="autofocus" value="{{ substr($evidence->reference ?? '', 9) ?? '' }}">
                    <label for="reference">Novo Agrupador</label>
                </div>
            </div>
        </div>
    </form>
</div>
