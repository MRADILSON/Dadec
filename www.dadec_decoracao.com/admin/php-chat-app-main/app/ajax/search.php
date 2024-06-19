<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['id'])) {
    # check if the key is submitted
    if(isset($_POST['key'])){
       # database connection file
	   include '../db.conn.php';

	   # creating simple search algorithm
	   $key = "%{$_POST['key']}%";
     
	   # SQL to search in both tbl_cliente and tbl_usuario
	   $sql = "
	   SELECT 'cliente' AS user_type, id, nome, foto FROM tbl_cliente WHERE nome LIKE ?
	   UNION
	   SELECT 'usuario' AS user_type, id, nome, foto FROM tbl_usuarios WHERE nome LIKE ?";
	   
       $stmt = $conn->prepare($sql);
       $stmt->execute([$key, $key]);

       if($stmt->rowCount() > 0){ 
         $users = $stmt->fetchAll();

         foreach ($users as $user) {
         	if ($user['id'] == $_SESSION['id']) continue;
       ?>
       <li class="list-group-item">
		<a href="chat.php?user=<?=$user['nome']?>"
		   class="d-flex
		          justify-content-between
		          align-items-center p-2">
			<div class="d-flex
			            align-items-center">

			    <img src="<?php
                if ($user['user_type'] == 'cliente') {
                    echo "../upload/clientes/{$user['foto']}";
                } else {
                    echo "../upload/users/{$user['foto']}";
                }
                ?>" class="w-10 rounded-circle">

			    <h3 class="fs-xs m-2">
			    	<?=$user['nome']?>
			    </h3>            	
			</div>
		 </a>
	   </li>
       <?php } } else { ?>
         <div class="alert alert-info 
    				 text-center">
		   <i class="fa fa-user-times d-block fs-big"></i>
           The user "<?=htmlspecialchars($_POST['key'])?>"
           is not found.
		</div>
    <?php }
    }
} else {
	header("Location: ../../index.php");
	exit;
}
?>
