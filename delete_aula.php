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
				if (isset($_GET['aulaconducao'])&&is_numeric($_GET['aulaconducao'])) 
				{
					$idAula=$_GET['aulaconducao'];
					$con=new mysqli("localhost","root","","projeto");

					if ($con->connect_errno!=0) 
					{
						echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_errnor."</h1>";
						exit();
					}	
					$sql="delete from aulaconducao where id=?";
					$stm=$con->prepare($sql);
					if ($stm!=false)
					{
						$stm->bind_param('i',$idAula);
						$stm->execute();
						$stm->close();
						echo '<script>alert("Aula eliminada com sucesso");</script>';
						echo "Aguarde um momento. A reencaminhar página";
						header("refresh:1;url=index_aulas.php");
					}
					
				}
			}	
		?>


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