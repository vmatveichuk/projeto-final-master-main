<?php

class ChatModel extends Database
{

    public $id;
    public $aluno;
    public $professor;
    public $mensagem;
    public $respondida;
    public $time;


    public function buscarAlunosByProfessor()
    {
        $sql = "SELECT
                u.idusuario,
                u.nome,
                count(c.mensagem) as msg
                FROM chat as c
                INNER JOIN usuarios as u on c.aluno = u.idusuario
                WHERE u.professor = ? and c.respondida = false
                GROUP BY 1";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($this->professor));

        return $sql->fetchAll();
    }

    public function gravarNovaMensagemAluno()
    {
        $sql = "INSERT INTO chat (aluno, professor, mensagem, respondida, momento, aluno_envio)  
                VALUES (:aluno, :professor, :msg, false, now(), true)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':aluno', $this->aluno);
        $sql->bindValue(':professor', $this->professor);
        $sql->bindValue(':msg', $this->mensagem);
        $sql->execute();
    }

    public function marcarMsgSRespondida()
    {
        $sql = "UPDATE chat set respondida = true WHERE aluno = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($this->aluno));
    }

    public function gravarNovaMensagemProfessor()
    {
        $sql = "INSERT INTO chat (aluno, professor, mensagem, respondida, momento, aluno_envio)  
                VALUES (:aluno, :professor, :msg, false, now(), false)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':aluno', $this->aluno);
        $sql->bindValue(':professor', $this->professor);
        $sql->bindValue(':msg', $this->mensagem);
        $sql->execute();
    }

    public function buscarMsgAluno()
    {
        $sql = "SELECT * FROM chat WHERE aluno = ? ORDER BY momento";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($this->aluno));

        return $sql->fetchAll();
    }
}
