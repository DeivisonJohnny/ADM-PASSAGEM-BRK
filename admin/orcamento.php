<?php 
    include_once('../auth/index.php');

    if (isset($_SESSION['usuario'])) {
        include_once('../connection/connection.php');
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
        $usuario = $_SESSION['usuario'];
        $sqlPegarDeposito = $conn -> query("SELECT valor_deposito, data_deposito FROM deposito_passagem WHERE usuario = '$usuario' and mes_referente = '$mes_referente'");

        $valorDepositado = $sqlPegarDeposito -> num_rows;

        if ($valorDepositado > 0) {
            $row = $sqlPegarDeposito -> fetch_assoc();
        } else {
            $row['valor_deposito'] = 'R$ 0';
            $row['data_deposito'] = '';
        }
        
        $sqlDadosDeslocaCount = $conn -> query("SELECT * FROM dados_deslocamento WHERE leiturista = '$usuario' and mes_referente = '$mes_referente'");

        $deslocamentoMes = $sqlDadosDeslocaCount -> num_rows;

        if ($deslocamentoMes < 1) {
            $deslocamentoMes = '0';
        }

        $sqlSituacao = $conn -> query("SELECT * FROM dados_deslocamento WHERE leiturista = '$usuario' and situacao = 'Concluido'");
        $concluidos = $sqlSituacao -> num_rows;
        if ( $concluidos < 1) {
            $concluidos = '0';
        }
        


    } else {
        header('Location: ../index.html');
        session_destroy();

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
        <div class="box-deposito exitDepositar">
            <form action="index.php?acao=depositar" method="post">
                <div id="box-data">
                        <p id="data">Data: 21/11/2002</p>
                        <ion-icon id="btn-close-depositar" name="close-outline"></ion-icon>
                </div>
                <div id="box-inp">

                    <label for="input-deposito">Valor do depósito</label>
                    <input type="text" id="input-deposito" name="valor-deposito" id="vl-deposito" placeholder="Ex: 200.00" maxlength="11">
                </div>
                <input type="submit" value="Depositar">
            </form>
        </div>
        <section class="part">
            <div id="box-data-depos">
                <p>Data de depósito: <?php echo $row['data_deposito']?></p>
            </div>
            <div class="box-depos">
                
                <h2 id="deposito"><?php echo $row['valor_deposito']?></h2>
                <button id="btn-depositar">Depositar</button>
            </div>
            <div id="saldo-atual">
                <p>Saldo atual:</p>
                <span>
                    <p id="saldoAtual"><?php echo $row['valor_deposito']?></p>
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
                    <p id="valor-tarifa">R$ 7,00</p>

                </span>
                <span>
                    <h3>Número de deslocamento do mês</h3>
                    <p id="deslocamentoM"><?php echo $deslocamentoMes;?></p>
                </span>
            </div>
            <div>
                <span>
                    <h3>Valor gasto até o momento</h3>
                    <p id="valor-gasto">R$ 21,00</p>
                </span>
                <span>
                    <h3>Deslocamento possíveis</h3>
                    <p id="deslocamento_possiveis">37</p>
                </span>
            </div>
            <div>
                <span>
                    <h3>Deslocamento finalizados</h3>
                    <p id="finalizados"><?php echo $concluidos ?></p>
                </span>
                <span>
                    <h3>Deslocamento incompletos</h3>
                    <p id="incompletos"></p>
                </span>
            </div>
        </section>
        <section class="part" id="part_2">

        <?php 
            $sqlPrevisto = $conn -> query("SELECT previsto FROM dados_deslocamento WHERE leiturista = '$usuario' and previsto = 'NÃO'");

            $Nao_previsto = $sqlPrevisto -> num_rows;

            if ($Nao_previsto < 1) {
                $Nao_previsto = '0';
            }
            

        ?>
            <div class="title">
                <h2>Passagens adicionais não previstas</h2>
            </div>
            <div id="n-add-passagem">
                <span style="width: 100%;">
                    <h3>Números de passagens não previstas</h3>
                    <p id="previsto"><?php echo $Nao_previsto?></p>
                </span>
                <!-- <span>
                    <h3>Passagens não previstas pagas</h3>
                    <p>1</p>
                </span> -->
            </div>
        </section>
    </main>

</body>