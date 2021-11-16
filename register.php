<?php

include('server.php'); 

?>

<!DOCTYPE html>
<html>

<head>
	<title>Connection</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>
	<div class="header">
		<h2>Registre</h2>
	</div>

	<form method="POST" action="register.php">

		<?php

		include('errors.php');

		?>

		<div class="input-group">
			<label>Usuário </label>
			<input type="text" name="usuario" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Senha </label>
			<input type="password" name="passwordOne">
		</div>
		<div class="input-group">
			<label>Confirme a senha </label>
			<input type="password" name="passwordTwo">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Registre</button>
		</div>

		<p>Já é um membro? <a href="login.php">Entrar</a></p>
			
	</form>
</body>

</html>

