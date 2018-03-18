<?php

session_start();

require '../../models/connect/connectModel.php';

$id = 0;

if ($id != 0) error(ERR_IS_CO);

if (htmlspecialchars(!isset($_POST['pseudo'])))
{
	$template = '../../views/signup/signup';
	require '../../headers/guest/headerGuest.php';
}

else
{
	$pseudo_used_error = NULL;
	$pseudo_length_error = NULL;
	$password_empty_error = NULL;

	$i = 0;
	$pseudo = htmlspecialchars(strtolower($_POST['pseudo']));
	$password = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));

	//On vérifie le pseudo
	$query = $database->prepare('
								SELECT COUNT(*) AS nbr
								FROM user
								WHERE pseudo = :pseudo
								');

	$query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
	$query->execute();
	$pseudo_free = ($query->fetchColumn() == 0)?1:0;
	$query->CloseCursor();

	if (!$pseudo_free)
	{
		$pseudo_used_error = 'Votre pseudo est déjà utilisé.';
		$i++;
	}

	if (strlen($pseudo) < 3 || strlen($pseudo) > 15)
	{
		$pseudo_length_error = 'Votre pseudo est trop long ou trop court.';
		$i++;
	}

	if (empty($password))
	{
		$password_empty_error = 'Votre mot de passe est vide.';
		$i++;
	}

	if ($i == 0)
	{
		$query = $database->prepare('
									INSERT INTO user (id, pseudo, password)
									VALUES (:id, :pseudo, :password)
									');

		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
		$query->bindValue(':password', $password, PDO::PARAM_INT);
		$query->execute();
		

		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['id'] = $database->lastInsertId();
		$query->CloseCursor();

		header('Location:../home/home.php');
		echo 'Inscription réussie !';	
	}

	else
	{
		echo '<h1>Inscription interrompue.</h1>';
		echo '<p>Une ou plusieurs erreurs se sont produites pendant l\'inscription.</p>';
		echo '<p>'.$i.' erreur(s).</p>';
		echo '<p>'.$pseudo_used_error.'</p>';
		echo '<p>'.$pseudo_length_error.'</p>';
		echo '<p>'.$password_empty_error.'</p>';

		echo '<p>Cliquez <a href="signup.php">ici</a> pour recommencer.</p>';
	}
}