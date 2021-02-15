<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$escola="";
	$descricao="";

	if (isset($_POST['escola']))
	{
		$escola=$_POST['escola'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento o nome da escola.");</script>';
	}
	if (isset($_POST['descricao'])) 
	{
		$descricao=utf8_decode($_POST['descricao']);
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento da descrição.");</script>';
	}

	$con = new mysqli("localhost","root","","projeto");

	if ($con->connect_errno!=0)
	{
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}

	else
	{
		$sql='insert into escolaconducao(escola,descricao) values(?,?)';
		$stm=$con->prepare($sql);
		if($stm!=false)
		{
			$stm->bind_param('ss',$escola,$descricao);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Escola adcionada com sucesso");</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:1;url=index_escola.php");
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
		<title>Adicionar Escolas</title>
	</head>
	<body style="background: #BFFAF7">
		<h1 style="color: darkblue">Adicionar Escolas</h1>
		<form action="create_escola.php" method="post">
			<label><b>Nome da escola</b></label>
			<input class="form-control" type="text" name="escola" required=""><br>
			<label><b>Descrição</b></label>
			<input class="form-control" type="text" name="descricao" required=""><br>
			<input type="submit" name="enviar"><br>
		</form>

	</body>
	</html>

	<?php
		}
	?>