<?php
	if ($_SERVER['REQUEST_METHOD']=='POST') 
	{
		$user_name="";
		$nome="";
		$email="";
		$data_nascimento="";
		$password="";

		if (isset($_POST['id_utilizador']))
		{
			$id_utilizador=$_POST['id_utilizador'];
		}
		if (isset($_POST['user_name']))
		{
			$user_name=$_POST['user_name'];
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento do user name.");</script>';
		}
		if (isset($_POST['nome'])) 
		{
			$nome=utf8_encode($_POST['nome']);
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
		}
		if (isset($_POST['email'])) 
		{
			$email=utf8_encode($_POST['email']);
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento do email.");</script>';
		}
		if (isset($_POST['data_nascimento'])) 
		{
			$data_nascimento=utf8_encode($_POST['data_nascimento']);
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento da data de nascimento.");</script>';
		}
		if (isset($_POST['password'])) 
		{
			$password=utf8_encode($_POST['password']);
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento da password.");</script>';
		}

		$con=new mysqli("localhost","root","","projeto");

		if ($con->connect_errno!=0) 
		{
			echo "Ocorreu um erro no acesso à base de dados. <br>".$con->connect_error;
			exit;
		}
		else
		{	
			$sql="update utilizador set user_name=?,nome=?,email=?,data_nascimento=?,password=? where id_utilizador=?";
			$stm=$con->prepare($sql);

			if($stm!=false)
			{
				$stm->bind_param("sssssi",$user_name,$nome,$email,$data_nascimento,$password,$id_escola);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Utilizador alterado com sucesso");</script>';
				echo "Aguarde um momento. A reencaminhar página";
				header("refresh:1;url=index_utilizadores.php");
			}
			else
			{

			}
		}
	}
	else
	{
		echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
		header("refresh:1;url=index_utilizadores.php");
	}