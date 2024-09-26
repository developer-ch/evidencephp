@extends('layouts.main')
@section('title', 'AGRUPADOR DE FOTOS')
@section('page')
@include('evidence.modals.filter')
@include('evidence.modals.create')
@include('evidence.modals.edit')
@include('evidence.modals.delete')
<div class="row" style="height: 92vh" oncontextmenu="return false;">
    <div class="col s12">
        <a class='hoverable dropdown-trigger btn btn-floating indigo darken-4 tooltipped' href='#'
            data-target='dropdown0' data-position="bottom" data-tooltip='MENU GERAL'><i class="material-icons">menu</i></a>
        <!-- Dropdown Structure -->
        <ul id='dropdown0' class='dropdown-content' style="border-radius: 5px">
            <b>MENU_GERAL</b>
            <li><a href="{{route('evidence.index')}}" class="indigo-text text-darken-4 modal-trigger" id='btn-update-page'
                    onclick="updatePage()"><i class="material-icons">home</i>RECARREGAR APP</a></li>
            <li><a href="#modalinfo" class="indigo-text text-darken-4 modal-trigger"><i
                        class="material-icons">info</i>INFORMAÇÕES</a></li>
            <li class="divider" tabindex="-1"></li>
            @auth
            <li><a href="{{ route('evidence.traceability') }}" class="indigo-text text-darken-4 modal-trigger"><i
                        class="material-icons">history</i>RASTREABILIDADE</a>
            </li>
            <li><a href="{{ route('profile.edit') }}" class="indigo-text text-darken-4 modal-trigger"><i
                        class="material-icons">account_circle</i>PERFIL</a>

            </li>
            <li><a href="{{ route('logout') }}" class="indigo-text text-darken-4 modal-trigger"><i
                        class="material-icons">lock</i><b>
                        LOGOUT</b></a></li>
            @else
            <li><a href="{{ route('login') }}" class="indigo-text text-darken-4 modal-trigger"><i
                        class="material-icons">lock_open</i><b>LOGIN</b></a></li>
            @endauth
            </li>
        </ul>
        <b>AGRUPADOR</b><sup>({{ $evidences->count() }})</sup>
        @isset($searchEvidence)
        <a class='hoverable dropdown-trigger btn btn-floating right indigo darken-4 tooltipped' href='#'
            data-target='dropdown1' data-position="bottom" data-tooltip='MENU AGRUPADOR'><i
                class="material-icons">more_vert</i></a>
        <!-- Dropdown Structure -->
        <ul id='dropdown1' class='dropdown-content' style="border-radius: 5px">
            <b>MENU_AGRUPADOR</b>
            <li><a href="#edit" class="indigo-text text-darken-4 modal-trigger"><i
                        class="material-icons">text_fields</i>RENOMEAR</a></li>
            @auth
            @isset($filesEvidence[0])
            <li><a href="{{ route('evidence.downloadFiles', $searchEvidence) }}"
                    class="indigo-text text-darken-4 modal-trigger"><i
                        class="material-icons">file_download</i>BAIXAR_ARQUIVOS</a></li>
            @endisset
            <li class="divider" tabindex="-1"></li>
            <li><a href="#confirmeDelete" id='btn-delete-selected' class="red-text text-darken-4 modal-trigger"><i
                        class="material-icons">delete_sweep</i><b>EXCLUIR</b></a></li>
            @endauth
        </ul>
        @endisset
        <a href="#filter" id='btn-filter'
            class="large hoverable btn-floating right orange darken-4 tooltipped modal-trigger" data-tooltip='FILTRAR AGRUPADOR'
            data-position="bottom">
            <i class=" material-icons">filter_list</i>
        </a>
        <a href="#create" id='btn-add-selected'
            class="hoverable btn-floating right teal darken-4 tooltipped modal-trigger" data-tooltip='NOVO AGRUPADOR'
            data-position="bottom">
            <i class="small material-icons">add</i>
        </a>
        @isset($evidences)
        <form action="{{ route('evidence.index') }}" method="GET">
            <select class="select2 browser-default" name="search_evidence" onchange="this.form.submit()">
                <option value="" selected disabled>LOCALIZAR AGRUPADOR</option>
                @foreach ($evidences as $evidence)
                <option value="{{ $evidence->id }}"
                    @isset($searchEvidence){{ $searchEvidence == $evidence->id ? 'selected' : '' }}@endisset>
                    {{ $evidence->reference }}
                </option>
                @endforeach
            </select>
            <input type="hidden" name="last_days" value="{{ $lastDays }}">
            <input type="hidden" name="operation" value="{{ $operation }}">
            <input type="hidden" name="reference" value="{{ $reference }}">
        </form>
        @endisset
        @endsection
        @isset($searchEvidence)
        @section('actions')
        <div id="div_load" class="hide">
            <b>ESTOU PROCESSANDO AGUARDE...</b>
            <div class="progress indigo lighten-4">
                <div class="indeterminate indigo"></div>
            </div>
        </div>
        <div id="in_load">
            <form action="{{ route('file.evidence.storage', $searchEvidence) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="col s2 m1">
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
                <div class="col s10 m11">
                    AO IMPORTAR:
                    <div class="switch">
                        <label>
                            <input name="adjust_img" class="teal" type="checkbox" checked type="checkbox"
                                onclick="this.checked?$('.op_adjust_img').text('SIM,'):$('.op_adjust_img').text('NÃO,')">
                            <span class="lever teal darken-4"></span>
                            <b><span class="op_adjust_img">SIM,</span></b>ajustar <b>IMG</b> maior que 1024x768
                        </label>
                    </div>
                    <div class="switch">
                        <label>
                            <input name="stamp_to_date" class="teal" type="checkbox" checked
                                onclick="this.checked?$('.op_stamp_to_date').text('SIM,'):$('.op_stamp_to_date').text('NÃO,')">
                            <span class="lever teal darken-4"></span>
                            <b><span class="op_stamp_to_date">SIM,</span></b>carimbar data e hora
                        </label>
                    </div>
                </div>
            </form>
            @endsection
            @endisset
        </div>
    </div>
    @isset($filesEvidence)
    @section('listing')
    @isset($filesEvidence[0])
    Encontrei <b>{{ count($filesEvidence) }}</b> arquivo(s)
    <hr />
    @endisset
    <div class="row" style="margin:0;overflow:auto;height:68vh;overflow:auto;width:100%">
        @forelse ($filesEvidence as $f_evd)
        <div class="col s6 m3 l2" style="padding:0 0 0 5px;">
            <div class="card hoverable" style="margin:0 0 5px 0;border-radius:15px;">
                <b>{{ '#' . $loop->iteration }}</b>
                <a class='hoverable dropdown-trigger btn btn-floating right indigo darken-4 tooltipped'
                    data-target="{{ 'dropdown1' . $f_evd->id }}" data-position="bottom"
                    data-tooltip='MENU_ARQUIVO' id="{{ 'op' . $f_evd->id }}"><i
                        class="material-icons">more_vert</i></a>
                <!-- Dropdown Structure -->
                <ul id="{{ 'dropdown1' . $f_evd->id }}" class='dropdown-content' style="border-radius: 5px">
                    <b>MENU_ARQUIVO_{{ '#' . $loop->iteration }}</b>
                    <li><a href="{{ route('file.evidence.rotate', [$f_evd->id, -90]) }}"
                            id="{{ 'e_' . $f_evd->id }}" class="indigo-text text-darken-4"><i
                                class="material-icons">rotate_right</i>GIRAR_D</a>
                    </li>
                    <li><a href="{{ route('file.evidence.rotate', [$f_evd->id, 90]) }}"
                            id="{{ 'd_' . $f_evd->id }}" class="indigo-text text-darken-4"><i
                                class="material-icons">rotate_left</i>GIRAR_E</a>
                    </li>
                    @auth
                    <li><a href="{{ route('file.evidence.dowloadFile', $f_evd->id) }}"
                            id="{{ 'B_' . $f_evd->id }}" class="indigo-text text-darken-4"><i
                                class="material-icons">file_download</i>BAIXAR</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li><a href="#" data-id="{{ $f_evd->id }}"
                            class="open-modal-move-file indigo-text text-darken-4 modal-trigger"><i
                                class="material-icons">move_to_inbox</i><b>MOVER</b></a>
                    </li>
                    <li><a href="#" data-image='{{ './storage/' . $f_evd->file }}?{{ rand() }}'
                            id='{{ $f_evd->id }}'
                            class="open-modal-delete-file red-text text-darken-4 modal-trigger"><i
                                class="material-icons">delete_forever</i><b>EXCLUIR</b></a>
                    </li>

                    </li>
                    @endauth
                </ul>
                <div class="card">
                    <div class="card-image">
                        <a
                            href="{{ route('file.evidence.carousel', ['evidence' => $searchEvidence, 'evidenceFile' => $f_evd->id]) }}">
                            <img height="110px" width="100%"
                                src="{{ './storage/' . $f_evd->file }}?{{ rand() }}"
                                style="border-bottom-left-radius:15px;border-bottom-right-radius: 15px">
                        </a>
                        <div class="card-content">
                            <div class="row">
                                <form id="frmDescriptionFile" class="col s12"
                                    action="{{ route('file.evidence.description', $f_evd->id) }}" method="POST"
                                    autocomplete="off">
                                    @csrf
                                    <input type="text" name="description" placeholder="Legenda" maxlength="32" value="{{$f_evd->description}}" onchange="postDescriptionFile(this.form)">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        @isset($searchEvidence)
        <div class="col s12">
            Click no icone de camera para adicionar arquivos.
        </div>
        @endisset
        @endforelse
    </div>
