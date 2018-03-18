<?php

session_start();

require_once '../../models/connect/connectModel.php';

$id = 0;

if ($id != 0) error(ERR_IS_CO);

if (htmlspecialchars(!isset($_POST['pseudo'])))
{
	$template = '../../views/signin/signin';
	require_once '../../headers/guest/headerGuest.php';
}

else
{
	$alert = '';

	if (htmlspecialchars(empty($_POST['pseudo'])) || htmlspecialchars(empty($_POST['password'])))
	{
		$alert = '<p>Vous avez oublié de renseigner votre pseudo et/ou votre mot de passe.</p>
		<p>Cliquez <a href="signin.php">ici</a> pour revenir au formulaire.</p>';
	}

	else
	{
		sleep(1);

		$query = $database->prepare('
									SELECT id, pseudo, password
									FROM user
									WHERE pseudo = ? AND password = ?
									');

		$query->execute(array(htmlspecialchars($_POST['pseudo']), htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT))));
		$signin = $query->fetch();

		if ($signin['password'] == htmlspecialchars(password_hash($_POST['password'])))
		{
			$_SESSION['pseudo'] = htmlspecialchars(strtolower($_POST['pseudo']));
			$alert = 'Connexion réussie !';
			header('Location:../home/home.php');
		}

		else
		{
			$alert = '<p>Pseudo et/ou mot de passe incorrect.</p>
			<p>Cliquez <a href="signin.php">ici</a> pour revenir au formulaire.</p>';
		}

		$query->CloseCursor();
	}

	echo $alert;
}