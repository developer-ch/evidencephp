<!-- Modal Structure -->
<div id="confirmeDelete" class="modal modal-fixed-footer" class="col s12">
    <form action="{{ route('evidence.destroy', $searchEvidence ?? 0) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-content">
            <h4><b>POSSO CONTINUAR</b></h4>
            <hr>
            <div id="div_load_delete" class="hide">
                <b>ESTOU EXCLUINDO AGUARDE...</b>
                <div class="progress indigo lighten-4">
                    <div class="indeterminate indigo"></div>
                </div>
            </div>
            <div class="col-12 center">
                <h5>Essa operação, não poderá ser desfeita.<br /><br /><b><u>Oque farei</u></b> <br />Vou excluir o
                    agrupador<br /><b>{{ $evidence->reference ?? '' }}</b><br />e todos os arquivos
                    associados.
                </h5>
                <div style="margin:0;overflow:auto;height:13vh;overflow:auto;width:100%">
                    @foreach ($filesEvidence as $f_evd)
                        <div class="chip">
                            <img height="100%" width="100%" class="materialboxed"
                                src="{{ './storage/' . $f_evd->file }}?{{ rand() }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn red darken-4"
                onclick="document.getElementById('div_load_delete').removeAttribute('class');"><i
                    class="material-icons">check</i>SIM</button>
            <a class="btn modal-close teal darken-4"><i class="material-icons">close</i>NÃO</a>
        </div>
    </form>

</div>
