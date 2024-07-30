<?php
class Usuario extends Database
{
    public function listarUsuarios($tipoUsuario, $situacao)
    {
        $sql = "SELECT idusuario, nome, usuario, idsituacao FROM usuarios WHERE idtipo = :tipo AND idsituacao =:situacao";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':tipo', $tipoUsuario);
        $sql->bindValue(':situacao', $situacao);
        $sql->execute();

        return $sql->fetchAll();
    }
}
