<?php
	if ($_SERVER['REQUEST_METHOD']=='POST') 
	{	
		$aula="";
		$escola="";
		$data="";
		$instrutor="";

		if (isset($_POST['id']))
		{
			$aula=$_POST['id'];
		}
		if (isset($_POST['id_escola']))
		{
			$escola=$_POST['id_escola'];
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento do id escola.");</script>';
		}
		if (isset($_POST['data'])) 
		{
			$data=($_POST['data']);
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento da data.");</script>';
		}
		if (isset($_POST['instrutor'])) 
		{
			$instrutor=($_POST['instrutor']);
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento do instrutor.");</script>';
		}

		$con=new mysqli("localhost","root","","projeto");

		if ($con->connect_errno!=0) 
		{
			echo "Ocorreu um erro no acesso à base de dados. <br>".$con->connect_error;
			exit;
		}
		else
		{	
			$sql="update aulaconducao set id_escola=?,data=?,instrutor=? where id=?";
			$stm=$con->prepare($sql);

			if($stm!=false)
			{
				$stm->bind_param("sssi",$escola,$data,$instrutor,$aula);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Aula alterada com sucesso");</script>';
				echo "Aguarde um momento. A reencaminhar página";
				header("refresh:1;url=index_aulas.php");
			}
			else
			{

			}
		}
	}
	else
	{
		echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
		header("refresh:1;url=index_aula.php");
	}