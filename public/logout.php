<?php


if (isset($_SESSION['user'])) {
	unset($_SESSION['user']);
}

header('Location: home/index.php');


?>