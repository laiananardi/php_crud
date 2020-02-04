<!DOCTYPE html>
<html>
<head>
	<title>PHP CRUD</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<?php require_once 'processo.php'; ?>

	<?php

	if (isset($_SESSION['message'])):?>

	<div class="alert alert-<?=$_SESSION['msg_type']?>">

		<?php  
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		?>
	</div>

	<?php endif ?>

	<div class="container" >

	<?php
		$mysqli = new mysqli('localhost', 'root','','crud') or die(mysqli_error($mysqli));
		$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
		//pre_r($result);
		//pre_r($result->fetch_assoc());
	?>
		<div class="row justify-content-center">
			<table class="table">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Cidade</th>
						<th colspan="2">Ação</th>
					</tr>
				</thead>
	<?php
		while ($row = $result->fetch_assoc()): ?>
		<tr>
			<td><?php echo $row['nome']; ?></td>
			<td><?php echo $row['local']; ?></td>
			<td>
				<a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info"> Editar</a>
				<a href="processo.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Deletar</a>
			</td>
		</tr>
	<?php endwhile; ?>
		</table>
	</div>

	<?php
		 function pre_r($array){
		 	echo '<pre>';
		 	print_r($array);
		 	echo '</pre>';
		 }

	?>
	<div class="row justify-content-center">
		<form action="processo.php" method="POST"> 
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<div class="form-group">
				<label>Nome</label>
				<input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>" placeholder="Seu nome">
			</div>
			<div class="form-group">
				<label>Cidade</label>
				<input type="text" name="local" class="form-control" value="<?php echo $local; ?>" placeholder="Sua Cidade">
			</div>
			<div class="form-group">
				<?php 
				if ($update == true):
				?>
				<button type="submit" name="update" class="btn btn-info">gravar</button>
				<?php else: ?>
				<button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
			<?php endif; ?>
			</div>
		</form>
	</div>
	</div>
</body>
</html>