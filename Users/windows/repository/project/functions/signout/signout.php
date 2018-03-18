<?php
session_start();
session_destroy();

echo '<p>Déconnexion réussie !</p>';
header('Location:../../index.php');