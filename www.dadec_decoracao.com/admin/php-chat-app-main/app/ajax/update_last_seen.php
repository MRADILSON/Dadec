<?php  
session_start();

# check if the user is logged in
if (isset($_SESSION['id'])) {
	
	# database connection file
	include '../db.conn.php';

	# get the logged in user's id from SESSION
	$id = $_SESSION['id'];

	try {
	    # Prepare SQL queries to update last_seen in both tables
	    $sql_cliente = "UPDATE tbl_cliente SET last_seen = NOW() WHERE id = ?";
	    $sql_usuario = "UPDATE tbl_usuarios SET last_seen = NOW() WHERE id = ?";

	    # Start a transaction
	    $conn->beginTransaction();

	    # Update last_seen in tbl_cliente
	    $stmt_cliente = $conn->prepare($sql_cliente);
	    $stmt_cliente->execute([$id]);

	    # Update last_seen in tbl_usuario
	    $stmt_usuario = $conn->prepare($sql_usuario);
	    $stmt_usuario->execute([$id]);

	    # Commit the transaction
	    $conn->commit();
	    
	} catch (Exception $e) {
	    # Roll back the transaction if something failed
	    $conn->rollBack();
	    error_log($e->getMessage());
	    header("Location: ../../index.php");
	    exit;
	}
} else {
	header("Location: ../../index.php");
	exit;
}
