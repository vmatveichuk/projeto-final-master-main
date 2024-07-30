<?php
function sidebar_aluno($pagina){
?>
    <nav id="sidebar">
        <ul class="list-unstyled components">
            <li class="<?=$pagina == 'painel' ? 'active' : '' ?>">
                <a href="/alunos/painel">
                    <img src="/sx/common/assets/painel-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Painel</div>
                </a>
            </li>
            <li class="<?=$pagina == 'avaliacoes' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/alunos/avaliacoes">
                    <img src="/sx/common/assets/avaliacoes-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Avaliações</div>
                </a>
            </li>
            <li class="<?=$pagina == 'turma' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/alunos/turma">
                    <img src="/sx/common/assets/turma.png" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Turma</div>
                </a>
            </li>
            <li class="<?=$pagina == 'disciplinas' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/alunos/disciplinas">
                    <img src="/sx/common/assets/subject-icon-1.jpg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Disciplinas</div>
                </a>
            </li>
            <li class="<?=$pagina == 'envio_documentos' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/alunos/envio_documentos">
                    <img src="/sx/common/assets/upload.png" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Envios documentos</div>
                </a>
            </li>
            <li class="<?=$pagina == 'quadro_de_horarios' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/alunos/quadro_horarios">
                    <img src="/sx/common/assets/sentido-horario.png" width="16" height="16" class="" alt="" color="white">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Quadro de horarios</div>
                </a>
            </li>
            <li class="<?=$pagina == 'mensalidade' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/alunos/mensalidade">
                    <img src="/sx/common/assets/cifrao.png" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Mensalidade</div>
                </a>
            </li>
            <li class="<?=$pagina == 'tutoriais' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/alunos/tutoriais">
                    <img src="/sx/common/assets/tutoriais-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Tutoriais</div>
                </a>
            </li>
            <li class="<?=$pagina == 'perfil' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/alunos/perfil">
                    <img src="/sx/common/assets/perfil-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Perfil</div>
                </a>
            </li>
            <li class="<?=$pagina == 'sair' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/sx/logout">
                    <img src="/sx/common/assets/sair-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Sair</div>
                </a>
            </li>
        </ul>
    </nav>
<?php } ?>
<?php
function sidebar_professores($pagina){
?>
    <nav id="sidebar">
        <ul class="list-unstyled components">
            <li class="<?=$pagina == 'painel' ? 'active' : '' ?>">
                <a href="/professores/painel">
                    <img src="/sx/common/assets/painel-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Painel</div>
                </a>
            </li>
            <li class="<?=$pagina == 'disciplinas' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/professores/disciplinas">
                    <img src="/sx/common/assets/professores-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Disciplinas</div>
                </a>
            </li>
            <li class="<?=$pagina == 'avaliacoes' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/professores/avaliacoes">
                    <img src="/sx/common/assets/administradores-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Avaliações.</div>
                </a>
            </li>
            <li class="<?=$pagina == 'quadro_de_horarios' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/professores/quadro_de_horarios">
                    <img src="/sx/common/assets/disciplinas-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Quadro de horarios</div>
                </a>
            </li>
            <li class="<?=$pagina == 'envio_documentos' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/professores/envio_de_documentos">
                    <img src="/sx/common/assets/avaliacoes-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Envios documentos</div>
                </a>
            </li>
            <li class="<?=$pagina == 'alunos' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/professores/alunos">
                    <img src="/sx/common/assets/avaliacoes-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Alunos</div>
                </a>
            </li>
            <li class="<?=$pagina == 'chamada' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/professores/chamada">
                    <img src="/sx/common/assets/disciplinas-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Chamada</div>
                </a>
            </li>
            <li class="<?=$pagina == 'turmas' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/professores/turmas">
                    <img src="/sx/common/assets/disciplinas-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Turmas</div>
                </a>
            </li>
            <li class="<?=$pagina == 'pagamento' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/professores/pagamentos">
                    <img src="/sx/common/assets/tutoriais-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Pagamento</div>
                </a>
            </li>
            <li class="<?=$pagina == 'tutoriais' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/professores/tutoriais">
                    <img src="/sx/common/assets/turmas-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Tutoriais</div>
                </a>
            </li>
            <li class="<?=$pagina == 'perfil' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/professores/perfil">
                    <img src="/sx/common/assets/alunos-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Perfil</div>
                </a>
            </li>
            <li class="<?=$pagina == 'sair' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/sx/logout">
                    <img src="/sx/common/assets/tutoriais-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Sair</div>
                </a>
            </li>
        </ul>
    </nav>
<?php } ?>
<?php
function sidebar_admin($pagina){
?>
    <nav id="sidebar">
        <ul class="list-unstyled components">
            <li class="<?=$pagina == 'painel' ? 'active' : '' ?>">
                <a href="/administracao/painel">
                    <img src="/sx/common/assets/painel-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Painel</div>
                </a>
            </li>
            <li class="<?=$pagina == 'instituicao' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/instituicao">
                    <img src="/sx/common/assets/instituicao-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Instituição</div>
                </a>
            </li>
            <li class="<?=$pagina == 'professores' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/professores">
                    <img src="/sx/common/assets/professores-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Professores</div>
                </a>
            </li>
            <li class="<?=$pagina == 'alunos' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/alunos">
                    <img src="/sx/common/assets/professores-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Alunos</div>
                </a>
            </li>
            <li class="<?=$pagina == 'administradores' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/administradores">
                    <img src="/sx/common/assets/professores-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Administradores</div>
                </a>
            </li>
            <li class="<?=$pagina == 'mensalidades' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/mensalidade">
                    <img src="/sx/common/assets/turmas-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Mensalidades</div>
                </a>
            </li>
            <li class="<?=$pagina == 'turmas' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/turmas">
                    <img src="/sx/common/assets/disciplinas-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Turmas</div>
                </a>
            </li>
            <li class="<?=$pagina == 'quadro_de_horarios' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/quadro_de_horarios">
                    <img src="/sx/common/assets/disciplinas-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Quadro de horarios</div>
                </a>
            </li>
            <li class="<?=$pagina == 'salas' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/salas">
                    <img src="/sx/common/assets/disciplinas-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Salas</div>
                </a>
            </li>
            <li class="<?=$pagina == 'disciplinas' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/disciplinas">
                    <img src="/sx/common/assets/alunos-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Disciplinas</div>
                </a>
            </li>
            <li class="<?=$pagina == 'tutoriais' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/tutoriais">
                    <img src="/sx/common/assets/tutoriais-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Tutoriais</div>
                </a>
            </li>
            <li class="<?=$pagina == 'perfil' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/administracao/perfil">
                    <img src="/sx/common/assets/perfil-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Perfil</div>
                </a>
            </li>
            <li class="<?=$pagina == 'sair' ? 'active' : '' ?>" style="padding-top: 1px;">
                <a href="/sx/logout">
                    <img src="/sx/common/assets/sair-icon.svg" width="16" height="16" class="" alt="">
                    &nbsp;&nbsp;<div class="d-inline-flex" style="vertical-align: middle; margin:auto ">Sair</div>
                </a>
            </li>
        </ul>
    </nav>
<?php } ?>