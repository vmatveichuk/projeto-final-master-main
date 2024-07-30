<?php   
       include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
       include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
       include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
       include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
       include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
   function lista_usuarios($nome){
        $sql = "
        SELECT * FROM `usuarios` WHERE `nome` LIKE '%$nome%' ORDER BY `usuarios`.`id` ASC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $usuarios[$i]= array(
                "id" => $row['id'],
                "nome" => $row['nome']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem disciplinas cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de usuarios.",
                "usuarios" => $usuarios,
                "size-usuarios" => sizeof($usuarios),
            );
        } else {
            //não existem disciplinas
            return array(
                "resposta" => false,
                "resposta_message" => "não existem disciplinas cadastrados.",
            );
        }  
    }
    function busca_usuario_id($nome){
        $sql = "
        SELECT * FROM `usuarios` WHERE `nome`='$nome';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            return array(
                "resposta" => true,
                "id" => $row['id'],
                "nome" => $row['nome']
                );      
        } else {
            //não localizado
            return false;
        }   
    }


?>