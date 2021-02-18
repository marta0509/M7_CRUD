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
		$sql='insert into aulaconducao(aula,escola,data,instrutor) values(?,?,?,?)';
		$stm=$con->prepare($sql);
		if($stm!=false)
		{
			$stm->bind_param('iiss',$aula,$escola,$data,$instrutor);
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
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Adicionar Aulas</title>
	</head>
	<body style="background: #BFFAF7">
		<h1 style="color: darkblue">Adicionar Aulas</h1>
		<form action="create_aula.php" method="post">
			<label><b>Id da escola</b></label>
			<input class="form-control" type="text" name="id_escola" required=""><br>
			<label><b>Data da aula</b></label>
			<input class="form-control" type="date" name="data" required=""><br>
			<label><b>Instrutor</b></label>
			<input class="form-control" type="text" name="instrutor" required=""><br>
			<input type="submit" name="enviar"><br>
		</form>

	</body>
	</html>

	<?php
		}
	?>