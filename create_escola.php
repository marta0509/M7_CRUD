<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$escola="";
	$descricao="";

	if (isset($_POST['escola']))
	{
		$escola=$_POST['escola'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento o nome da escola.");</script>';
	}
	if (isset($_POST['descricao'])) 
	{
		$descricao=utf8_decode($_POST['descricao']);
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento da descrição.");</script>';
	}

	$con = new mysqli("localhost","root","","projeto");

	if ($con->connect_errno!=0)
	{
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}

	else
	{
		$sql='insert into escolaconducao(escola,descricao) values(?,?)';
		$stm=$con->prepare($sql);
		if($stm!=false)
		{
			$stm->bind_param('ss',$escola,$descricao);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Escola adcionada com sucesso");</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:1;url=index_escola.php");
		}
	}
}
else
{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		  <link href="css/bootstrap.min.css" rel="stylesheet" >
		  <link rel="stylesheet" href="css/jumbotrom.css">
		  <link rel="stylesheet" type="text/css" href="CSS/slick.css"/>
		  <link rel="stylesheet" type="text/css" href="CSS/slick-theme.css"/>
		  <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
		<title>Adicionar Escolas</title>
	</head>
	<body style="background: #BFFAF7">
		<h1 style="color: darkblue">Adicionar Escolas</h1>
		<form action="create_escola.php" method="post">
			<label><b>Nome da escola</b></label>
			<input class="form-control" type="text" name="escola" required=""><br>
			<label><b>Descrição</b></label>
			<input class="form-control" type="text" name="descricao" required=""><br>
			<input class="btn btn-info" type="submit" name="enviar"><br>
		</form>

		<br>
		<a class="btn btn-info" href="index_escola.php">Voltar</a>

		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
 		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
 		<script src="JS/jquery-3.5.1.min.js"></script>
		<script src="JS/bootstrap.min.js"></script>
		<script src="JS/all.min.js"></script>
  		<script type="text/javascript" src="JS/slick.min.js"></script>
  		<script type="text/javascript" src="JS/estilos.js"></script>
	</body>
	</html>

	<?php
		}
	?>