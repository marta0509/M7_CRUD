<?php
	if ($_SERVER['REQUEST_METHOD']=='POST') 
	{
		$escola="";
		$descricao="";

		if (isset($_POST['id_escola']))
		{
			$id_escola=$_POST['id_escola'];
		}
		if (isset($_POST['escola']))
		{
			$escola=$_POST['escola'];
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento do nome da escola.");</script>';
		}
		if (isset($_POST['descricao'])) 
		{
			$descricao=utf8_encode($_POST['descricao']);
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento da descrição.");</script>';
		}

		$con=new mysqli("localhost","root","","projeto");

		if ($con->connect_errno!=0) 
		{
			echo "Ocorreu um erro no acesso à base de dados. <br>".$con->connect_error;
			exit;
		}
		else
		{	
			$sql="update escolaconducao set escola=?,descricao=? where id_escola=?";
			$stm=$con->prepare($sql);

			if($stm!=false)
			{
				$stm->bind_param("ssi",$escola,$descricao,$id_escola);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Escola alterada com sucesso");</script>';
				echo "Aguarde um momento. A reencaminhar página";
				header("refresh:1;url=index_escola.php");
			}
			else
			{

			}
		}
	}
	else
	{
		echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
		header("refresh:1;url=index_escola.php");
	}