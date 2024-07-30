<?php

    class Main
    {
        protected function criarMsgErro($mensagem)
        {
            $msgError = "<div class='alertDanger'>";
            $msgError .="<p>$mensagem</p>";
            $msgError .= "</div>";
            return $msgError;
        }

        protected function criarMsgSucesso($mensagem)
        {
            $msgSuccess = "<div class='alertSuccess'>";
            $msgSuccess .= "<p>$mensagem</p>";
            $msgSuccess .= "</div>";
            return $msgSuccess;
        }
    }
?>