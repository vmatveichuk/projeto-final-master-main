<?php

class Chat
{

    public function buscarAlunosByProfessor()
    {
        $chatModel = new ChatModel();
        $chatModel->professor =  $_SESSION['user']['idusuario'];
        echo json_encode($chatModel->buscarAlunosByProfessor());
    }

    public function enviarMsg()
    {

        $chatModel = new ChatModel();
        $chatModel->aluno =  $_SESSION['user']['idusuario'];
        $chatModel->professor =  $_SESSION['user']['professor'];
        $chatModel->mensagem = $_POST['msg'];
        $chatModel->gravarNovaMensagemAluno();
    }

    public function enviarMsgProf()
    {

        $chatModel = new ChatModel();
        $chatModel->aluno =  $_POST['user'];
        $chatModel->professor =  $_SESSION['user']['idusuario'];
        $chatModel->mensagem = $_POST['msg'];
        $chatModel->gravarNovaMensagemProfessor();
        $chatModel->marcarMsgSRespondida();
    }

    public function buscarMsgAluno()
    {
        $chatModel = new ChatModel();
        $chatModel->aluno =  $_SESSION['user']['idusuario'];
        echo json_encode($chatModel->buscarMsgAluno());
    }

    public function buscarMsgProfessor()
    {
        $chatModel = new ChatModel();
        $chatModel->aluno =  $_POST['user'];
        echo json_encode($chatModel->buscarMsgAluno());
    }
}
