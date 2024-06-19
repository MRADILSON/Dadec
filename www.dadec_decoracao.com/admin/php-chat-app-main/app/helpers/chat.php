<?php 

function getChats($user_id, $chatWith, $conn) {
    $sql = "SELECT * FROM chats
            WHERE (from_id = ? AND to_id = ?)
            OR    (from_id = ? AND to_id = ?)
            ORDER BY created_at ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $chatWith, $chatWith, $user_id]);
    $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $chats;
}
