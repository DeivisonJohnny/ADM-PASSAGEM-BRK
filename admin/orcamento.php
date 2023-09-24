<?php 
    include_once('../auth/index.php');
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

    

    <!-- script JS -->
    <script src="../js/orcamento.js" defer></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/orcamento.css">

    <!-- Menu  -->
    <link rel="stylesheet" href="../layout/css/menu.css">
    <script src="../layout/js/menu.js" defer></script>

    <!-- icone -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <title>Document</title>
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
                    <a href="" style="border-radius: 0px 0px 5px 5px;">
                        <p>Logout</p>
                        <ion-icon name="exit-outline"></ion-icon>
                    </a>
                </li>
        </menu>
    </header>
    <main>
        <div class="box-deposito exitDepositar">
            <form action="">
                <div id="box-data">
                        <p id="data">Data: 21/11/2002</p>
                        <ion-icon id="btn-close-depositar" name="close-outline"></ion-icon>
                </div>
                <div id="box-inp">
                    <label for="vl-deposito">Valor do depósito</label>
                    <input type="text" name="vl-deposito" id="vl-deposito" placeholder="Ex: 200.00">
                </div>
                <input type="submit" value="Depositar">
            </form>
        </div>
        <section class="part">
            <div id="box-data-depos">
                <p>Data de depósito: 21/09/2000</p>
            </div>
            <div class="box-depos">
                
                <h2>R$ 280,00</h2>
                <button id="btn-depositar">Depositar</button>
            </div>
            <div id="saldo-atual">
                <p>Saldo atual:</p>
                <span>
                    <p>R$ 259,00</p>
                </span>
            </div>
        </section>
        <section class="part" id="part_1">
            <div class="title">
                <h2>Informações do valor por cada deslocamento</h2>
            </div>
            <div>
                <span>
                    <h3>Valor da tarifa atual</h3>
                    <p>R$ 7,00</p>

                </span>
                <span>
                    <h3>Número de deslocamento do mês</h3>
                    <p>3</p>
                </span>
            </div>
            <div>
                <span>
                    <h3>Valor gasto até o momento</h3>
                    <p>R$ 21,00</p>
                </span>
                <span>
                    <h3>Deslocamento possíveis</h3>
                    <p>37</p>
                </span>
            </div>
        </section>
        <section class="part" id="part_2">
            <div class="title">
                <h2>Passagens adicionais não previstas</h2>
            </div>
            <div id="n-add-passagem">
                <span>
                    <h3>Números de passagens</h3>
                    <p>2</p>
                </span>
                <span>
                    <h3>Valor das passagens</h3>
                    <p>37</p>
                </span>
            </div>
        </section>
    </main>

</body>