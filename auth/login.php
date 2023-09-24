<?php

session_start();


    

    function efetuarLogin() {

        if (isset($_POST['usuario']) and isset($_POST['password'])) {

            include_once('../connection/connection.php');

            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $sql = $conn->query("SELECT * FROM dados_login WHERE usuario = '$usuario' and password = '$password'");

            if ($sql -> num_rows > 0) {
                echo "<script>alert('Dados validados')</script>";
                criarSessao($conn, $usuario, $password);
            } else {
                header("Location: ../index.html");
                echo "<script>alert('Dados INCORRETOS')</script>";
            }
            

        } else {
            header("Location: ../index.html");
            echo "<script>alert('Preencha todos os dados')</script>";
        }
    }

    efetuarLogin();

    function criarSessao($conn, $user, $pass) {

        $sql = $conn->query("SELECT token FROM dados_login WHERE usuario = '$user' and password = '$pass'");
        $row = mysqli_fetch_assoc($sql);
        $_SESSION['usuario'] = $user;
        $_SESSION['token'] = $row['token'];

        $token = $row['token'];

        header("Location: ./enviar-sessao.php?user=$user&token=$token");
    }
