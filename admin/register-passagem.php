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
    <script src="../js/register-passagem.js" defer></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/register-passagem.css">

    <!-- Menu  -->
    <link rel="stylesheet" href="../layout/css/menu.css">
    <script src="../layout/js/menu.js" defer></script>

    <!-- icone -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <title>Registrar Passagem</title>
</head>

<body>

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
            <section>
                <h2>Adicionar deslocamento</h2>
                <form action="#" method="get">
                    <div>
                        <label for="leiturista">Nome do leiturista</label>
                        <input type="text" class="input" name="leiturista" id="leiturista" placeholder="Ex: Deivison Johnny">
                        <p class="required">* O campo acima deve ter ao menos 3 caracteres</p>
                    </div>
                    <div>
                        <label for="cidade">Cidade de atuação</label>
                        <input type="text" class="input" name="cidade" id="cidade" placeholder="Barra de Santo Antônio">
                        <p class="required">* O campo acima deve ter ao menos 3 caracteres</p>
                    </div>
                    <div>
                        <label for="cdc">CDC causador do deslocamento</label>
                        <input type="text" class="input" name="cdc" id="cdc" placeholder="Ex: 361000">
                        <p class="required">* O campo acima deve ter ao menos 3 caracteres</p>
                    </div>
                    <div>
                        <label for="data">Data do deslocamento</label>
                        <input type="date" class="input" name="data" id="data" min="2023-09-11" value="2023-09-11">
                        <p class="required">* O campo acima deve ter ao menos 3 caracteres</p>
                    </div>
                    <div id="box-radio">
                        <p>Este deslocamento está fora do previsto?</p>
                        <span>
                            <label for="sim">Sim</label>
                            <input type="radio"  name="previsto" id="sim" value="Sim">
                        </span>
                        <span>
                            <label for="nao" >Não</label >
                            <input type="radio"  name="previsto" id="nao" value="Nao" checked>
                        </span>
                    </div>
                    <div>
                        <label for="local">Local</label>
                        <button type="button" id="btnPegarLocal">Pegar localização</button>
                        <div id="box-input-local">
                            <span>
                                <span id="cobrir"></span>
                                <input type="text" class="input" name="local" id="local" placeholder="Cordernadas da localização">
                            </span>

                        </div>
                    </div>
                    
                    <div id="map">

                    </div>

                    <div id="box-obs">
                        <label for="obs">Observação</label>
                        <textarea name="observacao" id="obs"  rows="3" minlength="10"></textarea>
                    </div>
                    <div>
                        <input type="submit" value="Registrar">
                    </div>
                </form>
            </section>
        </main>

    </body>

    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCd5XbOjyBOfY73XFQZs9qOLWdg7lgX8kA&callback=initMap">
</script>
</html>