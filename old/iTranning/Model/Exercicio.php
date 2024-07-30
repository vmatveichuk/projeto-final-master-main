<?php

class Exercicio extends Database
{
    public $idexercicio;

    public function consultarExercicios()
    {
        $sql = "SELECT idexercicio, nome, sc.descricao as status
                FROM exercicios as e
                INNER JOIN situacao_cadastro as sc on sc.idsituacao = e.idsituacao
                order by 1";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function consultarDadosExercicio()
    {
        $sql = "SELECT * FROM exercicios WHERE idexercicio = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($this->idexercicio));

        return $sql->fetch();
    }

    public function cadastrarExercicio()
    {
        $nomeExercico = addslashes($_POST['exercicioNome']);
        $urlExercico = addslashes($_POST['exercicioUrl']);
        $instrucoesExercico = addslashes($_POST['exercicioInstru']);

        $sql = "INSERT INTO exercicios (nome,urlvideo, instrucoes, idsituacao) VALUES(:nome,  :video,  :instrucoes, 1 )";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':nome', $nomeExercico);
        $sql->bindValue(':video', $urlExercico);
        $sql->bindValue(':instrucoes', $instrucoesExercico);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            $retorno['status'] = 'success';
            $retorno['mensagem'] = 'Exercicio cadastrado';
        } else {
            $retorno['status'] = 'error';
            $retorno['mensagem'] = 'Ocorreu um erro';
        }

        return $retorno;
    }


    public function editarExercico()
    {
        $nomeExercico = addslashes($_POST['exercicioNome']);
        $urlExercico = addslashes($_POST['exercicioUrl']);
        $instrucoesExercico = $_POST['exercicioInstru'];

        $sql = "UPDATE exercicios SET nome = :nome, urlvideo =:video, instrucoes =:instrucoes WHERE idexercicio = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':nome', $nomeExercico);
        $sql->bindValue(':video', $urlExercico);
        $sql->bindValue(':instrucoes', $instrucoesExercico);
        $sql->bindValue(':id', $this->idexercicio);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            $retorno['status'] = 'success';
            $retorno['mensagem'] = 'Exercicio editado';
        } else {
            $retorno['status'] = 'error';
            $retorno['mensagem'] = 'Ocorreu um erro';
        }

        return $retorno;
    }

    public function deletarExercicio()
    {
        $sql = "UPDATE exercicios SET idsituacao = 2 WHERE idexercicio = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $this->idexercicio);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            $retorno['status'] = 'success';
            $retorno['mensagem'] = 'Exercicio excluido';
        } else {
            $retorno['status'] = 'error';
            $retorno['mensagem'] = 'Ocorreu um erro';
        }

        return $retorno;
    }
}
