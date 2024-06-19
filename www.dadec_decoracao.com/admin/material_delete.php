<?php include("include/init.php"); ?>

<?php 

	if(empty($_GET['id'])) {
		redirect_to("material.php?emptyId");
	}

	$material = Material::find_by_id_material($_GET['id']);

	if($material) {
		$session->message("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
	              <strong><i class='mdi mdi-account-alert'></i></strong> O {$material->nome} está apagado.
	              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
	                <span aria-hidden=\"true\">&times;</span>
	              </button>
	            </div>");
		$material->delete();
		redirect_to("material.php");
	} else {
		redirect_to("material.php");
	}

?>