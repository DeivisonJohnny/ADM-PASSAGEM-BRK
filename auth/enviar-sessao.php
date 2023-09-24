<?php 
    session_start();


    if (isset($_SESSION['usuario']) and isset($_SESSION['token'])) {
            // include_once('../connection/connection.php');
            $user = $_GET['user'];
            $token = $_GET['token'];
            validSessao( $user, $token);
    } else {
        session_destroy();
    }

    function validSessao($user, $token) {
        include_once('../connection/connection.php');

        $sql = $conn->query("SELECT usuario, token FROM dados_login WHERE usuario = '$user'");

        $dadosValid = mysqli_fetch_assoc($sql);
        
        if (empty($dadosValid['usuario']) or $dadosValid['usuario'] != $user or empty($dadosValid['token']) or $dadosValid['token'] != $token) {
            session_destroy();
            unset($dadosValid, $user, $token);
            header("Location: ../index.html");
        } else {
            header("Location: ../home/index.php?user=". $dadosValid['usuario']. "&token=".$_SESSION['token']);
        }
        
    }

    http://localhost/ADM-PASSAGEM-BRK/home/index.php?user=deivisonjohnny&token=4465697669736f6e204a6f686e6e79
