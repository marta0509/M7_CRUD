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
		if (isset($_GET['utilizador'])&&is_numeric($_GET['utilizador'])) 
		{
			$idUtilizador=$_GET['utilizador'];
			$con=new mysqli("localhost","root","","projeto");

			if ($con->connect_errno!=0) 
			{
				echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_errnor."</h1>";
				exit();
			}	
			$sql="Select * from utilizadores where id_utilizador=?";
			$stm=$con->prepare($sql);
			if ($stm!=false)
			{
				echo "<h1 style='color:darkblue'>Editar utilizador</h1>";
				$stm->bind_param("i",$idUtilizador);
				$stm->execute();
				$res=$stm->get_result();
				$utilizador=$res->fetch_assoc();
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
  				 <link rel="stylesheet" type="text/css" href="CSS/estilos.css">		
  				 <link rel="stylesheet" type="text/css" href="CSS/estilos.css">	 
				<title>Editar utilizador</title>

			</head>
			<body style="background: #BFFAF7">
				<form action="update_utilizadores.php" method="post">
					<label><b>Nome:</b></label>
					<input class="form-control" type="text" name="nome" required="" value="<?php echo utf8_decode($utilizador['nome']);?>"><br>
					<label><b>User Name</b></label>
					<input class="form-control" type="text" name="user_name" value="<?php echo $utilizador['user_name'];?>"><br>
					<label><b>Email</b></label>
					<input class="form-control" type="text" name="email" required="" value="<?php echo $utilizador['email'];?>"><br>
					<label><b>Data de Nascimento</b></label>
					<input class="form-control" type="date" name="data_nascimento" value="<?php echo $utilizador['data_nascimento'];?>"><br>
					<label><b>Password</b></label>
					<input class="form-control" type="password" name="password" value="<?php echo $utilizador['password'];?>"><br>
					<input type="hidden" name="id_utilizador" value="<?php echo $utilizador['id_utilizador'];?>">
					<input class="btn btn-info" type="submit" name="enviar"><br>
				</form>
				

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
				else
				{
					echo('<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos será reencaminhado!</h1>');
					header("refresh:1;url=index_utilizadores.php");
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

