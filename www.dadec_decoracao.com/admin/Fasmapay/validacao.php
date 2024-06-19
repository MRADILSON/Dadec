<?php

require_once("fasma.php");

$recibo = validarRecibo("comprovativo","guardado/");

print_r($recibo);

//if($recibo["LOG"])
