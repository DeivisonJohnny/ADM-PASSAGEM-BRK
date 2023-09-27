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

                $sqlDeposito = $conn -> query("INSERT INTO deposito_passagem
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


            } else {
                # code...
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
