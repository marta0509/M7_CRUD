<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$escola="";
	$aula="";
	$data="";
	$instrutor="";


	if (isset($_POST['id_escola']))
	{
		$escola=$_POST['id_escola'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento do id da escola.");</script>';
	}
	if (isset($_POST['data'])) 
	{
		$data=$_POST['data'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento da descrição.");</script>';
	}
	if (isset($_POST['instrutor'])) 
	{
		$instrutor=$_POST['instrutor'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento do instrutor.");</script>';
	}

	$con = new mysqli("localhost","root","","projeto");

	if ($con->connect_errno!=0)
	{
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}

	else
	{
		$sql='insert into aulaconducao(id_escola,data,instrutor) values(?,?,?)';
		$stm=$con->prepare($sql);
		if($stm!=false)
		{
			$stm->bind_param('iss',$escola,$data,$instrutor);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Aula adcionada com sucesso");</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:1;url=index_aulas.php");
		}
	}
}
else
{	
	$con = new mysqli("localhost","root","","projeto");

	if ($con->connect_errno!=0)
	{
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}

	else
	{
		$stm=$con->prepare('select * from escolaconducao');
		$stm->execute();
		if($stm!=false)
		{
			$res=$stm->get_result();

			$stm->close();
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
		<title>Adicionar Aulas</title>
	</head>
	<body style="background: #BFFAF7">
		<h1 style="color: darkblue">Adicionar Aulas</h1>
		<form action="create_aula.php" method="post">
			<label><b>Nome da escola</b></label>
			<!--dropdown-->
			<select name="id_escola" >
				<?php
				while ($resultado=$res->fetch_assoc())
					{

						echo '<option value="'.$resultado['id_escola'].'">'. $resultado['escola'].'</option>';
					}
				?>
			</select>
			<br>
			<label><b>Data da aula</b></label>
			<input class="form-control" type="date" name="data" required=""><br>
			<label><b>Instrutor</b></label>
			<input class="form-control" type="text" name="instrutor" required=""><br>
			<input class="btn btn-info" type="submit" name="enviar"><br>
		</form>

		<br>
		<a class="btn btn-info" href="index_aulas.php">Voltar</a>

		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
 		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  		<script type="text/javascript" src="js/slick.min.js"></script>
	</body>
	</html>

	<?php
		}
	?>