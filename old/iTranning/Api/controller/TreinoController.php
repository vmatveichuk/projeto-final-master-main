<?php

class TreinoController
{
    public function rankUsuariosTreino()
    {
        $treino = new Treino();
        echo json_encode($treino->rankUsuariosTreino());
    }
}
