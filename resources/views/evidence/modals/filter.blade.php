<!-- Modal Structure -->
<div id="filter" class="modal">
    <form action="{{ route('evidence.filter') }}" name="filter_evidence" method="post">
        @csrf
        <div class="modal-content">
            <b>FILTROS</b><i class="modal-close material-icons right">close</i>
            <hr>
            <div class="row">
                <button class="btn waves-effect waves-light teal darken-4" type="submit">APLICAR
                    <i class="material-icons left">save</i>
                </button>
            </div>
            <div class="row">
                <div class="input-field col s12 l4">
                    <i class="material-icons prefix">date_range</i>
                    <select name="last_days" id="last_days">
                        <option value="1" {{ $lastDays==1 ? "selected":""}}>Hoje</option>
                        <option value="7" {{ $lastDays==7 ? "selected":""}}>Ultimos 7 dias</option>
                        <option value="15" {{ $lastDays==15 ? "selected":""}}>Ultimos 15 dias</option>
                        <option value="30" {{ $lastDays==30 ? "selected":""}}>Ultimos 30 dias</option>
                        <option value="60" {{ $lastDays==60 ? "selected":""}}>Ultimos 60 dias</option>
                        <option value="120" {{ $lastDays==120 ? "selected":""}}>Ultimos 120 dias</option>
                        <option value="365" {{ $lastDays==365 ? "selected":""}}>Ultimos 365 dias</option>
                    </select>
                    <label for="reference">Périodo:</label>
                </div>
                <div class="input-field col s12 l4">
                    <i class="material-icons prefix">description</i>
                    <select name="operation" id="operation">
                        <option value="" selected>-</option>
                        <option value="ENTRADA_" {{ $operation=="ENTRADA_" ? "selected":""}}>ENTRADA</option>
                        <option value="SAIDA_" {{ $operation=="SAIDA_" ? "selected":""}}>SAIDA</option>
                    </select>
                    <label for="reference">OPERAÇÃO</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">description</i>
                    <input id="reference" type="text" name="reference" value="{{$reference??''}}"placeholder="Digite...">
                    <label for="reference">Referencia</label>
                </div>
            </div>
        </div>
    </form>
</div>
