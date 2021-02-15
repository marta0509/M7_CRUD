<?php
session_start();
if (!isset($_SESSION['login'])) 
{
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&&isset($_SESSION['login']))
{
		$con=new mysqli("localhost","root","","projeto");
		if($con->connect_errno!=0)
		{
			echo "Ocorreu um erro no acesso à base de dados".$con->connect_error;
			exit;
		}
		else
		{
	?>
			<?php
	if ($_SERVER['REQUEST_METHOD']=="GET")
	{
		if (isset($_GET['utilizador'])&&is_numeric($_GET['utilizador'])) 
		{
			$idUtilizador=$_GET['utilizador'];
			$con=new mysqli("localhost","root","","projeto");

			if ($con->connect_errno!=0) 
			{
				echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_errnor."</h1>";
				exit();
			}	
			$sql="Select * from utilizadores where id_utilizador=?";
			$stm=$con->prepare($sql);
			if ($stm!=false)
			{
				echo "<h1 style='color:darkblue'>Editar utilizador</h1>";
				$stm->bind_param("i",$idUtilizador);
				$stm->execute();
				$res=$stm->get_result();
				$utilizador=$res->fetch_assoc();
				$stm->close();
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<title>Editar utilizador</title>

			</head>
			<body style="background: #BFFAF7">
				<form action="update_utilizadores.php" method="post">
					<label><b>Nome:</b></label>
					<input class="form-control" type="text" name="nome" required=""><br>
					<label><b>User Name</b></label>
					<input class="form-control" type="text" name="user_name"><br>
					<label><b>Email</b></label>
					<input class="form-control" type="text" name="email" required=""><br>
					<label><b>Data de Nascimento</b></label>
					<input class="form-control" type="date" name="data_nascimento"><br>
					<label><b>Password</b></label>
					<input class="form-control" type="text" name="password"><br>
					<input type="submit" name="enviar"><br>
				</form>
			</body>
			</html>
			<?php 
				}
				else
				{
					echo('<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos será reencaminhado!</h1>');
					header("refresh:1;url=index_utilizadores.php");
				}
		}
		
			}//end if -if($con->connect_errno!=0)
		
}
else
{
	echo 'Para entrar nesta página necessita efetuar <br><a href="login.php">login</a>';
	header('refresh:1;url=login.php');
}
?>
<br>
<a href="processa_logout.php">Sair</a>