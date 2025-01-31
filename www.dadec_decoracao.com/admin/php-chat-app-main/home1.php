
<?php 
  include '../include/init.php'; 

	   if (!isset($_SESSION['id'])) {
		   redirect_to("../");
	   }

	   $users_profile = Users::find_by_id($_SESSION['id']);

// Se o usuário não for encontrado, cria uma outra variável para acessar
		if (!$users_profile) {
    	// Define a variável alternativa, aqui pode ser qualquer lógica ou valor
    	$users_profile = Cliente::find_by_id($_SESSION['id']);
	}

  	# database connection file
  	include 'app/db.conn.php';

  	include 'app/helpers/user.php';
  	include 'app/helpers/conversations.php';
    include 'app/helpers/timeAgo.php';
    include 'app/helpers/last_chat.php';

  	# Getting User data data
  	$user = getUser($users_profile->nome, $conn);

  	# Getting User conversations
  	$conversations = getConversation($users_profile->id, $conn);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat App - Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" 
	      href="css/style.css">
	<link rel="icon" href="img/logo.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
    <div class="p-2 w-400
                rounded shadow">
    	<div>
    		<div class="d-flex
    		            mb-3 p-3 bg-light
			            justify-content-between
			            align-items-center">
    			<div class="d-flex
    			            align-items-center">
    			    <img src="../<?= $users_profile->profile_picture_picture(); ?>"
    			         class="w-25 rounded-circle">
                    <h3 class="fs-xs m-2"><?=$user['nome']; ?></h3> 
    			</div>
    			<a href="../client_profile.php"
    			   class="btn btn-dark">Sair</a>
    		</div>

    		<div class="input-group mb-3">
    			<input type="text"
    			       placeholder="Procurar..."
    			       id="searchText"
    			       class="form-control">
    			<button class="btn btn-primary" 
    			        id="serachBtn">
    			        <i class="fa fa-search"></i>	
    			</button>       
    		</div>
    		<ul id="chatList"
    		    class="list-group mvh-50 overflow-auto">
    			<?php if (!empty($conversations)) { ?>
    			    <?php 

    			    foreach ($conversations as $conversation){ ?>
	    			<li class="list-group-item">
	    				<a href="chat1.php?user=<?=$conversation['nome']?>"
	    				   class="d-flex
	    				          justify-content-between
	    				          align-items-center p-2">
	    					<div class="d-flex
	    					            align-items-center">
										<?php
							// Caminho padrão da imagem de usuário
							$imagem_caminho = "../upload/users/" . $conversation['foto'];

							// Caminho alternativo caso a imagem não seja encontrada
							$imagem_alternativa = "../upload/clientes/".$conversation['foto'];

							// Verifica se a imagem existe
							if (!file_exists($imagem_caminho)) {
 						   $imagem_caminho = $imagem_alternativa;
							}
							?>
	    					    <img src="<?= $imagem_caminho; ?>" class="w-10 rounded-circle">

	    					    <h3 class="fs-xs m-2">
	    					    	<?=$conversation['nome']?><br>
                      <small>
                        <?php 
                          echo lastChat($_SESSION['id'], $conversation['id'], $conn);
                        ?>
                      </small>
	    					    </h3>    
								    	
	    					</div>
	    					<?php if (last_seen($conversation['last_seen']) == "Active") { ?>
		    					<div title="online">
		    						<div class="online"></div>
		    					</div>
	    					<?php } ?>
	    				</a>
	    			</li>
    			    <?php } ?>
    			<?php }else{ ?>
    				<div class="alert alert-info 
    				            text-center">
					   <i class="fa fa-comments d-block fs-big"></i>
                       Sem mensagens ainda, comece a conversa
					</div>
    			<?php } ?>
    		</ul>
    	</div>
    </div>
	  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	$(document).ready(function(){
      
      // Search
       $("#searchText").on("input", function(){
       	 var searchText = $(this).val();
         if(searchText == "") return;
         $.post('app/ajax/search1.php', 
         	     {
         	     	key: searchText
         	     },
         	   function(data, status){
                  $("#chatList").html(data);
         	   });
       });

       // Search using the button
       $("#serachBtn").on("click", function(){
       	 var searchText = $("#searchText").val();
         if(searchText == "") return;
         $.post('app/ajax/search1.php', 
         	     {
         	     	key: searchText
         	     },
         	   function(data, status){
                  $("#chatList").html(data);
         	   });
       });


      /** 
      auto update last seen 
      for logged in user
      **/
      let lastSeenUpdate = function(){
      	$.get("app/ajax/update_last_seen.php");
      }
      lastSeenUpdate();
      /** 
      auto update last seen 
      every 10 sec
      **/
      setInterval(lastSeenUpdate, 10000);

    });
</script>
</body>
</html>
