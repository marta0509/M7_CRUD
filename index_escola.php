<?php
session_start();
if (!isset($_SESSION['login'])) 
{
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']== "correto" && isset($_SESSION['login']))
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
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="ISO-8859-1">
				<link href="css/bootstrap.min.css" rel="stylesheet" >
  				<link rel="stylesheet" href="css/jumbotrom.css">
 				<link rel="stylesheet" type="text/css" href="CSS/slick.css"/>
  				<link rel="stylesheet" type="text/css" href="CSS/slick-theme.css"/>
  				<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
				<title>Escola</title>
			</head>
			<body style="background: #BFFAF7">
				<!-- Container for the image gallery -->
					<div class="container-fluid">

					  <!-- Full-width images with number text -->
					  <div class="mySlides">
					    <div class="numbertext">1 / 6</div>
					      <img src="IMG/rio.png" style="width:100%; height: 300px">
					  </div>

					  <div class="mySlides">
					    <div class="numbertext">2 / 6</div>
					      <img src="IMG/avilense.png" style="width:100%; height: 300px">
					  </div>

					  <div class="mySlides">
					    <div class="numbertext">3 / 6</div>
					      <img src="IMG/eficiencia.png" style="width:100%; height: 300px">
					  </div>

					  <div class="mySlides">
					    <div class="numbertext">4 / 6</div>
					      <img src="IMG/maxima.png" style="width:100%; height: 300px">
					  </div>

					  <div class="mySlides">
					    <div class="numbertext">5 / 6</div>
					      <img src="IMG/volante.png" style="width:100%; height: 300px">
					  </div>

					  <div class="mySlides">
					    <div class="numbertext">6 / 6</div>
					      <img src="IMG/desportiva.png" style="width:100%; height: 300px">
					  </div>

					  <!-- Next and previous buttons -->
					  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
					  <a class="next" onclick="plusSlides(1)">&#10095;</a>

					  <!-- Image text -->
					  <div class="caption-container">
					    <p id="caption"></p>
					  </div>

					  <!-- Thumbnail images -->
					  <div class="row">
					    <div class="column">
					      <img class="demo cursor" src="IMG/rio.png" style="width:100%" onclick="currentSlide(1)" alt="Rio Vizela">
					    </div>
					    <div class="column">
					      <img class="demo cursor" src="IMG/avilense.png" style="width:100%" onclick="currentSlide(2)" alt="Avilense">
					    </div>
					    <div class="column">
					      <img class="demo cursor" src="IMG/eficiencia.png" style="width:100%" onclick="currentSlide(3)" alt="Eficiência">
					    </div>
					    <div class="column">
					      <img class="demo cursor" src="IMG/maxima.png" style="width:100%" onclick="currentSlide(4)" alt="Condução Maxima">
					    </div>
					    <div class="column">
					      <img class="demo cursor" src="IMG/volante.png" style="width:100%" onclick="currentSlide(5)" alt="O volante">
					    </div>
					    <div class="column">
					      <img class="demo cursor" src="IMG/desportiva.png" style="width:100%" onclick="currentSlide(6)" alt="A desportiva">
					    </div>
					  </div>
					</div>
				<h1 style="color: darkblue">Lista de Escolas de Condução</h1>
				<br>
				<table class="table table-sm">
				<?php
						$stm=$con->prepare('select * from escolaconducao');
						$stm->execute();
						$res=$stm->get_result();
						while ($resultado=$res->fetch_assoc())
						{
				?>
				<tr>
					<td>
						<?php
						echo $resultado['escola'].' ';
						?>
					</td>
					<td>
						<?php
							echo '<a class="btn btn-info" href="edit_escola.php?escolaconducao='.$resultado['id_escola'].'">Editar';
							echo '</a>'.' ';
						?>
					</td>
					<td>
						<?php
							echo '<a class="btn btn-info"  href="show_escola.php?escolaconducao='.$resultado['id_escola'].'">Detalhes';
							echo '</a>'.' ';
						?>
					</td>
					<td>
						<?php
							echo '<a class="btn btn-info" href="delete_escola.php?escolaconducao='.$resultado['id_escola'].'">Apagar';
							echo '</a>'.' ';	
						?>
					</td>
				</tr>
				<?php
					}
					$stm->close();
				?>

				</table>

				<br>
				<a class="btn btn-info" href="create_escola.php">Criar um novo registo</a>
				
			<br>



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
			}//end if -if($con->connect_errno!=0)
		
}
else
{
	echo 'Para entrar nesta página necessita efetuar o login <br><a href="login.php">login</a>';
	header('refresh:1;url=login.php');
}
?>
<br>
<a class="btn btn-info" href="processa_logout.php">Sair</a>

<a class="btn btn-info" href="index.php">Inicio</a>