<?php include("include/init.php"); ?>

<?php 

	if(empty($_GET['id'])) {
		redirect_to("funcionario.php?empty");
	}

	$funcionario = Funcionario::find_by_id($_GET['id']);

	if($funcionario) {
		$session->message("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
	              <strong><i class='mdi mdi-account-alert'></i></strong> O {$funcionario->nome} está apagado.
	              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
	                <span aria-hidden=\"true\">&times;</span>
	              </button>
	            </div>");
		$funcionario->delete();
		redirect_to("funcionario.php");
	} else {
		redirect_to("funcionario.php");
	}

?>