<?php   

if (isset($_POST['nome']) and isset($_POST['usuario']) and isset($_POST['cidade']) and isset($_POST['password'])) {

    include_once('../connection/connection.php');

    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $cidade = $_POST['cidade'];
    $password = $_POST['password'];

    if($conn) {

        $token = bin2hex($nome);

        $sql = "INSERT INTO dados_login(nome, usuario, cidade, password, token) VALUES ('$nome', '$usuario', '$cidade', '$password', '$token')";
        try {
            if($conn->query($sql)) {
                echo "<script>alert('Cadastro realizado com sucesso')</script>";
                echo "<script>window.location.href='../index.html'</script>";
            } else {
                echo "<script>alert('Erro ao realizar cadastro')</script>";
            }

        } catch (Exception $e) {
            if ($e -> getCode() == 1062) {
                echo "<script>alert('O nome $usuario de usuario já esta cadastrado')</script>";
            echo "<script>window.history.go(-1)</script>";


            } else {
                $i = $e->getMessage();
                echo "<script>alert('Erro desconhecido, tente novamente -> $i')</script>";
            }
            echo "<script>window.history.go(-1)</script>";

        }
        
    } else {
        echo "<script>alert('Erro na conexão ao banco de dados')</script>";

        $conn->die();
    }

} else {
    echo "<script>alert('Dados incompletos')</script>";
    echo "<script>window.location.href='../'</script>";
    $conn->die();
}
