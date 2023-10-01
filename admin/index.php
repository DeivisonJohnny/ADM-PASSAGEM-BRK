<?php

session_start();

use JetBrains\PhpStorm\ExpectedValues;

if (isset($_GET['acao'])) {
    switch (date('M')) {
        case 'Jan':
            $mes_referente = 'Janeiro';
            break;
        case 'Feb':
            $mes_referente = 'Fevereiro';
            break;
        case 'Mar':
            $mes_referente = 'Março';
            break;
        case 'Apr':
            $mes_referente = 'Abril';
            break;
        case 'May':
            $mes_referente = 'Maio';
            break;
        case 'Jun':
            $mes_referente = 'Junho';
            break;
        case 'Jul':
            $mes_referente = 'Julho';
            break;
        case 'Aug':
            $mes_referente = 'Agosto';
            break;
        case 'Sep':
            $mes_referente = 'Setembro';
            break;
        case 'Oct':
            $mes_referente = 'Outubro';
            break;
        case 'Nov':
            $mes_referente = 'Novembro';
            break;
        case 'Dec':
            $mes_referente = 'Dezembro';
            break;
    }

    if ($_GET['acao'] === 'registrar') {
        $nome = $_POST['leiturista'];
        $cidade = $_POST['cidade'];
        $cdc = $_POST['cdc'];
        $data = $_POST['data'];
        $previsto = $_POST['previsto'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $obs = $_POST['observacao'];
    }


    include_once("../connection/connection.php");

    $usuario = $_SESSION['usuario'];
    $token = $_SESSION['token'];




    switch ($_GET['acao']) {
        case 'registrar':
            $sql = $conn->query("SELECT id from dados_login WHERE usuario = '$usuario' and token = '$token'");

            $id = $sql->fetch_assoc();

            $id = $id['id'];

            date_default_timezone_set('America/Recife');
            $data_processamento = date('d-m-Y H:i:s');

            try {
                $sqlInserir = $conn->query("INSERT INTO dados_deslocamento(leiturista, nome, cidade, cdc, data_deslocamento, previsto, latitude, longitude, observacao, situacao, data_processamento, mes_referente) VALUES ( '$usuario', '$nome', '$cidade', $cdc, '$data', '$previsto', '$lat', '$lng', '$obs', 'Incompleto', '$data_processamento', '$mes_referente')");

                header('Location: ../home/index.php');
            } catch (ExpectedValues $e) {
                echo "<script> alert('Error ao inserir dados $e')</script>";
            }

            break;

        case 'finalizar':
            if (isset($_SESSION['usuario'])) {

                try {
                    $cdcFinal = $_POST['cdcF'];

                    $sqlSelectId = $conn->query("SELECT id FROM dados_deslocamento WHERE cdc = $cdcFinal");

                    $id = $sqlSelectId->fetch_assoc();

                    $id = $id['id'];
                    $latitudeF = $_POST['latitudeF'];
                    $longitudeF = $_POST['longitudeF'];
                    $conn->query("UPDATE dados_deslocamento SET situacao = 'Concluido' WHERE id = $id");

                    $sqlInserirFinal = $conn->query("INSERT INTO localizacao_final(id, cdc, latitude, longitude) VALUES($id, $cdcFinal, '$latitudeF', '$longitudeF')");
                } catch (Exception $e) {
                    echo $e;
                }
                header("Location: ../admin/finalizar-desloca.php");
            } else {
                header("Location: ../index.html");
            }


            break;

        case 'depositar':

            date_default_timezone_set('America/Recife');

            $data_processamento = date('d/m/Y');
            $hora = date('H:i:s');
            $valorDeposito = $_POST['valor-deposito'];


            echo $mes_referente;

            if (isset($usuario) and isset($data_processamento) and isset($hora) and isset($usuario) and isset($valorDeposito)) {

                $sqlDeposito = $conn->query(
                    "INSERT INTO deposito_passagem
                (usuario, 
                valor_deposito, 
                mes_referente, 
                data_deposito, 
                hora_deposito) 
                VALUES ('$usuario',
                '$valorDeposito', 
                '$mes_referente', 
                '$data_processamento', 
                '$hora')"
                );

                if ($sqlDeposito) {
                    header("Location: ../admin/orcamento.php");
                } else {
                    echo "<script>window.history.go(-1)</script>";
                }
            }


            break;

        case 'alterarpass':
            if (isset($_SESSION['usuario'])) {
                $senhas = [
                    'senhaAtual' => $_POST['senhaAtual'],
                    'senhaP' => $_POST['novaSenhaP'],
                    'senhaC' => $_POST['novaSenhaC'],
                ];

                try {
                    $sqlAlterSenha = $conn -> query("SELECT password FROM dados_login WHERE usuario = '$usuario' AND token = '$token'");

                    $senhaSql = $sqlAlterSenha -> fetch_assoc();

                    if ($senhas['senhaAtual'] == $senhaSql['password'] and $senhas['senhaP'] == $senhas['senhaC']) {

                        $senhaAtual = $senhas['senhaAtual'];
                        $novaSenha = $senhas['senhaC'];

                        $sqlUpdateSenha = $conn -> query("UPDATE dados_login SET password = '$novaSenha' WHERE usuario = '$usuario' AND password = '$senhaAtual' AND token = '$token'");

                        if (isset($_SESSION['erroAlterarSenha'])) {
                            unset($_SESSION['erroAlterarSenha']);
                        }

                        header("Location: ../admin/usuario.php");
                        
                    } else {
                        $_SESSION['erroAlterarSenha'] = "<p id='errorAltSenha'>As senhas passadas pelo formúlario não são correspondente <p>";

                        echo "<script>window.history.go(-1)</script>";
                    }
                    
                    

                } catch(Exception $erro) {
                    echo $erro, "erro";
                }
            } 
            break;

        case 'deslogar':
            header('Location: ../index.html');
            unset($_SESSION);
            session_destroy();
            break;
        default:
            header("Location: ../home/index.php");
            break;
    }
} else {
    header("Location: ../home/index.php");
}

?>

<!DOCTYPE html>

<head>
    <title>Load</title>
    <style>
        body {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            overflow: hidden;
        }

        #box-load {
            height: 35px;
            width: 35px;
            border-left: 6px solid blue;
            border-right: 6px solid blue;
            border-top: 6px solid blue;
            border-bottom: 6px solid lightgray;

            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;

            animation: load 0.7s infinite ease-in-out;
        }

        #load {
            background-color: white;
            width: 80%;
            height: 80%;
            border-radius: 50%;
        }

        @keyframes load {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }

            /* 100% {
                transform: rotate(0deg);
            } */
        }

        p {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: gray;
        }
    </style>
</head>

<body>
    <div id="box-load">
        <div id="load">

        </div>
    </div>

    <p>Carregando</p>

</body>

</html>