<?php
class Treino extends Database
{

    public $treino;
    public $treinoIniciado;
    public $usuario;

    public function consultarTreinosAluno()
    {
        $sql = "SELECT
        t.idtreino,
        t.nome as nometreino
        FROM treinos_exercicios as te
        INNER JOIN treinos as t on te.idtreino = t.idtreino
        WHERE t.idusuario = ?
        GROUP by 1,2";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($this->usuario));

        return $sql->fetchAll();
    }

    public function consultarTreinoIniciado()
    {
        $sql = "SELECT ti.* ,
                t.nome as nometreino
                FROM treinos_iniciados as ti
                INNER JOIN treinos as t on t.idtreino = ti.idtreino
                WHERE t.idusuario = ? and concluido = false";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($this->usuario));

        return $sql->fetch();
    }

    public function cadastrarExercicioTreino($exercicio, $qntRepeticoes, $repeticoes)
    {
        $sql = "INSERT INTO treinos_iniciados_exercicios (idti, idexercicio, qnt_repeticoes, repeticoes, concluido)
                VALUES (:treino_iniciado, :exercicio, :qnt_repeticoes, :repeticoes, false)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':treino_iniciado', $this->treinoIniciado);
        $sql->bindValue(':exercicio', $exercicio);
        $sql->bindValue(':qnt_repeticoes', $qntRepeticoes);
        $sql->bindValue(':repeticoes', $repeticoes);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function iniciarTreino()
    {
        $sql = "INSERT INTO treinos_iniciados (idtreino, momento_inicio, concluido) VALUES (:treino, now(), false)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':treino', $this->treino);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            $this->treinoIniciado = $this->db->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    public function marcarExercicioRealizado($exercicio)
    {
        $sql = "UPDATE treinos_iniciados_exercicios set concluido = true WHERE idti = :treino_iniciado and idexercicio = :exercicio";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':treino_iniciado', $this->treinoIniciado);
        $sql->bindValue(':exercicio', $exercicio);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function consultarExerciciosTreino()
    {
        $sql = "SELECT
                te.idtreino,
                e.idexercicio,
                e.nome as nome_exercicio,
                te.qnt_repeticoes,
                te.repeticoes
                FROM treinos_exercicios as te
                INNER JOIN  exercicios as e on e.idexercicio = te.idexercicio
                WHERE te.idtreino = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($this->treino));

        return $sql->fetchAll();
    }

    public function consultarExerciciosRealizando()
    {
        $sql = "SELECT 
                e.idexercicio,
                e.nome as nome_exercicio,
                te.qnt_repeticoes,
                te.repeticoes,
                te.concluido
                FROM treinos_iniciados_exercicios as te
                INNER JOIN  exercicios as e on e.idexercicio = te.idexercicio
                WHERE te.idti = :treino_iniciado
                ORDER BY te.concluido";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':treino_iniciado', $this->treinoIniciado);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function consultarUltimosTreinos()
    {
        $sql =  "SELECT 
                ti.idtreino,
                t.nome,
                ti.momento_inicio,
                ti.concluido
                FROM treinos_iniciados as ti
                INNER JOIN treinos as t on t.idtreino = ti.idtreino
                WHERE t.idusuario = ?
                ORDER BY ti.momento_inicio";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($_SESSION['user']['idusuario']));

        return $sql->fetchAll();
    }

    public function consultarExerciciosNaoRealizado()
    {
        $sql = "SELECT 
                e.idexercicio,
                e.nome as nome_exercicio,
                te.qnt_repeticoes,
                te.repeticoes,
                te.concluido
                FROM treinos_iniciados_exercicios as te
                INNER JOIN  exercicios as e on e.idexercicio = te.idexercicio
                WHERE te.idti = :treino_iniciado and te.concluido = false";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':treino_iniciado', $this->treinoIniciado);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function deletarExerciciosRealizando()
    {
        $sql = "DELETE FROM treinos_iniciados_exercicios WHERE idti = :treino_iniciado";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':treino_iniciado', $this->treinoIniciado);
        $sql->execute();
    }

    public function finalizarTreino()
    {
        $sql = "UPDATE treinos_iniciados set concluido = true WHERE idti = :treino_iniciado";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':treino_iniciado', $this->treinoIniciado);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function rankUsuariosTreino()
    {
        $sql = "SELECT u.nome as usuario, count(*) as total_treino
                FROM treinos_iniciados as ti
                INNER JOIN treinos as t on t.idtreino = ti.idtreino
                INNER JOIN usuarios as u on u.idusuario = t.idusuario
                WHERE concluido = 1 
                GROUP BY t.idusuario
                ORDER BY 2 DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        return $sql->fetchAll();
    }
}
