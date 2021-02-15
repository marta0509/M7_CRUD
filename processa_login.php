<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD']=="POST") 
	{
		if (isset($_POST['user_name'])&&($_POST['password'])&&($_POST['email'])) 
		{
			$utilizador=$_POST['user_name'];
			$password=$_POST['password'];
			$email=$_POST['email'];


			$con= new mysqli("localhost","root","","projeto");

			if ($con->connect_errno!=0)
			{
				echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_errno;
				exit;
			}
			else
			{
				$sql="Select * from utilizadores where user_name=? and email=?";
				$stm=$con->prepare($sql);
				if ($stm!=false) 
				{
					$stm->bind_param("ss",$utilizador,$email);
					$stm->execute();
					$res=$stm->get_result();
					if ($res->num_rows==1)
					{
						//echo login com sucesso
						$_SESSION['login']="correto";
						$user=$res->fetch_assoc();
						$_SESSION['utilizador']=$user['id_utilizador'];
						/*$passencrip=password_verify($password,$user['password']);
						
						if ($passencrip!=true) 
						{
							$_SESSION['login']="incorreto";
						}*/
					}
					else
					{
						//echo logim incorreto
						$_SESSION['login']="incorreto";
						echo "Login incorreto";
						header("refresh:1;url=index.php");
					}
					header("refresh:1;url=index.php");
				}
				else
				{
					echo "Ocorreu um erro no acesso à base de dados.<br>STM;".$con->connect_errno;
				}
			}
		}
	}