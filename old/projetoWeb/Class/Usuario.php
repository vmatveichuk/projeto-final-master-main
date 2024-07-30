<?php

    class Usuario extends Main
    {
        private $CAMINHO_XML_USUARIO = __DIR__ . "/xml/usuarios.xml";
        private $codigo;
        private $nome;
        private $email;
        private $senha;

        /**
         * @return mixed
         */
        public function getCodigo()
        {
            return $this->codigo;
        }

        /**
         * @param mixed $codigo
         */
        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }

        /**
         * @return mixed
         */
        public function getNome()
        {
            return $this->nome;
        }

        /**
         * @param mixed $nome
         */
        public function setNome($nome)
        {
            $this->nome = $nome;
        }

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed $email
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return mixed
         */
        public function getSenha()
        {
            return $this->senha;
        }

        /**
         * @param mixed $senha
         */
        public function setSenha($senha)
        {
            $this->senha = $senha;
        }

        public function validarConfirmacaoSenha($senhaConfirmada)
        {
            if ($this->senha !== $senhaConfirmada) {
                echo $this->criarMsgErro("As senhas não são iguais");
            } else {
                return TRUE;
            }
        }

        public function realizarLogin()
        {
            $xml = simplexml_load_file($this->CAMINHO_XML_USUARIO);

            $loginEncontrado = false;

            for ($i = 0; $i <= count($xml->usuario); $i++) {
                $usuario = $xml->usuario[$i];
                if ($this->email == $usuario->email && $this->senha == $usuario->senha) {
                    $this->codigo = $usuario->codigo;
                    $this->nome = $usuario->nome;
                    $loginEncontrado = true;
                }
            }

            if ($loginEncontrado) {
                session_start();
                $_SESSION['user']['codigo'] = (string)$this->codigo;
                $_SESSION['user']['nome'] = (string)$this->nome;
                $_SESSION['user']['email'] = (string)$this->email;
                header("Location:paginas/principal.php");
            } else {
                echo $this->criarMsgErro("Email e/ou Senha Inválidos");
            }
        }

        public function getControleCodigo()
        {
            $xml = simplexml_load_file($this->CAMINHO_XML_USUARIO);

            return $xml->codigo_controle;
        }

        public function gerarNewControleCodigo()
        {
            $DOMDocument = new DOMDocument('1.0', 'UTF-8');
            $DOMDocument->load($this->CAMINHO_XML_USUARIO);
            $codigoControle = $DOMDocument->getElementsByTagName('codigo_controle')->item(0)->nodeValue;
            $codigoControleString = $codigoControle + 1;
            $DOMDocument->getElementsByTagName('codigo_controle')->item(0)->nodeValue = $codigoControleString;
            $DOMDocument->save($this->CAMINHO_XML_USUARIO);

            $this->codigo = $codigoControleString;
            return $codigoControleString;
        }

        public function verificarEmailExistente()
        {
            $retorno = array();
            $xml = simplexml_load_file($this->CAMINHO_XML_USUARIO);

            for ($i = 0; $i < count($xml->usuario); $i++) {
                $usuario = $xml->usuario[$i];

                if ($usuario->email == $this->email) {
                    return true;
                    exit();
                }
            }

        }

        public function registrarUsuario()
        {

            if ($this->verificarEmailExistente()) {
                echo $this->criarMsgErro("Email já cadastrado");
            } else {
                try {
                    $this->gerarNewControleCodigo();

                    $DOMDocument = new DOMDocument('1.0', 'UTF-8');
                    $DOMDocument->load($this->CAMINHO_XML_USUARIO);

                    $xml_new_usuario = $DOMDocument->createElement("usuario");
                    $xml_new_usuario_codigo = $DOMDocument->createElement("codigo", $this->codigo);
                    $xml_new_usuario_nome = $DOMDocument->createElement("nome", $this->nome);
                    $xml_new_usuario_email = $DOMDocument->createElement("email", $this->email);
                    $xml_new_usuario_senha = $DOMDocument->createElement("senha", $this->senha);

                    $xml_new_usuario->appendChild($xml_new_usuario_codigo);
                    $xml_new_usuario->appendChild($xml_new_usuario_nome);
                    $xml_new_usuario->appendChild($xml_new_usuario_email);
                    $xml_new_usuario->appendChild($xml_new_usuario_senha);

                    $xml_usuarios = $DOMDocument->getElementsByTagName("usuarios")->item(0);
                    $xml_usuarios->appendChild($xml_new_usuario);
                    $DOMDocument->save($this->CAMINHO_XML_USUARIO);

                    echo $this->criarMsgSucesso("Usuário criado com sucesso");
                } catch (Exception $e) {
                    echo $this->criarMsgErro("Ecorreu um erro ao inserir um novo usuario $e->getMessage()");
                }
            }
        }

        public function buscarUsuarios()
        {
            $retorno = array();
            $xml = simplexml_load_file($this->CAMINHO_XML_USUARIO);

            for ($i = 0; $i < count($xml->usuario); $i++) {
                $usuario = $xml->usuario[$i];

                $retorno[$i]['codigo'] = (string)$usuario->codigo;
                $retorno[$i]['nome'] = (string)$usuario->nome;
                $retorno[$i]['email'] = (string)$usuario->email;
            }

            return $retorno;
        }
    }
?>