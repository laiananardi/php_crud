<?php
	
	session_start( );

	$mysqli = new mysqli('localhost', 'root','','crud') or die(mysqli_error($mysqli));

	$id = 0;
	$update = false;
	$nome = '';
	$local = '';

	if (isset($_POST['salvar'])){

		$nome =$_POST['nome'];
		$local =$_POST['local'];
		$mysqli->query("INSERT INTO data (nome, local) VALUES('$nome', '$local')") or
		die($mysqli->error);

		$_SESSION['message'] = "registro salvo";
		$_SESSION['msg_type'] = "success";

		header("location: index.php");
			
	}

	if (isset($_GET['delete'])) {
		$id = $_GET['delete'];
		$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

		$_SESSION['message'] = "registro deletado";
		$_SESSION['msg_type'] = "danger";

		header("location: index.php");
	}
	if (isset($_GET['edit'])){
		$id = $_GET['edit'];
		$update = true;
		$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
		$pkCount = (is_array($result) ? count($result) : 1);
		if ($pkCount==1){
			$row = $result->fetch_array();
			$nome = $row['nome'];
			$local = $row['local'];
				}
	}
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$local = $_POST['local'];

		$mysqli->query("UPDATE data SET nome='$nome', local='$local' WHERE id=$id") or die($mysqli->error);

		$_SESSION['message'] = "o registro foi alterado";
		$_SESSION['msg_type'] = "warning";

		header("location: index.php");

		
	}

