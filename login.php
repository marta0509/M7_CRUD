<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	 <link href="css/bootstrap.min.css" rel="stylesheet" >
  	 <link rel="stylesheet" href="css/jumbotrom.css">
  	 <link rel="stylesheet" type="text/css" href="CSS/slick.css"/>
  	 <link rel="stylesheet" type="text/css" href="CSS/slick-theme.css"/>
  	 <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<title>Login</title>
</head>
<body>
	<H1>Login</H1>
	<form method="post" action="processa_login.php">
		<label>User de utilizador</label><input type="text" name="user_name" required><br>
		<label>Email</label><input type="text" name="email" required><br>
		<label>Palavra-passe</label><input type="password" name="password" required><br>
		<input class="btn btn-info" type="submit" name="login">

		<a class="btn btn-info" href="index.php">Inicio</a>
	</form>

		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
 		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
 		<script src="JS/jquery-3.5.1.min.js"></script>
		<script src="JS/bootstrap.min.js"></script>
		<script src="JS/all.min.js"></script>
  		<script type="text/javascript" src="JS/slick.min.js"></script>
  		<script type="text/javascript" src="JS/estilos.js"></script>
</body>
</html>