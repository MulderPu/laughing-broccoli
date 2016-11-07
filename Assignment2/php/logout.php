<?php

session_start();

if (isset($_SESSION["manager"])) {
	if (!$_SESSION["manager"] == "") {
		echo $_SESSION["manager"];
	}
}

if (isset($_SESSION["customer"])) {
	if (!$_SESSION["customer"] == "") {
		echo $_SESSION["customer"];
	}
}

session_destroy();
?>
