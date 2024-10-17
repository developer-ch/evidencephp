<!-- Modal Structure -->
<div id="uploadImagens" class="modal modal-fixed-footer">
    <form action="{{ route('file.evidence.storage', $searchEvidence??0) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <b>IMPORTAÇÃO DE IMAGENS</b><i class="modal-close material-icons right">close</i>
            <hr>
            <div class="row">
                <div class="file-field input-field">
                    <div class="btn teal darken-4 pulse">
                        <span><i class="material-icons Large teal darken-4 ">add_a_photo</i></span>
                        <input type="file" name="evidence_file[]" multiple accept="image/*">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path" type="hidden" placeholder="Upload one or more files" readonly
                            onchange="document.getElementById('in_load').setAttribute('class','hide');document.getElementById('div_load').removeAttribute('class');this.form.submit()">
                    </div>
                </div>
            </div>
            <b>AO IMPORTAR:</b>
            <div class="row">
                <div class="switch">
                    <label>
                        <input name="adjust_img" class="teal" type="checkbox" checked type="checkbox"
                            onclick="this.checked?$('.op_adjust_img').text('SIM,'):$('.op_adjust_img').text('NÃO,')">
                        <span class="lever teal darken-4"></span>
                        <b><span class="op_adjust_img">SIM,</span></b>ajustar <b>IMG</b> maior que 1024x768
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="switch">
                    <label>
                        <input name="stamp_to_date" class="teal" type="checkbox" checked
                            onclick="this.checked?$('.op_stamp_to_date').text('SIM,'):$('.op_stamp_to_date').text('NÃO,')">
                        <span class="lever teal darken-4"></span>
                        <b><span class="op_stamp_to_date">SIM,</span></b>carimbar data e hora
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>