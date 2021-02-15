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
				if (!isset($_GET['escolaconducao']) || !is_numeric($_GET['escolaconducao'])) {
					echo '<script>alert("Erro ao abrir Escola");</script>';
					echo "Aguarde um momento. A reecaminhar página";
					header("refresh:1;url=index_escola.php");
					exit();		
				}	
				$idEscola=$_GET['escolaconducao'];
				$con=new mysqli("localhost","root","","projeto");

				if ($con->connect_errno!=0)
				{
					echo 'Ocorreu um erro no acesso à base de dados. <br>'.$con->connect_error;
					exit();
				}
				else
				{
					$sql='select * from escolaconducao where id_escola=?';
					$stm =$con->prepare($sql);
					if ($stm!=false)
					{
						$stm->bind_param('i',$idEscola);
						$stm->execute();
						$res=$stm->get_result();
						$escola=$res->fetch_assoc();
						$stm->close();
					}
				else
				{
					echo "<br>";
					echo ($con->error);
					echo "<br>";
					echo "Aguarde um momento. A reencaminhar página";
					echo "<br>";
					header("refresh:1; url=index_escola.php");
				}
			}
		}
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>Detalhes</title>
		</head>
		<body style="background: #BFFAF7">
			<H1 style="color: darkblue">Detalhes da Escola</H1>
			<?php
				if (isset($escola)) {
					echo "<br>";
					echo "<b>Nome da Escola:</b>";
					echo $escola['escola'];
					echo "<br>";
					echo "<b>Descrição:</b>";
					echo ($escola['descricao']);
					echo "<br>";
				}
				else
				{
					echo "<h2>Parece que a escola selecionada não existe.<br>Continue a sua seleção.</h2>";
				}
			?>
			<br>
			<a href="index_escola.php">Voltar</a>
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