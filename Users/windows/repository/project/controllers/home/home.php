<?php

session_start();

require '../../models/connect/connectModel.php';

$template = '../../views/home/home';

if (htmlspecialchars(!isset($_SESSION['pseudo'])))
{
	require '../../headers/guest/headerGuest.php';
}

else
{
	require '../../headers/member/headerMember.php';
}