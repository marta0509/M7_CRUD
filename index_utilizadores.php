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
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="ISO-8859-1">
				<link href="css/bootstrap.min.css" rel="stylesheet" >
  				<link rel="stylesheet" href="css/jumbotrom.css">
  				<link rel="stylesheet" type="text/css" href="CSS/slick.css"/>
  				<link rel="stylesheet" type="text/css" href="CSS/slick-theme.css"/>
  				<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
				<title>Utilizadores</title>

			</head>
			<body style="background: #BFFAF7">
				<h1 style="color: darkblue">Lista de Utilizadores</h1>
				<br>
				<table class="table table-sm">
					<?php
						$stm=$con->prepare('select * from utilizadores');
						$stm->execute();
						$res=$stm->get_result();
						while ($resultado=$res->fetch_assoc())
						{
					?>
					<tr>
						<td>
							<?php
								echo utf8_decode($resultado['nome']);
							?>
						</td>
						<td>
							<?php
								echo '<a class="btn btn-info" href="edit_utilizadores.php?utilizador='.$resultado['id_utilizador'].'">Editar';
								echo '</a>'.' ';
							?>
						</td>
						<td>
							<?php
								echo '<a class="btn btn-info"  href="show_utilizadores.php?utilizador='.$resultado['id_utilizador'].'">Detalhes';
								echo '</a>'.' ';
							?>
						</td>
						<td>
							<?php
								echo '<a class="btn btn-info" href="delete_utilizadores.php?utilizador='.$resultado['id_utilizador'].'">Apagar';
								echo '</a>'.' ';
							?>
						</td>
					</tr>
					<?php
						}
						$stm->close();
					?>
				</table>
				<br>
				<a class="btn btn-info" href="create_utilizadores.php">Criar um novo utilizador</a>
			<br>


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
			}//end if -if($con->connect_errno!=0)
		
}
else
{
	echo 'Para entrar nesta página necessita efetuar <br><a href="login.php">login</a>';
	header('refresh:1;url=login.php');
}
?>
<br>
<a class="btn btn-info" href="processa_logout.php">Sair</a>

<a class="btn btn-info" href="index.php">Inicio</a>