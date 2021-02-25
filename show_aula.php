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
				if (!isset($_GET['aulaconducao']) || !is_numeric($_GET['aulaconducao'])) {
					echo '<script>alert("Erro ao abrir Aula");</script>';
					echo "Aguarde um momento. A reecaminhar página";
					header("refresh:1;url=index_aula.php");
					exit();		
				}	
				$idAula=$_GET['aulaconducao'];
				$con=new mysqli("localhost","root","","projeto");

				if ($con->connect_errno!=0)
				{
					echo 'Ocorreu um erro no acesso à base de dados. <br>'.$con->connect_error;
					exit();
				}
				else
				{
					$sql='select * from aulaconducao where id=?';
					$stm =$con->prepare($sql);
					if ($stm!=false)
					{
						$stm->bind_param('i',$idAula);
						$stm->execute();
						$res=$stm->get_result();
						$aula=$res->fetch_assoc();
						$stm->close();
					}
				else
				{
					echo "<br>";
					echo ($con->error);
					echo "<br>";
					echo "Aguarde um momento. A reencaminhar página";
					echo "<br>";
					header("refresh:1; url=index_aula.php");
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
			<title>Detalhes</title>
		</head>
		<body style="background: #BFFAF7">
			<H1 style="color: darkblue">Detalhes da Aula</H1>
			<?php
				if (isset($aula)) {
					echo "<br>";
					echo "<b>Id da Escola:</b>";
					echo $aula['id_escola'];
					echo "<br>";
					echo "<b>Data:</b>";
					echo ($aula['data']);
					echo "<br>";
					echo "<b>Instrutor:</b>";
					echo ($aula['instrutor']);
					echo "<br>";
				}
				else
				{
					echo "<h2>Parece que a aula selecionada não existe.<br>Continue a sua seleção.</h2>";
				}
			?>
			<br>
			<a class="btn btn-info" href="index_aulas.php">Voltar</a>

			<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
 			<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  			<script type="text/javascript" src="js/slick.min.js"></script>
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