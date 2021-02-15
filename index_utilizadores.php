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
				<title>Utilizadores</title>

			</head>
			<body style="background: #BFFAF7">
				<h1 style="color: darkblue">Lista de Utilizadores</h1>
				<br>
				<?php
					$stm=$con->prepare('select * from utilizadores');
					$stm->execute();
					$res=$stm->get_result();
					while ($resultado=$res->fetch_assoc())
					{
						echo $resultado['nome'];
						echo '<a href="edit_utilizadores.php?utilizador='.$resultado['id_utilizador'].'">Editar';
						echo '</a>'.' ';
						echo '<a style="color:black" href="show_utilizadores.php?utilizador='.$resultado['id_utilizador'].'">Detalhes';
						echo '</a>';
						echo '<a style="color:black" href="delete_utilizadores.php?utilizador='.$resultado['id_utilizador'].'">Apagar';
						echo '</a>'.' ';
						echo'<br>';
					}
					$stm->close();
				?>
				<br>
				<a href="create_utilizadores.php">Criar um novo utilizador</a>
			<br>

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
<a href="processa_logout.php">Sair</a>
<br>
<a href="index.php">Inicio</a>