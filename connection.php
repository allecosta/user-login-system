<?php 

session_start();

// inicializando variaveis
$username = "";
$email = "";
$errors = array();

// conexao com o database
$conn = mysqli_connect('localhost', 'root', 'matrix0101', 'db_registro');

	// registro de usuario
	if (isset($_POST['reg_user'])) {

		// recebe todas as entradas do formulario
		$username = mysqli_real_escape_string($conn, $_POST['usuario']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$passwordOne = mysqli_real_escape_string($conn, $_POST['senha1']);
		$passwordTwo = mysqli_real_escape_string($conn, $_POST['senha2']);

		// validição de formulário para garantir que o formulário esteja corretamente preenchido
		if (empty($username)) {

			array_push($errors, "É necessário informar o nome de usuário");
		}

		if (empty($email)) {

			array_push($errors, "É necessário informar o email");
		}

		if (empty($passwordOne)) {

			array_push($errors, "É necessário informar a senha");
		}

		if ($passwordOne != $passwordTwo) {

			array_push($errors, "As senhas não correspondem, favor verificar!")
		}

		// verificação no database se o usuario não existe com o mesmo nome e/ou email
		$userCheckQuery = "SELECT * FROM users WHERE usuario='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query($conn, $userCheckQuery);
		$user = mysqli_fetch_assoc($result);

		// se o usuario existe
		if ($user) {

			if ($user['usuario'] === $username) {

				array_push($errors, "Usuário já existe!");
			}

			if ($user['email'] === $email) {

				array_push($errors, "Email já existe!");
			}
		}

		// registra o usuário se não houver erros no formulário
		if (count($errors) == 0) {

			// encripta a senha e salva no database
			$password = md5($passwordOne);

			$query = "INSERT INTO users (usuario, email, senha) VALUES ('$username', '$email', '$password')";
			
			mysql_query($conn, $query);

			$_POST['usuario'] = $username;
			$_POST['success'] = "Você está logado!";

			header('Location: index.php');
		}
	}

		// login do usuário
		if (isset($_POST['login_user'])) {

			$username = mysqli_real_escape_string($conn, $_POST['usuario']);
			$password = mysqli_real_escape_string($conn, $_POST['senha']);

			if (empty($username)) {

				array_push($errors, "É necessário informar o nome de usuário");
			}

			if (empty($password)) {

				array_push($errors, "É necessário informar a senha de login")
			}

			if (count($errors) == 0) {

				$password = md5($password);
				$query = "SELECT * FROM users WHERE usuario='$username' AND senha='$password'";
				$result = mysqli_query($conn, $query);

				if (mysqli_num_rows($result) == 1) {
					$_SESSION['usuario'] = $username;
					$_SESSION['success'] = "Você está logado!";

				} else {

					array_push($erros, "Erro! Usuário/senha incorreto.")
				}
			}
		}
