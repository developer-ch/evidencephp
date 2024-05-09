<!-- Modal Structure -->
<div id="confirmeDeleteEvidenceFile" class="modal modal-fixed-footer" class="col s12">
    <form id="form_delete_file" method="post">
        @csrf
        @method('DELETE')
        <div class="modal-content">
            <h4><b>POSSO CONTINUAR</b></h4>
            <hr>
            <div class="col-12 center">
                <h5>Essa operação, não poderá ser desfeita.<br /><br />
                    <b>Oque farei: </b>Vou excluir o arquivo(<b id="id_file"></b>).
                </h5>
                <img id='file-delete' class="materialboxed" src="" width="96%" height="160px">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn red darken-4"><i class="material-icons">check</i>SIM</button>
            <a class="btn modal-close teal darken-4"><i class="material-icons">close</i>NÃO</a>
        </div>
    </form>
</div>
