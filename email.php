<?php
session_start();
if ($_POST)
{
    if (isset($_POST["loginfmt"]))
    {
        $_SESSION["email"]=$_POST["loginfmt"];

        header("Location: selector.php");
    }
}