<?php include("include/init.php"); ?>

<?php 

	if(empty($_GET['id'])) {
		redirect_to("cliente1.php?emptyId");
	}

	$cliente = Cliente::find_by_id($_GET['id']);

	if($cliente) {
		$session->message("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
	              <strong><i class='mdi mdi-account-alert'></i></strong> O {$cliente->nome} está apagado.
	              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
	                <span aria-hidden=\"true\">&times;</span>
	              </button>
	            </div>");
		$cliente->delete();
		redirect_to("cliente1.php");
	} else {
		redirect_to("cliente1.php");
	}

?>