</div>
@endsection
@include('evidence.modals.delete_evidence_file')
@include('evidence.modals.move_evidence_file')
@endisset
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".select2").select2({
        dropdownAutoWidth: true,
        placeholder: "PROCURAR...",
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "Não encotrei! Mude os filtros e tente novamente.";
            }
        }
    });
    $(".dropdown-trigger").dropdown({
        constrainWidth: false,
        alignment: 'right',
    });
    $(".modal").modal({
        dismissible: false
    });

    const postDescriptionFile = (e) => {
        $.post(e.action, $(e).serialize());
    }

    $('form#frmDescriptionFile').submit((e) => {
        e.preventDefault();
        postDescriptionFile(e.currentTarget)
    });

    $('a.open-modal-delete-file').click((e) => {
        const fileDelete = e.currentTarget.getAttribute("data-image");
        const id = e.currentTarget.id
        let action = "{{ route('file.evidence.delete', 0) }}"
        action = action.replace("/0", "/" + id)
        $('form#form_delete_file').attr('action', action)
        $('img#file-delete').attr('src', fileDelete)
        $('b#id_file').html("#" + id)
        $('#confirmeDeleteEvidenceFile').modal('open', true)
    });

    $('a.open-modal-move-file').click((e) => {
        const dataId = e.currentTarget.getAttribute("data-id");
        let action = "{{ route('file.evidence.move', 0) }}"
        action = action.replace("/0", "/" + dataId)
        $('form#form_move_file').attr('action', action)
        $('#modal_move_file').modal('open', true)
    });
    $('input#reference').focus();
</script>
@endpush