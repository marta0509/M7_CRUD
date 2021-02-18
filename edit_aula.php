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
		if (isset($_GET['aulaconducao'])&&is_numeric($_GET['aulaconducao'])) 
		{
			$idAula=$_GET['aulaconducao'];
			$con=new mysqli("localhost","root","","projeto");

			if ($con->connect_errno!=0) 
			{
				echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_errnor."</h1>";
				exit();
			}	
			$sql="Select * from aulaconducao where id=?";
			$stm=$con->prepare($sql);
			if ($stm!=false)
			{
				echo "<h1 style='color:darkblue'>Editar Aula</h1>";
				$stm->bind_param("i",$idAula);
				$stm->execute();
				$res=$stm->get_result();
				$aulaconducao=$res->fetch_assoc();
				$stm->close();
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<title>Editar aula</title>

			</head>
			<body style="background: #BFFAF7">
				<form action="update_aula.php" method="post">
					<label><b>Id da escola</b></label>
					<input class="form-control" type="text" name="id_escola" required="" value="<?php echo $aulaconducao['id_escola'];?>"><br>
					<label><b>Data da aula</b></label>
					<input class="form-control" type="date" name="data" required="" value="<?php echo $aulaconducao['data'];?>"><br>
					<label><b>Instrutor</b></label>
					<input class="form-control" type="text" name="instrutor" required="" value="<?php echo $aulaconducao['instrutor'];?>"><br>
					<input class="form-control" type="hidden" name="id" value="<?php echo $aulaconducao['id'];?>"><br>

					<input type="submit" name="enviar"><br>
				</form>
			</body>
			</html>
			<?php 
				}
				else
				{
					echo('<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos será reencaminhado!</h1>');
					header("refresh:1;url=index_aulas.php");
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