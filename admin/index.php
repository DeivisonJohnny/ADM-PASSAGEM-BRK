<?php

session_start();

use JetBrains\PhpStorm\ExpectedValues;

if (isset($_GET['acao'])) {

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

            echo "<p>$data_processamento</p>";
            echo $usuario;

            try {
                $sqlInserir = $conn->query("INSERT INTO dados_deslocamento(leiturista, nome, cidade, cdc, data_deslocamento, previsto, latitude, longitude, observacao, situacao, data_processamento) VALUES ( '$usuario', '$nome', '$cidade', $cdc, '$data', '$previsto', '$lat', '$lng', '$obs', 'Incompleto', '$data_processamento')");

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
                    $conn -> query("UPDATE dados_deslocamento SET situacao = 'Concluido' WHERE id = $id");

                    $sqlInserirFinal = $conn -> query("INSERT INTO localizacao_final(id, cdc, latitude, longitude) VALUES($id, $cdcFinal, '$latitudeF', '$longitudeF')");

                } catch (Exception $e) {
                    echo $e;
                }
                

                echo $cdcFinal . " cdc<br>";
                echo $id . " id<br>";
                echo $latitudeF . " lat <br>";
                echo $longitudeF . " long <br>";
            } else {
                # code...
            }


            break;


        default:
            header("Location: ../home/index.php");
            break;
    }
} else {
    header("Location: ../home/index.php");
}

