<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
    function verifica_avaliacao_id($id){
        $sql = "
        SELECT * FROM `avaliacao` WHERE `id`=$id;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //localizado
            return true;
        } else {
            //não localizado
            return false;
        }   
    }
    function verifica_avaliacao_nome($nome){
        $sql = "
        SELECT * FROM `avaliacao` WHERE `nome`=$nome;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //localizado
            return true;
        } else {
            //não localizado
            return false;
        }   
    }
    function verifica_avaliacao_matricula($matricula){
        $sql = "
        SELECT * FROM `avaliacao` WHERE `matricula`='$matricula';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //localizado
            return true;
        } else {
            //não localizado
            return false;
        }   
    }
    function verifica_avaliacao_matricula2($matricula, $id){
        $sql = "
        SELECT * FROM `avaliacao` WHERE `matricula`='$matricula' and not `id` = '$id'
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //localizado
            return true;
        } else {
            //não localizado
            return false;
        }   
    }
    function novo_avaliacoes($disciplina_id,$turma_id,$matricula, $descricao,$data){
        $sql = "
        INSERT INTO `avaliacao` (`id`, `matricula`, `descricao`,`data`,`disciplina_id`,`turma_id`) VALUES (NULL, '$matricula', '$descricao','$data','$disciplina_id','$turma_id');
        ";
        $mysqli = openDatabaseConnection();
        if ($mysqli->query($sql)){
            $message = 'avaliacao registrado com sucesso.';
            $message_type = 'success';
            managerMessage($message, $message_type);
            return true;
        } else {
            $message = 'Erro ao inserir avaliacao.';
            $message_type = 'danger';
            managerMessage($message, $message_type);
            return false;
        }   
    }
    function editar_avaliacao($descricao,$data,$id){
        $sql = "
        UPDATE `avaliacao` SET 
            `descricao` = '$descricao',
            `data` ='$data'
            WHERE `id` = $id;
        ";
        $mysqli = openDatabaseConnection();
        if ($mysqli->query($sql)){
            $message = 'avaliacao editada com sucesso.';
            $message_type = 'success';
            managerMessage($message, $message_type);
            return true;
        } else {
            $message = 'Erro ao editar avaliacao.';
            $message_type = 'danger';
            managerMessage($message, $message_type);
            return false;
        }   
    }
    function entregar($id){
        $sql = "
        UPDATE `avaliacao` SET 
            `estado` = 'entregue'
            WHERE `id` = $id;
        ";
        $mysqli = openDatabaseConnection();
        if ($mysqli->query($sql)){
            $message = 'avaliacao editada com sucesso.';
            $message_type = 'success';
            managerMessage($message, $message_type);
            return true;
        } else {
            $message = 'Erro ao editar avaliacao.';
            $message_type = 'danger';
            managerMessage($message, $message_type);
            return false;
        }   
    }
    function confirma_nota_avaliacao($id, $nota){
       if(!verifica_avaliacao_id($id)){
        $message = 'Essa avaliacao não existe.';
        $message_type = 'warning';
        managerMessage($message, $message_type);
        return array(
            "resposta" => false,
            "resposta_message" => $message
            );
       } else {
           $sql = "
            UPDATE `avaliacao` SET 
            `nota` = '$nota',
            `revisar` = '1',
            `estado` = 'corrigida'  
            WHERE `id` = $id;
            ";
            $con = openDatabaseConnection();
            if(mysqli_query($con,$sql ) === true){
                $message = 'Dados do avaliacao atualizado com sucesso.';
                $message_type = 'success';
                managerMessage($message, $message_type);
                return array(
                    "resposta" => true,
                    "resposta_message" => $message
                    );
            } else {
                $message = 'Falha ao atualizar, tente novamente.';
                $message_type = 'danger';
                managerMessage($message, $message_type);
                return array(
                    "resposta" => false,
                    "resposta_message" => $message
                    );
            }
        }
    }
    function lista_avaliacoes($disciplina_id, $turma_id){
        $sql = "
        SELECT distinct `data`  FROM `avaliacao` WHERE `disciplina_id` = '$disciplina_id' and `turma_id` = '$turma_id' ORDER BY `avaliacao`.`data` DESC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $avaliacoes[$i]= array(
                "data" => $row['data'],
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem avaliacoes cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de avaliacoes.",
                "avaliacoes" => $avaliacoes,
                "size-avaliacoes" => sizeof($avaliacoes),
            );
        } else {
            //não existem avaliacoes
            return array(
                "resposta" => false,
                "resposta_message" => "não existem avaliacoes cadastrados.",
            );
        }  
    }
    function lista_avaliacoes_por_disciplina($disciplina_id, $turma_id){
        $sql = "
        SELECT * FROM `avaliacao` WHERE `disciplina_id` = '$disciplina_id' and `turma_id` = '$turma_id'  ORDER BY `avaliacao`.`matricula` DESC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $avaliacoes[$i]= array(
                "id" => $row['id'],
                "matricula" => $row['matricula'],
                "nota" => $row['nota'],
                "descricao" => $row['descricao'],
                "estado" => $row['estado'],
                "revisar" => $row['revisar'],
                "data" => $row['data']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem avaliacoes cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de avaliacoes.",
                "avaliacoes" => $avaliacoes,
                "size-avaliacoes" => sizeof($avaliacoes),
            );
        } else {
            //não existem avaliacoes
            return array(
                "resposta" => false,
                "resposta_message" => "não existem avaliacoes cadastrados.",
            );
        }  
    }
    function lista_avaliacoes_por_aluno($disciplina_id, $turma_id,$matricula){
        $sql = "
        SELECT * FROM `avaliacao` WHERE `disciplina_id` = '$disciplina_id' and `turma_id` = '$turma_id' and  `matricula` = '$matricula' ORDER BY `avaliacao`.`data` ASC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $avaliacoes[$i]= array(
                "id" => $row['id'],
                "matricula" => $row['matricula'],
                "nota" => $row['nota'],
                "descricao" => $row['descricao'],
                "estado" => $row['estado'],
                "revisar" => $row['revisar'],
                "data" => $row['data']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem avaliacoes cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de avaliacoes.",
                "avaliacoes" => $avaliacoes,
                "size-avaliacoes" => sizeof($avaliacoes),
            );
        } else {
            //não existem avaliacoes
            return array(
                "resposta" => false,
                "resposta_message" => "não existem avaliacoes cadastrados.",
            );
        }  
    }
    function lista_avaliacoes_alunos($disciplina_id, $turma_id, $data){
        $sql = "
        SELECT * FROM `avaliacao` WHERE `disciplina_id` = '$disciplina_id' and `turma_id` = '$turma_id' and `data` = '$data' ORDER BY `avaliacao`.`matricula` DESC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $avaliacoes[$i]= array(
                "id" => $row['id'],
                "matricula" => $row['matricula'],
                "nota" => $row['nota'],
                "revisar" => $row['revisar'],
                "data" => $row['data']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem avaliacoes cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de alunos.",
                "avaliacoes" => $avaliacoes,
                "size-avaliacoes" => sizeof($avaliacoes),
            );
        } else {
            //não existem avaliacoes
            return array(
                "resposta" => false,
                "resposta_message" => "não existem avaliacoes cadastrados.",
            );
        }  
    }
    function lista_turmas_professor_avaliacoes($nome){
        //busca registros desse professor


        $sql = "
        SELECT * FROM `avaliacao` WHERE `nome` LIKE '%$nome%' or `matricula` LIKE '%$nome%' ORDER BY `avaliacao`.`nome` ASC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $avaliacoes[$i]= array(
                "id" => $row['id'],
                "nome" => $row['nome'],
                "matricula" => $row['matricula']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem avaliacoes cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de avaliacoes.",
                "avaliacoes" => $avaliacoes,
                "size-avaliacoes" => sizeof($avaliacoes),
            );
        } else {
            //não existem avaliacoes
            return array(
                "resposta" => false,
                "resposta_message" => "não existem avaliacoes cadastrados.",
            );
        }  
    }
    function deletar_avaliacao_id($id){
        if(avaliacao_avaliacao($id)){
            $message = 'Para deletar uma avaliacao, é necessário remover as <b>avaliações</b> desta avaliacao.';
            $message_type = 'warning';
            managerMessage($message, $message_type);
            return false;
        } else {
            $sql = "
            DELETE FROM `avaliacao` WHERE `id` = $id;
            ";
            $con = openDatabaseConnection();
            if(mysqli_query($con,$sql ) === true){
                $message = 'Avaliação excluída.';
                $message_type = 'success';
                managerMessage($message, $message_type);
                return true;
            } else {
                $message = 'Erro ao excluir a avaliacão';
                $message_type = 'danger';
                managerMessage($message, $message_type);
                return false;
            } 
        }
     
    }
    function avaliacao_avaliacao($id){
        $sql = "
        SELECT * FROM `avaliacao` where `matricula`= '$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        
        if (mysqli_num_rows($query)) {
            //localizado
            return true;
        } else {
            //não localizado
            return false;
        }  
    }
    function visualizar_avaliacao_id($id){
        $sql = "
        SELECT * FROM `avaliacao` WHERE `id` LIKE '$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "avaliacao encontrado",
                "id" => $row['id'],
                "nome" => $row['nome'],
                "matricula" => $row['matricula']
            );

        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "avaliacao não encontrado",
            );
        }   
    }
    function visualizar_ultimo_id_avaliacao($nome){
        $sql = "
        SELECT * FROM `avaliacao` WHERE `nome` LIKE '%$nome%' ORDER BY `avaliacao`.`id` DESC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $avaliacoes[$i]= array(
                "id" => $row['id'],
                "nome" => $row['nome'],
                "matricula" => $row['matricula']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem avaliacoes cadastrados
            return $avaliacoes[0]['id'];
        } else {
            //não existem avaliacoes
            return false;
        }  
    }
    function quantidade_avaliacoes(){
        $sql = "
        SELECT * FROM `avaliacao`;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        return mysqli_num_rows($query);
    }
    function quantidade_avaliacoes_sem_avaliacao(){
        $sql = "
        SELECT * FROM `avaliacao` WHERE `revisar` = '0';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        return mysqli_num_rows($query);
    }
    function quantidade_avaliacoes_sem_avaliacao_professsor($turma_id, $disciplina_id){
       $sql = "
        SELECT * FROM `avaliacao` WHERE `revisar` = '0' and `turma_id` = '$turma_id'  and `disciplina_id` = '$disciplina_id' ;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        return mysqli_num_rows($query);
    }
    function quantidade_avaliacoes_sem_correcao_aluno($matricula){
        $sql = "
         SELECT * FROM `avaliacao` WHERE `revisar` = '0' and `matricula` = '$matricula';
         ";
         $con = openDatabaseConnection();
         $query = mysqli_query($con,$sql);
         return mysqli_num_rows($query);
     }
     function quantidade_avaliacoes_corrigidas_aluno($matricula){
        $sql = "
         SELECT * FROM `avaliacao` WHERE `revisar` = '1' and `matricula` = '$matricula';
         ";
         $con = openDatabaseConnection();
         $query = mysqli_query($con,$sql);
         return mysqli_num_rows($query);
     }
    function quantidade_avaliacoes_professsor($turma_id, $disciplina_id){
        $sql = "
         SELECT * FROM `avaliacao` WHERE `turma_id` = '$turma_id'  and `disciplina_id` = '$disciplina_id' ;
         ";
         $con = openDatabaseConnection();
         $query = mysqli_query($con,$sql);
         return mysqli_num_rows($query);
    }
    function media_geral_avaliacoes(){
        $sql = "SELECT revisar, nota FROM `avaliacao` WHERE `revisar` != '0';";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i = 0;
        $notag = 0;
        
        while($row= mysqli_fetch_array($query)){
           $notag = $notag + floatval ($row['nota']);
            $i++;
        }

        if($i >'0'){
            $mediag = $notag / $i;
            } else { $mediag = 0; }

        $mediag = number_format($mediag, 2, '.','');
        
        if (mysqli_num_rows($query)) {
            return array(
                "resposta"              => true,
                "resposta_message"      => "média geral.",
                "media-geral"           => $mediag,
                "quantidade-avaliacoes" => $i
            );
        } else {
            return array(
                "resposta" => false,
                "resposta_message" => "não existem avaliacoes cadastrados.",
            );
        }  
    }
    function media_geral_avaliacoes_turma_disciplina($turma_id, $disciplina_id){
        $sql = "SELECT * FROM `avaliacao` WHERE `revisar` = '1' and `turma_id` = '$turma_id' and `disciplina_id` = '$disciplina_id';";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i = 0;
        $notag = 0;
        
        while($row= mysqli_fetch_array($query)){
           $notag = $notag + floatval ($row['nota']);
            $i++;
        }
        if($i >'0'){
        $mediag = $notag / $i;
        } else { $mediag = 0; }
        
        $mediag = number_format($mediag, 2, '.','');
        
        if (mysqli_num_rows($query)) {
            return array(
                "resposta"              => true,
                "resposta_message"      => "média geral.",
                "media-geral"           => $mediag,
                "quantidade-avaliacoes" => $i
            );
        } else {
            return array(
                "resposta" => false,
                "resposta_message" => "não existem avaliacoes cadastrados.",
            );
        }  
    }
    function media_geral_avaliacoes_aluno($matricula){
        $sql = "SELECT * FROM `avaliacao` WHERE `revisar` = '1' and `matricula` = '$matricula';";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i = 0;
        $notag = 0;
        
        while($row= mysqli_fetch_array($query)){
           $notag = $notag + floatval ($row['nota']);
            $i++;
        }
        if($i >'0'){
        $mediag = $notag / $i;
        } else { $mediag = 0; }
        
        $mediag = number_format($mediag, 2, '.','');
        
        if (mysqli_num_rows($query)) {
            return array(
                "resposta"              => true,
                "resposta_message"      => "média geral.",
                "media-geral"           => $mediag,
                "quantidade-avaliacoes" => $i
            );
        } else {
            return array(
                "resposta" => false,
                "resposta_message" => "não existem avaliacoes cadastrados.",
            );
        }  
    }
    function media_geral_avaliacoes_aluno_disci($matricula,$disci){
        $sql = "SELECT * FROM `avaliacao` WHERE `revisar` = '1' and `matricula` = '$matricula' and `disciplina_id` = '$disci';";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i = 0;
        $notag = 0;
        
        while($row= mysqli_fetch_array($query)){
           $notag = $notag + floatval ($row['nota']);
            $i++;
        }
        if($i >'0'){
        $mediag = $notag / $i;
        } else { $mediag = 0; }
        
        $mediag = number_format($mediag, 2, '.','');
        
        if (mysqli_num_rows($query)) {
            return array(
                "resposta"              => true,
                "resposta_message"      => "média geral.",
                "media-geral"           => $mediag,
                "quantidade-avaliacoes" => $i
            );
        } else {
            return array(
                "resposta" => false,
                "resposta_message" => "não existem avaliacoes cadastrados.",
            );
        }  
    }
    function lista_alunos_professsor($turma_id, $disciplina_id){
        $sql = "
        SELECT distinct `matricula` FROM `avaliacao` WHERE `turma_id` = '$turma_id' and `disciplina_id` = '$disciplina_id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $alunos[$i]= array(
                "matricula" => $row['matricula']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem avaliacoes cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de alunos de uma disciplina.",
                "alunos" => $alunos,
                "size-alunos" => sizeof($alunos)
            );
        } else {
            //não existem avaliacoes
            return array(
                "resposta" => false,
                "resposta_message" => "não existem alunos nesta turma."
            );
        }  
    }
    function quantidade_avaliacoes_sem_avaliacao_professsor_data($turma_id, $disciplina_id, $data){
        $sql = "
         SELECT * FROM `avaliacao` WHERE `revisar` = '0' and `turma_id` = '$turma_id'  and `disciplina_id` = '$disciplina_id' and `data` = '$data' ;
         ";
         $con = openDatabaseConnection();
         $query = mysqli_query($con,$sql);
         return mysqli_num_rows($query);
    }
    function revisar_avaliacao_id($id){
        if(!verifica_avaliacao_id($id)){
            $message = 'Essa avaliacao não encontrada.';
            $message_type = 'danger';
            managerMessage($message, $message_type);
            return array(
                "resposta" => false,
                "resposta_message" => $message
                );
           } else {
               $sql = "
                UPDATE `avaliacao` SET 
                `revisar` = '0'  
                WHERE `id` = $id;
                ";
                $con = openDatabaseConnection();
                if(mysqli_query($con,$sql ) === true){
                    $message = 'Avaliação liberada para edição.';
                    $message_type = 'success';
                    managerMessage($message, $message_type);
                    return array(
                        "resposta" => true,
                        "resposta_message" => $message
                        );
                } else {
                    $message = 'Falha ao atualizar, tente novamente.';
                    $message_type = 'danger';
                    managerMessage($message, $message_type);
                    return array(
                        "resposta" => false,
                        "resposta_message" => $message
                        );
                }
            }
    }
