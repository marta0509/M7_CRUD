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
		if (isset($_GET['escolaconducao'])&&is_numeric($_GET['escolaconducao'])) 
		{
			$idEscola=$_GET['escolaconducao'];
			$con=new mysqli("localhost","root","","projeto");

			if ($con->connect_errno!=0) 
			{
				echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_errnor."</h1>";
				exit();
			}	
			$sql="Select * from escolaconducao where id_escola=?";
			$stm=$con->prepare($sql);
			if ($stm!=false)
			{
				echo "<h1 style='color:darkblue'>Editar escola</h1>";
				$stm->bind_param("i",$idEscola);
				$stm->execute();
				$res=$stm->get_result();
				$escolaconducao=$res->fetch_assoc();
				$stm->close();
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				 <link href="css/bootstrap.min.css" rel="stylesheet" >
 				 <link rel="stylesheet" href="css/jumbotrom.css">
 				 <link rel="stylesheet" type="text/css" href="CSS/slick.css"/>
 				 <link rel="stylesheet" type="text/css" href="CSS/slick-theme.css"/>
				<title>Editar escola</title>

			</head>
			<body style="background: #BFFAF7">
				<form action="update_escola.php" method="post">
					<label><b>Nome da escola</b></label>
					<input class="form-control" type="text" name="escola" required value="<?php echo $escolaconducao['escola'];?>"><br>
					<label><b>Descrição</b></label>
					<input class="form-control" type="text" name="descricao" value="<?php echo utf8_decode($escolaconducao['descricao']);?>"><br>
					<input class="form-control" type="hidden" name="id_escola" value="<?php echo $escolaconducao['id_escola'];?>"><br>
					<input class="btn btn-info" type="submit" name="enviar">
				</form>


				<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
 				<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  				<script type="text/javascript" src="js/slick.min.js"></script>
			</body>
			</html>
			<?php 
				}
				else
				{
					echo('<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos será reencaminhado!</h1>');
					header("refresh:1;url=index_escola.php");
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

<a class="btn btn-info" href="index_escola.php">Voltar</a>