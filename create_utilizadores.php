<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$nome="";
	$user_name="";
	$email="";
	$data_nascimento="";
	$password="";

	if (isset($_POST['nome']))
	{
		$nome=$_POST['nome'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if (isset($_POST['user_name'])) 
	{
		$user_name=utf8_decode($_POST['user_name']);
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento do user.");</script>';
	}
	if (isset($_POST['email']))
	{
		$email=$_POST['email'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento do email.");</script>';
	}
	if (isset($_POST['data_nascimento']))
	{
		$data_nascimento=$_POST['data_nascimento'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento da data de nascimento.");</script>';
	}
	if(isset($_POST['password']))
	{
		$passsword=$_POST['password'];
		$passencriptada=password_hash($password, PASSWORD_DEFAULT);
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento da password.");</script>';
	}
	

	$con = new mysqli("localhost","root","","projeto");

	if ($con->connect_errno!=0)
	{
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}

	else
	{
		$sql='insert into utilizadores(nome,user_name,email,data_nascimento,password) values(?,?,?,?,?)';
		$stm=$con->prepare($sql);
		if($stm!=false)
		{
			$stm->bind_param('sssss',$nome,$user_name,$email,$data_nascimento,$passencriptada);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Utilizador adcionado com sucesso");</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:1;url=index_utilizadores.php");
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
		<title>Adicionar Utilizadores</title>
		<link href="CSS/bootstrap.min.css" rel="stylesheet" >
		<link rel="stylesheet" href="CSS/jumbotrom.css">
		<link rel="stylesheet" href="CSS/all.min.css">
		<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	</head>
	<body style="background: #BFFAF7">
		<h1 style="color: darkblue">Adicionar utilizador</h1>
		<form action="create_utilizadores.php" method="post">
			<label><b>Nome</b></label>
			<input class="form-control" type="text" name="nome" required=""><br>
			<label><b>User Name</b></label>
			<input class="form-control" type="text" name="user_name"><br>
			<label><b>Email</b></label>
			<input class="form-control" type="text" name="email"><br>
			<label><b>Data de Nascimento</b></label>
			<input class="form-control" type="date" name="data_nascimento"><br>
			<label><b>Password</b></label>
			<input class="form-control" type="password" name="password"><br>
			<input class="btn btn-info" type="submit" name="enviar"><br>
		</form>

		<br>
		<a class="btn btn-info" href="index_utilizadores.php">Voltar</a>

		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
 		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
 		<script src="JS/jquery-3.5.1.min.js"></script>
		<script src="JS/bootstrap.min.js"></script>
		<script src="JS/all.min.js"></script>
  		<script type="text/javascript" src="JS/slick.min.js"></script>
  		<script type="text/javascript" src="JS/estilos.js"></script>
	</html>

	<?php
		}
	?>