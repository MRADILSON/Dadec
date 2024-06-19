<?php

include '../include/init.php'; 

if (!isset($_SESSION['id'])) {
    redirect_to("../../");
}

if (isset($_SESSION['id'])) {
    include 'app/db.conn.php';
    include 'app/helpers/user.php';
    include 'app/helpers/chat.php';
    include 'app/helpers/opened.php';
    include 'app/helpers/timeAgo.php';

    if (!isset($_GET['user'])) {
        header("Location: home.php");
        exit;
    }

    $chatWith = getUser($_GET['user'], $conn);

    if (empty($chatWith)) {
        header("Location: home.php");
        exit;
    }

    $chats = getChats($_SESSION['id'], $chatWith['id'], $conn);

    opened($chatWith['id'], $conn, $chats);
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="w-400 shadow p-4 rounded">
        <a href="home1.php" class="fs-4 link-dark">&#8592;</a>

        <div class="d-flex align-items-center">
        <?php
							// Caminho padrão da imagem de usuário
							$imagem_caminho = "../upload/users/" . $chatWith['foto'];

							// Caminho alternativo caso a imagem não seja encontrada
							$imagem_alternativa = "../upload/clientes/".$chatWith['foto'];

							// Verifica se a imagem existe
							if (!file_exists($imagem_caminho)) {
 						   $imagem_caminho = $imagem_alternativa;
							}
							?>
           <img src="<?= $imagem_caminho; ?>" class="w-15 rounded-circle">

            <h3 class="display-4 fs-sm m-2">
                <?=$chatWith['nome']?><br>
                <div class="d-flex align-items-center" title="online">
                    <?php if (last_seen($chatWith['last_seen']) == "Active") { ?>
                        <div class="online"></div>
                        <small class="d-block p-1">Online</small>
                    <?php } else { ?>
                        <small class="d-block p-1">
                            Last seen: <?=last_seen($chatWith['last_seen'])?>
                        </small>
                    <?php } ?>
                </div>
            </h3>
        </div>

        <div class="shadow p-4 rounded d-flex flex-column mt-2 chat-box" id="chatBox">
            <?php
            if (!empty($chats)) {
                foreach ($chats as $chat) {
                    if ($chat['from_id'] == $_SESSION['id']) { ?>
                        <p class="rtext align-self-end border rounded p-2 mb-1">
                            <?php if (!empty($chat['message'])) { echo htmlspecialchars($chat['message']); } ?>
                            <?php if (isset($chat['file_path']) && !empty($chat['file_path'])) {
                                $fileExt = pathinfo($chat['file_path'], PATHINFO_EXTENSION);
                                if (in_array($fileExt, ['jpg', 'jpeg', 'png'])) { ?>
                                    <img src="uploads/<?=$chat['file_path']?>" class="img-fluid">
                                <?php } elseif (in_array($fileExt, ['mp4'])) { ?>
                                    <video controls src="uploads/<?=$chat['file_path']?>" class="img-fluid"></video>
                                <?php } else { ?>
                                    <a href="uploads/<?=$chat['file_path']?>" download>Baixar</a>
                                <?php }
                            } ?>
                            <small class="d-block"><?=$chat['created_at']?></small>
                        </p>
                    <?php } else { ?>
                        <p class="ltext border rounded p-2 mb-1">
                            <?php if (!empty($chat['message'])) { echo htmlspecialchars($chat['message']); } ?>
                            <?php if (isset($chat['file_path']) && !empty($chat['file_path'])) {
                                $fileExt = pathinfo($chat['file_path'], PATHINFO_EXTENSION);
                                if (in_array($fileExt, ['jpg', 'jpeg', 'png'])) { ?>
                                    <img src="uploads/<?=$chat['file_path']?>" class="img-fluid">
                                <?php } elseif (in_array($fileExt, ['mp4'])) { ?>
                                    <video controls src="uploads/<?=$chat['file_path']?>" class="img-fluid"></video>
                                <?php } else { ?>
                                    <a href="uploads/<?=$chat['file_path']?>" download>Baixar</a>
                                <?php }
                            } ?>
                            <small class="d-block"><?=$chat['created_at']?></small>
                        </p>
                    <?php }
                }
            } else { ?>
                <div class="alert alert-info text-center">
                    <i class="fa fa-comments d-block fs-big"></i>
                        Sem mensagens ainda, Comece a conversa
                </div>
            <?php } ?>
        </div>

        <div class="input-group mb-3">
    <textarea cols="3" id="message" class="form-control"></textarea>
    <!-- Ícone para seleção de arquivo -->
    <label for="file" class="input-group-text">
        <i class="fa fa-paperclip"></i>
    </label>
    <!-- Campo de entrada de arquivo oculto -->
    <input type="file" id="file" class="form-control" style="display: none;">
    <button class="btn btn-primary" id="sendBtn">
        <i class="fa fa-paper-plane"></i>
    </button>
</div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#sendBtn").on('click', function() {
                var message = $("#message").val();
                var file = $('#file')[0].files[0];
                var formData = new FormData();

                if (message !== "") {
                    formData.append('message', message);
                }
                if (file) {
                    formData.append('file', file);
                }
                formData.append('to_id', <?=$chatWith['id']?>);

                if (message !== "" || file) {
                    $.ajax({
                        url: "app/ajax/upload.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $("#message").val("");
                            $("#file").val("");
                            fetchData(); // Atualiza a caixa de chat após enviar a mensagem
                        },
                        error: function(data) {
                            alert("There was an error uploading your file!");
                        }
                    });
                }
            });

            var scrollDown = function() {
                let chatBox = document.getElementById('chatBox');
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            scrollDown();

            let lastSeenUpdate = function() {
                $.get("app/ajax/update_last_seen.php");
            }
            lastSeenUpdate();
            setInterval(lastSeenUpdate, 5000);

            let fetchData = function() {
                $.post("app/ajax/getMessage.php", {
                    id_2: <?=$chatWith['id']?>
                }, function(data, status) {
                    $("#chatBox").html(data);
                    if (data !== "") scrollDown();
                });
            }
            fetchData();
            setInterval(fetchData, 1000);
        });
    </script>
</body>
</html>
<?php
} else {
    header("Location: ../../index.php");
    exit;
}
?>
