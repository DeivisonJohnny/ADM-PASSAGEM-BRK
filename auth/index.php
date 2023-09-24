<?php 
session_start();
if (!isset($_SESSION['usuario']) and !isset($_SESSION['token'])) {
    header("Location: ../index.html");
}


    
?>