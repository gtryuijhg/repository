<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Les Jardins des Délices</title>
		<link rel="stylesheet" href="../../public/css/main.css">
	</head>
	<body>
		<header>
			<h1>Bonjour <?= htmlspecialchars($_SESSION['pseudo']); ?> et bienvenue à la boulangerie-pâtisserie Les Jardins des Délices !</h1>
			<script src="../../public/js/date.js"></script>
			<a href="../../functions/signout/signout.php">Se déconnecter</a>
		</header>

		<main>
			<?= require $template.'View.php'; ?>
		</main>
	</body>
</html>