<?php 

function getConversation($user_id, $conn) {
  /**
    Obtendo todas as conversas
    para o usuário atual (logado)
  **/
  $sql = "SELECT * FROM conversations
          WHERE user_1=? OR user_2=?
          ORDER BY conversation_id DESC";

  $stmt = $conn->prepare($sql);
  $stmt->execute([$user_id, $user_id]);

  if ($stmt->rowCount() > 0) {
      $conversations = $stmt->fetchAll();

      /**
        criando um array vazio para
        armazenar as conversas do usuário
      **/
      $user_data = [];
      
      # Percorrendo as conversas
      foreach ($conversations as $conversation) {
          $other_user_id = ($conversation['user_1'] == $user_id) ? $conversation['user_2'] : $conversation['user_1'];

          # Tentar buscar na tabela tbl_usuarios
          $sql2 = "SELECT * FROM tbl_usuarios WHERE id=?";
          $stmt2 = $conn->prepare($sql2);
          $stmt2->execute([$other_user_id]);
          $allConversations = $stmt2->fetchAll();

          # Se não encontrar na tabela tbl_usuarios, tentar na tabela tbl_clientes
          if (empty($allConversations)) {
              $sql2 = "SELECT * FROM tbl_cliente WHERE id=?";
              $stmt2 = $conn->prepare($sql2);
              $stmt2->execute([$other_user_id]);
              $allConversations = $stmt2->fetchAll();
          }

          # Verifica se $allConversations não está vazio
          if (!empty($allConversations)) {
              # Adicionando os dados ao array
              array_push($user_data, $allConversations[0]);
          }
      }

      return $user_data;

  } else {
      return [];
  }
}

