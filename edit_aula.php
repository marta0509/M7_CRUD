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

			$stm=$con->prepare('select * from escolaconducao');
				$stm->execute();
				if($stm!=false)
				{
					$resescola=$stm->get_result();

					$stm->close();
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
			

		else
		{	
			$con = new mysqli("localhost","root","","projeto");

			if ($con->connect_errno!=0)
			{
				echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
				exit;
			}
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
  				 <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
				<title>Editar aula</title>

			</head>
			<body style="background: #BFFAF7">
				<form action="update_aula.php" method="post">
					<label><b>Id da escola</b></label>
					<!--dropdown-->
					<select name="id_escola" >
						<?php
						while ($resultado=$resescola->fetch_assoc())
							{

								echo '<option value="'.$resultado['id_escola'].'">'. $resultado['escola'].'</option>';
							}
						?>
					</select>
					<br>
					<label><b>Data da aula</b></label>
					<input class="form-control" type="date" name="data" required="" value="<?php echo $aulaconducao['data'];?>"><br>
					<label><b>Instrutor</b></label>
					<input class="form-control" type="text" name="instrutor" required="" value="<?php echo $aulaconducao['instrutor'];?>"><br>
					<input class="form-control" type="hidden" name="id" value="<?php echo $aulaconducao['id'];?>"><br>

					<input class="btn btn-info" type="submit" name="enviar">
				</form>


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
			}//select

			else
				{
					echo('<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos será reencaminhado!</h1>');
					header("refresh:1;url=index_aulas.php");
				}
		}//if			
	}//if do GET
}
else
{
	echo 'Para entrar nesta página necessita efetuar <br><a href="login.php">login</a>';
	header('refresh:1;url=login.php');
}
?>

<a class="btn btn-info" href="index_aulas.php">Voltar</a>