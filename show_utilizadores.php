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
			<title>Detalhes</title>
		</head>
		<body style="background: #BFFAF7">
			<H1 style="color: darkblue">Detalhes do Utilizador</H1>
			<?php
				if (isset($utilizador)) {
					echo "<br>";
					echo "<b>Nome:</b>";
					echo $utilizador['nome'];
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
			<a href="index_utilizadores.php">Voltar</a>
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