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
				if (!isset($_GET['utilizador']) || !is_numeric($_GET['utilizador'])) {
					echo '<script>alert("Erro ao abrir utilizador");</script>';
					echo "Aguarde um momento. A reecaminhar página";
					header("refresh:1;url=index_utilizadores.php");
					exit();		
				}	
				$idUtilizador=$_GET['utilizador'];
				$con=new mysqli("localhost","root","","projeto");

				if ($con->connect_errno!=0)
				{
					echo 'Ocorreu um erro no acesso à base de dados. <br>'.$con->connect_error;
					exit();
				}
				else
				{
					$sql='select * from utilizadores where id_utilizador=?';
					$stm =$con->prepare($sql);
					if ($stm!=false)
					{
						$stm->bind_param('i',$idUtilizador);
						$stm->execute();
						$res=$stm->get_result();
						$utilizador=$res->fetch_assoc();
						$stm->close();
					}
				else
				{
					echo "<br>";
					echo ($con->error);
					echo "<br>";
					echo "Aguarde um momento. A reencaminhar página";
					echo "<br>";
					header("refresh:1; url=index_utilizadores.php");
				}
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
			<title>Detalhes</title>
		</head>
		<body style="background: #BFFAF7">
			<H1 style="color: darkblue">Detalhes do Utilizador</H1>
			<?php
				if (isset($utilizador)) {
					echo "<br>";
					echo "<b>Nome:</b>";
					echo utf8_decode($utilizador['nome']);
					echo "<br>";
					echo "<b>User Name:</b>";
					echo ($utilizador['user_name']);
					echo "<br>";
					echo "<b>Email:</b>";
					echo ($utilizador['email']);
					echo "<br>";
					echo "<b>Data de Nascimento:</b>";
					echo ($utilizador['data_nascimento']);
					echo "<br>";
					echo "<b>Password:</b>";
					echo ($utilizador['password']);
					echo "<br>";
				}
				else
				{
					echo "<h2>Parece que a escola selecionada não existe.<br>Continue a sua seleção.</h2>";
				}
			?>
			<br>
			<a class="btn btn-info" href="index_utilizadores.php">Voltar</a>


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
		
			}//end if -if($con->connect_errno!=0)

else
{
	echo 'Para entrar nesta página necessita efetuar <br><a href="login.php">login</a>';
	header('refresh:1;url=login.php');
}
?>
<br>