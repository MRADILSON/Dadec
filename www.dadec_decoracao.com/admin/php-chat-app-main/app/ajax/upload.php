<?php
session_start();
include '../db.conn.php';

if ((isset($_FILES['file']) && isset($_POST['to_id'])) || (isset($_POST['message']) && isset($_POST['to_id']))) {
    $to_id = $_POST['to_id'];
    $from_id = $_SESSION['id'];
    $message = isset($_POST['message']) ? $_POST['message'] : null;
    $file_path = null;

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'mp4', 'mp3');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 10000000) { // Limite de 10MB
                    $fileNewName = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../../uploads/' . $fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $file_path = $fileNewName;
                } else {
                    echo "Your file is too big!";
                    exit();
                }
            } else {
                echo "There was an error uploading your file!";
                exit();
            }
        } else {
            echo "You cannot upload files of this type!";
            exit();
        }
    }

    $sql = "INSERT INTO chats (from_id, to_id, message, file_path) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$from_id, $to_id, $message, $file_path]);

     # if the message inserted
     if ($res) {
    	/**
       check if this is the first
       conversation between them
       **/
       $sql2 = "SELECT * FROM conversations
               WHERE (user_1=? AND user_2=?)
               OR    (user_2=? AND user_1=?)";
       $stmt2 = $conn->prepare($sql2);
	   $stmt2->execute([$from_id, $to_id, $from_id, $to_id]);

	    // setting up the time Zone
		// It Depends on your location or your P.c settings
		define('TIMEZONE', 'Africa/Luanda');
		date_default_timezone_set(TIMEZONE);

		$time = date("h:i:s a");

		if ($stmt2->rowCount() == 0 ) {
			# insert them into conversations table 
			$sql3 = "INSERT INTO 
			         conversations(user_1, user_2)
			         VALUES (?,?)";
			$stmt3 = $conn->prepare($sql3); 
			$stmt3->execute([$from_id, $to_id]);
		}
		?>

		<p class="rtext align-self-end
		          border rounded p-2 mb-1">
		    <?=$message?>  
		    <small class="d-block"><?=$time?></small>      	
		</p>

    <?php 
     }
  


    
    echo "Message sent!";
} else {
    echo "Error: Invalid request!";
}
?>
