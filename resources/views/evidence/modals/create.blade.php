<!-- Modal Structure -->
<div id="create" class="modal">
    <form action="{{ route('evidence.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal-content">
            <b>CADASTRO</b><i class="modal-close material-icons right">close</i>
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
                        value="{{ $date_process ?? date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                    <label for="date_process">Data processo</label>
                </div>
                <div class="input-field col s12 l8">
                    <i class="material-icons prefix">description</i>
                    <select name="operation" id="operation">
                        <option value="">-</option>
                        <option value="ENTRADA_">ENTRADA</option>
                        <option value="SAIDA_">SAIDA</option>
                    </select>
                    <label for="reference">OPERAÇÃO</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">description</i>
                    <input id="reference" type="text" name="reference" value="{{ $reference ?? '' }}" required
                        placeholder="Exemplo:C1 ABCD1234567" autofocus="autofocus">
                    <label for="reference">Agrupador</label>
                </div>
            </div>
        </div>
    </form>
</div>
