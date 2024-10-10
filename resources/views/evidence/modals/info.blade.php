<div id="modalinfo" class="modal">
    <div class="modal-content">
        <h5><b>INFORMAÇÕES</b><i class="modal-close material-icons right">close</i></h5>
        <div class="card-panel white">
            <b>EVIDENCE</b>
            <hr>
            O "<b>EVIDENCE</b>" é um sistema, para agrupar arquivos de imagem, buscando facilitar a organização.
            <br /><br /><b>VERSÃO</b>
            <hr>
            <span id="span-version"></span>
            <br /><br /><b>DESENVOLVEDOR</b>
            <hr>
            Carlos Henrique Mendes Lopes
        </div>
    </div>
</div>
@push('scripts')
<script>
    const spanVersion = document.getElementById("span-version")
    const API_URL_BASE = "https://api.github.com/repos/developer-ch/evidencephp"

    var options = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric'
    };
    options.timeZone = 'America/Sao_paulo';

    (async () => {
        const response = await fetch(API_URL_BASE)
        const data = await response.json()
        spanVersion.innerText = new Date(await data.pushed_at).toLocaleDateString('pt-BR', options)
    })();
</script>
@endpush