<?php
session_start();
if (!isset($_SESSION['login'])) 
{
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']== "correto" && isset($_SESSION['login']))
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
				<title>Aula</title>
			</head>
			<body style="background: #BFFAF7">
				<h1 style="color: darkblue">Lista de Aulas de Condução</h1>
				<br>
				<table class="table table-sm">
					<?php
							$stm=$con->prepare('select * from aulaconducao');
							$stm->execute();
							$res=$stm->get_result();
							while ($resultado=$res->fetch_assoc())
							{
					?>
				
					<tr>
							<td>
								<?php
									echo "Aula nº:  ";
									echo $resultado['id'].' ';
								?>							
							</td>
							<td>
								<?php
									echo '<a class="btn btn-info" href="edit_aula.php?aulaconducao='.$resultado['id'].'">Editar';
									echo '</a>'.' ';
								?>								
							</td>
							<td>
								<?php
									echo '<a class="btn btn-info" href="show_aula.php?aulaconducao='.$resultado['id'].'">Detalhes';
									echo '</a>'.' ';
								?>
							</td>
							<td>
								<?php
									echo '<a class="btn btn-info" href="delete_aula.php?aulaconducao='.$resultado['id'].'">Apagar';
									echo '</a>'.' ';						
								?>	
							</td>
					</tr>
				
					<?php
						}//end while
						$stm->close();
					?>
				</table>
				<br>
				<a class="btn btn-info" href="create_aula.php">Criar um novo registo</a>
				
			<br>

			<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  			<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  			<script type="text/javascript" src="js/slick.min.js"></script>
			</body>
			</html>
		<?php
			}//end if -if($con->connect_errno!=0)
		
}
else
{
	echo 'Para entrar nesta página necessita efetuar o login <br><a href="login.php">login</a>';
	header('refresh:1;url=login.php');
}
?>
<br>
<a class="btn btn-info" href="processa_logout.php">Sair</a>

<a class="btn btn-info" href="index.php">Inicio</a>