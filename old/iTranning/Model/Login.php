<?php

class Login extends Database
{
    private $codigo;
    private $nome;
    private $usuario;
    private $senha;
    private $situacao;
    private $tipo;

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function criptografarSenha()
    {
        $this->senha = md5($this->senha);
    }

    public function verificarLogin()
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':usuario', $this->usuario);
        $sql->bindValue(':senha', $this->senha);
        $sql->execute();
        $retornoUser = $sql->fetch();

        if (!empty($retornoUser['nome'])) {
            $_SESSION['user']['idusuario'] = $retornoUser['idusuario'];
            $_SESSION['user']['nome'] = $retornoUser['nome'];
            $_SESSION['user']['idtipo'] = $retornoUser['idtipo'];
            $_SESSION['user']['professor'] = $retornoUser['professor'];

            return true;
        } else {
            return false;
        }
    }
}
