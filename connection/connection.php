<?php 
    define("HOST", 'localhost');
    define("USER", 'root');
    define("PASS", '');
    define("DBNAME", 'BRK_USERS');

    $conn = new mysqli(HOST, USER, PASS, DBNAME);


    // if ($conn -> connect_error) {
    //     echo "Error ao conectar ao banco de dados";
    // } else {
    //     echo "SUCESSO";
    // }
    

?>