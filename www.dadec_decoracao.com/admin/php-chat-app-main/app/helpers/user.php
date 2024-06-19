<?php  

function getUser($username, $conn){
        // Consulta para buscar o usuário em tbl_cliente
        $sqlCliente = "SELECT * FROM tbl_cliente WHERE nome=?";
        $stmtCliente = $conn->prepare($sqlCliente);
        $stmtCliente->execute([$username]);
     
        // Consulta para buscar o usuário em tbl_usuario
        $sqlUsuario = "SELECT * FROM tbl_usuarios WHERE nome=?";
        $stmtUsuario = $conn->prepare($sqlUsuario);
        $stmtUsuario->execute([$username]);
     
        // Verifica se o usuário foi encontrado em tbl_cliente
        if ($stmtCliente->rowCount() === 1) {
            $user = $stmtCliente->fetch();
            return $user;
        }
        // Verifica se o usuário foi encontrado em tbl_usuario
        elseif ($stmtUsuario->rowCount() === 1) {
            $user = $stmtUsuario->fetch();
            return $user;
        }
        // Se o usuário não for encontrado em nenhuma das tabelas
        else {
            return null;
        }
     }
     
