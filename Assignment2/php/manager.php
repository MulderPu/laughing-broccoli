<?php
    session_start();

    if (isset($_SESSION["manager"])) {
    	if (!$_SESSION["manager"] == "") {
            $manager = $_SESSION['manager'];
    		echo $_SESSION["manager"];
    	}
    }
?>
