<?php

    class Email extends Main
    {
        private $codigo;
        private $destinatario;//Quem recebe
        private $remetente;//Quem manda
        private $assunto;
        private $mensagem;
        private $CAMINHO_XML_USUARIO = "C:".DIRECTORY_SEPARATOR."xampp".DIRECTORY_SEPARATOR."htdocs".DIRECTORY_SEPARATOR."projetoWeb".DIRECTORY_SEPARATOR."Class".DIRECTORY_SEPARATOR."xml/emails.xml";
        private $cc;

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
        public function getDestinatario()
        {
            return $this->destinatario;
        }

        /**
         * @param mixed $destinatario
         */
        public function setDestinatario($destinatario)
        {
            $this->destinatario = $destinatario;
        }

        /**
         * @return mixed
         */
        public function getRemetente()
        {
            return $this->remetente;
        }

        /**
         * @param mixed $remetente
         */
        public function setRemetente($remetente)
        {
            $this->remetente = $remetente;
        }

        /**
         * @return mixed
         */
        public function getAssunto()
        {
            return $this->assunto;
        }

        /**
         * @param mixed $assunto
         */
        public function setAssunto($assunto)
        {
            $this->assunto = $assunto;
        }

        /**
         * @return mixed
         */
        public function getCc()
        {
            return $this->cc;
        }

        /**
         * @param mixed $cc
         */
        public function setCc($cc)
        {
            $this->cc = $cc;
        }

        /**
         * @return mixed
         */
        public function getMensagem()
        {
            return $this->mensagem;
        }

        /**
         * @param mixed $mensagem
         */
        public function setMensagem($mensagem)
        {
            $this->mensagem = $mensagem;
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

        public function novoEmail()
        {
            try {
                $this->gerarNewControleCodigo();

                $DOMDocument = new DOMDocument('1.0', 'UTF-8');
                $DOMDocument->load($this->CAMINHO_XML_USUARIO);

                $xml_new_email = $DOMDocument->createElement("email");
                $xml_new_email_codigo = $DOMDocument->createElement("codigo", $this->codigo);
                $xml_new_email_destinatario = $DOMDocument->createElement("destinatario", $this->destinatario);
                $xml_new_email_cc = $DOMDocument->createElement("cc", $this->cc);
                $xml_new_email_remetente = $DOMDocument->createElement("remetente", $this->remetente);
                $xml_new_email_assunto = $DOMDocument->createElement("assunto", $this->assunto);
                $xml_new_email_mensagem = $DOMDocument->createElement("mensagem", $this->mensagem);
                $xml_new_email_excluido = $DOMDocument->createElement("excluido", 0);

                $xml_new_email->appendChild($xml_new_email_codigo);
                $xml_new_email->appendChild($xml_new_email_destinatario);
                $xml_new_email->appendChild($xml_new_email_cc);
                $xml_new_email->appendChild($xml_new_email_remetente);
                $xml_new_email->appendChild($xml_new_email_assunto);
                $xml_new_email->appendChild($xml_new_email_mensagem);
                $xml_new_email->appendChild($xml_new_email_excluido);

                $xml_emails = $DOMDocument->getElementsByTagName("emails")->item(0);
                $xml_emails->appendChild($xml_new_email);
                $DOMDocument->save($this->CAMINHO_XML_USUARIO);

                echo $this->criarMsgSucesso("Email enviado com sucesso");
            } catch (Exception $e) {
                echo $this->criarMsgErro("Ecorreu um erro ao enviar um novo email $e->getMessage()");
            }
        }

        public function buscarCaixaDeEntrada()
        {
            $retorno = array();
            $xml = simplexml_load_file($this->CAMINHO_XML_USUARIO);

            for ($i = 0; $i < count($xml->email); $i++) {
                $email = $xml->email[$i];

                if ($email->destinatario == $this->remetente && $email->excluido == 0) {
                    $retorno[$i]['codigo'] = (string)$email->codigo;
                    $retorno[$i]['destinatario'] = (string)$email->destinatario;
                    $retorno[$i]['remetente'] = (string)$email->remetente;
                    $retorno[$i]['assunto'] = (string)$email->assunto;
                    $retorno[$i]['mensagem'] = (string)$email->mensagem;
                }
            }

            return $retorno;
        }

        public function buscarEnviados()
        {
            $retorno = array();
            $xml = simplexml_load_file($this->CAMINHO_XML_USUARIO);

            for ($i = 0; $i < count($xml->email); $i++) {
                $email = $xml->email[$i];

                if ($email->remetente == $this->destinatario) {
                    $retorno[$i]['codigo'] = (string)$email->codigo;
                    $retorno[$i]['destinatario'] = (string)$email->destinatario;
                    $retorno[$i]['remetente'] = (string)$email->remetente;
                    $retorno[$i]['assunto'] = (string)$email->assunto;
                    $retorno[$i]['mensagem'] = (string)$email->mensagem;
                }
            }

            return $retorno;
        }

        public function buscarEmail()
        {
            $retorno = array();
            $xml = simplexml_load_file($this->CAMINHO_XML_USUARIO);

            for ($i = 0; $i < count($xml->email); $i++) {
                $email = $xml->email[$i];

                if ($email->codigo == $this->codigo) {
                    $retorno['codigo'] = (string)$email->codigo;
                    $retorno['destinatario'] = (string)$email->destinatario;
                    $retorno['remetente'] = (string)$email->remetente;
                    $retorno['assunto'] = (string)$email->assunto;
                    $retorno['mensagem'] = (string)$email->mensagem;
                    $retorno['excluido'] = (string)$email->excluido;
                }
            }

            if (empty($retorno)) {
                echo $this->criarMsgErro("Email não encontrado");
            } else {
                return $retorno;
            }

        }

        public function deletarEmail()
        {
            try {
                $DOMDocument = new DOMDocument('1.0', 'UTF-8');
                $DOMDocument->load($this->CAMINHO_XML_USUARIO);
                $codigoControle = $DOMDocument->getElementsByTagName('email');

                for ($i = 0; $i < $codigoControle->length; $i++) {
                    if (($codigoControle->item($i)->getElementsByTagName('codigo')->item(0)->nodeValue) == $this->codigo) {
                        $codigoControle->item($i)->getElementsByTagName('excluido')->item(0)->nodeValue = true;
                    }
                }
                $DOMDocument->save($this->CAMINHO_XML_USUARIO);
                echo $this->criarMsgSucesso("Email Excluido");
            } catch (Exception $e) {
                echo $this->criarMsgErro("Ocorreu um erro ao excluir o email {$e}");
            }

        }

        public function buscarDeletados()
        {
            $retorno = array();
            $xml = simplexml_load_file($this->CAMINHO_XML_USUARIO);

            for ($i = 0; $i < count($xml->email); $i++) {
                $email = $xml->email[$i];

                if ($email->destinatario == $this->remetente && $email->excluido == 1) {
                    $retorno[$i]['codigo'] = (string)$email->codigo;
                    $retorno[$i]['destinatario'] = (string)$email->destinatario;
                    $retorno[$i]['remetente'] = (string)$email->remetente;
                    $retorno[$i]['assunto'] = (string)$email->assunto;
                    $retorno[$i]['mensagem'] = (string)$email->mensagem;
                }
            }

            return $retorno;
        }

        public function buscarEmails()
        {
            $retorno = array();
            $xml = simplexml_load_file($this->CAMINHO_XML_USUARIO);

            for ($i = 0; $i < count($xml->email); $i++) {
                $email = $xml->email[$i];
                if ($email->destinatario == $this->destinatario or $email->remetente == $this->destinatario) {
                    $retorno[$i]['codigo'] = (string)$email->codigo;
                    $retorno[$i]['destinatario'] = (string)$email->destinatario;
                    $retorno[$i]['remetente'] = (string)$email->remetente;
                    $retorno[$i]['assunto'] = (string)$email->assunto;
                    $retorno[$i]['mensagem'] = (string)$email->mensagem;
                    $retorno[$i]['excluido'] = (string)$email->excluido;
                }
            }

            return $retorno;
        }

        public function buscarConteudoEmail($query)
        {

        }
    }
?>