<?php

function error($err = '')
{
	$alert = ($err != '')? $err: 'Une erreur inconnue s\'est produite.';
	exit('<p>'.$alert.'</p>
		<p>Cliquez <a href="signin.php">ici</a> pour revenir au formulaire.</p>');
}