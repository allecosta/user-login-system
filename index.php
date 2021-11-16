<?php 

session_start();

	if (!isset($_SESSION['usuario'])) {

		$_SESSION['msg'] = "Você deve realizar o login";

		header('location: login.php');
	}

	if (isset($_GET['logout'])) {

		session_destroy();
		unset($_SESSION['usuario']);
		header('Location: login.php');

	}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>
	<div class="header">
		<h2>Sistema de Login</h2>
	</div>
	<div class="content">
		<!-- mensagem de notificação -->
		<?php if (isset($_SESSION['success'])) : ?>

			<div class="error success">
				<h3>
					<?php 

					echo $_SESSION['success'];
					unset($_SESSION['success']);

					?>
				</h3>
			</div>

			<?php endif ?>

			<!-- informações do usuário logado -->
			<?php if (isset($_SESSION['usuario'])) : ?>

				<p>Bem vindo(a) <strong><?php echo $_SESSION['usuario']; ?></strong></p>
				<p> <a href="index.php?logout='1'" style="color: red;">Logout</a></p>

			<?php endif ?>
		
	</div>
</body>

</html>