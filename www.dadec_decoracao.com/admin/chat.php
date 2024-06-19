
<?php include 'include/init.php'; ?>
<?php $cliente_profile = Users::find_by_id($_SESSION['id']); ?>
<?php
 if (!isset($_SESSION['id'])) {
    redirect_to("../");
}

function sendMessage($sender_id, $receiver_id, $message, $image) {
    global $database;
    $stmt = $database->prepare("INSERT INTO messages (sender_id, receiver_id, message, image) VALUES (:sender_id, :receiver_id, :message, :image)");
    $stmt->bindParam(':sender_id', $sender_id);
    $stmt->bindParam(':receiver_id', $receiver_id);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':image', $image);
    return $stmt->execute();
}

function getMessages($user_id, $contact_id) {
    global $database;
    $stmt = $database->prepare("SELECT * FROM messages WHERE (sender_id = :user_id AND receiver_id = :contact_id) OR (sender_id = :contact_id AND receiver_id = :user_id) ORDER BY timestamp ASC");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':contact_id', $contact_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
    <style>
        #chat-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            
        }
        #messages {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .message {
            margin-bottom: 10px;
            padding: 5px;
            border-bottom: 1px solid #eee;
        }
        .message img {
            max-width: 100px;
            display: block;
        }
        #message-form {
            display: flex;
        }
        #message-input {
            flex: 1;
            padding: 10px;
            margin-right: 10px;
        }
        #send-button {
            padding: 10px;
        }
    </style>
</head>
<body>
<?php include_once 'include/sidebar.php'; ?>
    <div id="chat-container" class="container mt-4">
        <div id="messages" class="card"></div>
        <form id="message-form" class="input-group">
            <input type="text" id="message-input" class="form-control" placeholder="Type a message" required>
            <div class="input-group-append">
                <input type="file" id="image-input" class="form-control-file">
                <button id="send-button" class="btn btn-primary" type="submit"><i class="material-icons">send</i></button>
            </div>
        </form>
    </div>

    <script>
        const userId = <?php echo $_SESSION['user_id']; ?>;
        const contactId = /* Contact ID here */;
        const conn = new WebSocket('ws://localhost:8080');

        document.getElementById('message-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const messageInput = document.getElementById('message-input');
            const imageInput = document.getElementById('image-input');
            const formData = new FormData();
            formData.append('message', messageInput.value);
            formData.append('receiver_id', contactId);
            if (imageInput.files.length > 0) {
                formData.append('image', imageInput.files[0]);
            }

            fetch('send_message.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text()).then(data => {
                console.log(data);
                messageInput.value = '';
                imageInput.value = '';
            });

            const messageData = {
                sender_id: userId,
                receiver_id: contactId,
                message: messageInput.value,
                image: imageInput.files.length > 0 ? URL.createObjectURL(imageInput.files[0]) : null,
                timestamp: new Date().toISOString()
            };

            conn.send(JSON.stringify(messageData));
            addMessageToChat(messageData);
        });

        conn.onmessage = function(event) {
            const messageData = JSON.parse(event.data);
            addMessageToChat(messageData);
        };

        function addMessageToChat(messageData) {
            const messagesContainer = document.getElementById('messages');
            const messageElement = document.createElement('div');
            messageElement.classList.add('message');
            messageElement.innerHTML = `
                <p>${messageData.message}</p>
                ${messageData.image ? `<img src="${messageData.image}" alt="Image">` : ''}
                <small>${new Date(messageData.timestamp).toLocaleString()}</small>
            `;
            messagesContainer.appendChild(messageElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function loadMessages() {
            fetch(`get_messages.php?contact_id=${contactId}`)
                .then(response => response.json())
                .then(messages => {
                    const messagesContainer = document.getElementById('messages');
                    messagesContainer.innerHTML = '';
                    messages.forEach(message => addMessageToChat(message));
                });
        }

        loadMessages();
    </script>
</body>
</html>

