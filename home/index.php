<?php 
    include_once('../auth/index.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- link font google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- CSS -->
    <!-- Menu -->
    <link rel="stylesheet" href="../layout/css/menu.css">
    
    <!-- Corpo -->
    <link rel="stylesheet" href="../css/home.css">

    <!-- icone -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <!-- Menu  -->
    <script src="../layout//js/menu.js" defer></script>
    <script src="../js/home.js" defer></script>

    <title>Home</title>
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
                    <a href="" style="border-radius: 5px 5px 0px 0px;">
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
                    <a href="" style="border-radius: 0px 0px 5px 5px;">
                        <p>Logout</p>
                        <ion-icon name="exit-outline"></ion-icon>
                    </a>


                </li>

            </ul>
        </menu>
    </header>

    <main>
        <section>
            <a href="../admin/register-passagem.php" id="addPassagem">
                <div>
                    <p>Registrar passagem</p>
                </div>
            </a>
        </section>
        <section>
            <a href="../admin/finalizar-desloca.php" id="finalRegister">
                <div>
                    <p>Finalizar registro de passagens</p>
                </div>
            </a>
        </section>
        <section>
            <a href="../admin/orcamento.php" id="viewPassagem">
                <div>
                    <p>Orçamento mensal</p>
                </div>
            </a>
        </section>

    </main>
    <footer>
        <h2><a href="">By Developer Deivison Johnny</a><ion-icon id="whats" name="logo-whatsapp"></ion-icon></h2>
    </footer>
</body>

</html>