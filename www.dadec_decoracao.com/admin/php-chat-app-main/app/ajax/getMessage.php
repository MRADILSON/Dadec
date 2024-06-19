<?php
session_start();
//include '../include/init.php'; 

include '../db.conn.php';
include '../helpers/chat.php';
include '../helpers/timeAgo.php';

$id_1 = $_SESSION['id'];
$id_2 = $_POST['id_2'];

$chats = getChats($id_1, $id_2, $conn);

if (!empty($chats)) {
    foreach ($chats as $chat) {
        if ($chat['from_id'] == $_SESSION['id']) { ?>
            <p class="rtext align-self-end border rounded p-2 mb-1">
                <?php if (!empty($chat['message'])) { echo htmlspecialchars($chat['message']); } ?>
                <?php if (isset($chat['file_path']) && !empty($chat['file_path'])) {
                    $fileExt = pathinfo($chat['file_path'], PATHINFO_EXTENSION);
                    if (in_array($fileExt, ['jpg', 'jpeg', 'png'])) { ?>
                        <img src="uploads/<?=$chat['file_path']?>" class="img-fluid preview-image" data-src="uploads/<?=$chat['file_path']?>" onclick="showPreview(this)">
                    <?php } elseif ($fileExt === 'mp4') { ?>
                        <video controls src="uploads/<?=$chat['file_path']?>" class="img-fluid"></video>
                        <a href="uploads/<?=$chat['file_path']?>" download>Download video</a> <!-- Adicionado o atributo download -->
                    <?php } else { ?>
                        <a href="uploads/<?=$chat['file_path']?>" download>Baixar arquivo</a>
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
                        <img src="uploads/<?=$chat['file_path']?>" class="img-fluid preview-image" data-src="uploads/<?=$chat['file_path']?>" onclick="showPreview(this)">
                    <?php } elseif ($fileExt === 'mp4') { ?>
                        <video controls src="uploads/<?=$chat['file_path']?>" class="img-fluid"></video>
                        <a href="uploads/<?=$chat['file_path']?>" download>Download video</a> <!-- Adicionado o atributo download -->
                    <?php } else { ?>
                        <a href="uploads/<?=$chat['file_path']?>" download>Baixar arquivo</a>
                    <?php }
                } ?>
                <small class="d-block"><?=$chat['created_at']?></small>
            </p>
        <?php }
    }
} else { ?>
    <div class="alert alert-info text-center">
        <i class="fa fa-comments d-block fs-big"></i>
        Sem conversas ainda, inicia uma conversa
    </div>
<?php } ?>

<script>
function showPreview(element) {
    var imgSrc = element.getAttribute('data-src');
    var modal = document.createElement('div');
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    modal.style.display = 'flex';
    modal.style.justifyContent = 'center';
    modal.style.alignItems = 'center';
    modal.style.zIndex = '9999';
    
    var img = document.createElement('img');
    img.src = imgSrc;
    img.style.maxWidth = '80%';
    img.style.maxHeight = '80%';
    img.style.borderRadius = '10px';

    img.onclick = function() {
        modal.remove();
    };

    modal.appendChild(img);
    document.body.appendChild(modal);
}
</script>
