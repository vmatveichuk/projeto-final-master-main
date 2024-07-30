<?php
    session_start();
    header("Location: ".$_SESSION["base_path"] . "/login");
?>
