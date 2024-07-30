<?php
class EstadoFisico extends Database
{
    public $usuario;

    public function consultarEstadoFisicoAtleta()
    {
        $sql = "SELECT * FROM estado_fisico WHERE idusuario = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($this->usuario));

        return $sql->fetchAll();
    }

    public function registarEstadoFisico($nome, $valor)
    {
        $sql = "INSERT INTO estado_fisico (nome_avaliacao, valor_avaliacao, idusuario) VALUES(:nome, :valor, :id)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':id', $this->usuario);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            $retorno['status'] = 'success';
            $retorno['mensagem'] = 'Avaliação registrada';
        } else {
            $retorno['status'] = 'error';
            $retorno['mensagem'] = 'Ocorreu um erro';
        }

        return $retorno;
    }
}
