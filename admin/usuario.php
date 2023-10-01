<?php 
session_start();
if(isset($_SESSION['usuario']) AND isset($_SESSION['token'])) {
    include_once('../connection/connection.php');

    $usuario = $_SESSION['usuario'];
    $token = $_SESSION['token'];

    try {
        $sqlDadosUser = $conn -> query("SELECT * FROM dados_login WHERE usuario ='$usuario' AND token = '$token' ");

        // var_dump($sqlDadosUser);

        if ($sqlDadosUser -> num_rows > 0) {
            $sqlDadosUser = $sqlDadosUser -> fetch_assoc();
        } else {
        }

        
        
    } catch(Exception $erro) {
        echo $erro;
    }
} else {
    header("Location: ../admin/index.php?acao=deslogar");
}
    

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link font google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- Menu  -->
    <link rel="stylesheet" href="../layout/css/menu.css">
    <script src="../layout/js/menu.js" defer></script>

    <!-- icone -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <!-- CSS  -->
    <link rel="stylesheet" href="../css/usuario.css">

    <script src="../js/usuario.js" defer></script>

    <title>Dados do usuario</title>
</head>

<body>
    <header>
        <section>
            <div><img src="../img/brk-logo.png" alt="brk-logo"></div>
            <div id="boxBtnmenu">
                <ion-icon class="menuAbrirbtn" name="menu-outline"></ion-icon>
                <ion-icon class="menuFecharbtn" name="chevron-forward-outline"></ion-icon>
            </div>
        </section>
        <menu class="menu">
            <ul>
                <li>
                    <a href="usuario.html" style="border-radius: 5px 5px 0px 0px;">
                        <div id="triangulo"></div>
                        <p>Usuario</p>
                        <ion-icon name="person-sharp"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>Configurações</p>
                        <ion-icon name="cog-outline"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="../home/index.php">
                        <p>Pagina Inicial</p>
                        <ion-icon name="home-outline"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="../admin/register-passagem.php">
                        <p>Registrar Passagem</p>
                        <ion-icon name="reader-outline"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="../admin/finalizar-desloca.php">
                        <p>Finalizar deslocamento</p>
                        <ion-icon name="newspaper-outline"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="../admin/orcamento.php">
                        <p>Orçamento</p>
                        <ion-icon name="calculator-outline"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="index.php?acao=deslogar" style="border-radius: 0px 0px 5px 5px;">
                        <p>Logout</p>
                        <ion-icon name="exit-outline"></ion-icon>
                    </a>
                </li>
        </menu>
    </header>

    <main>
    <span class="box-mudar-senha altSenha altClose" style="overflow: auto;" >
        <ion-icon name="close-outline" id="closeAltSenha"></ion-icon>
        <h2>Alterar senha</h2>
        <form action="index.php?acao=alterarpass" method="post">
            <div>
                <label for="senhaAtual">Senha atual</label>
                <input type="password"  name="senhaAtual" id="senhaAtual" placeholder="Senha atual">
            </div>
            <div>
                <label for="novaSenhaP">Nova senha</label>
                <input type="password" name="novaSenhaP" id="novaSenhaP" class="inputAltSenha" placeholder="Nova senha">
                <p class="requiredInput">A senha deve ter ao menos 8 caracteres</p>
            </div>
            <div>
                <label for="novaSenhaC">Confirme a senha</label>
                <input type="password" name="novaSenhaC" id="novaSenhaC" class="inputAltSenha" placeholder="Nova senha">
                <p class="requiredInput">As senhas não são compativeis</p>
            </div>
            <?php 
                if (isset($_SESSION['erroAlterarSenha'])) {
                    echo "<div>";
                    echo $_SESSION['erroAlterarSenha'];
                    echo "</div>";

                }   
            ?>
            <div>
                <input type="submit" value="Alterar senha">
            </div>
        </form>
    </span>

    <span class="box-inserir-perfil addPerfilClose ocultarAddPerfil">
        <ion-icon name="close-outline" class="btnClosePerfil"></ion-icon>
        <h3>Ensira foto de perfil</h3>
        <form action="index.php" method="post">

            <div id="box-input">
                <label for="anexo" id="labelAnexo">Anexar foto</label>
                <input type="file" name="foto-perfil" id="anexo">
            </div>
            <div>
                <p id="arquivosSuportados">Arquivos suportados JPG, JPEG, PNG</p>
            </div>
            <div>
                <input type="submit" value="Adicionar">
            </div>
        </form>

    </span>

        <section id="box-user">
            <div id="box-perfil">
                <div id="box-img-perfil">
                    <img src="" alt="">
                    <ion-icon id="iconPerfil" name="add-outline"></ion-icon>
                </div>

                <p><?php echo $sqlDadosUser['nome']?></p>
            </div>
        </section>
        <section id="dados-cadastrados">
            <div>
                <h2>Dados cadastrados</h2>
            </div>
            <div>

                <span>
                    <h3>ID</h3>
                    <p><?php echo $sqlDadosUser['id'];?></p>
                </span>
                <span>
                    <h3>Usuario</h3>
                    <p><?php echo $sqlDadosUser['usuario'];?></p>
                </span>
            </div>
            <div>

                <span>
                    <h3>Cidade</h3>
                    <p><?php echo $sqlDadosUser['cidade'];?></p>
                </span>
                <span>
                    <h3>Senha</h3>
                    <div id="box-senha">
                        <p id="senha"><?php echo $sqlDadosUser['password'];?></p>
                        <div id="icon-senha">

                            <ion-icon name="eye-outline" id="eye"></ion-icon>
                            <ion-icon name="pencil-outline" id="pencil" ></ion-icon>

                        </div>
                    </div>
                </span>

            </div>
        </section>
    </main>
</body>

</html>