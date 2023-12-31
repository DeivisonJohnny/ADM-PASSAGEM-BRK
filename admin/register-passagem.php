<?php 
    include_once('../auth/index.php');
    include_once('../connection/connection.php');

    $usuario = $_SESSION['usuario'];
    $token = $_SESSION['token'];


    $sqlPreencher = $conn -> query("SELECT nome, cidade from dados_login WHERE usuario = '$usuario' and token = '$token'");

    $dados = $sqlPreencher -> fetch_assoc();

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
            <section>
                <h2>Adicionar deslocamento</h2>
                <form action="index.php?acao=registrar" method="post">
                    <div>
                        <label for="leiturista">Nome do leiturista</label>
                        <input type="text" class="input" name="leiturista" id="leiturista" placeholder="Ex: Deivison Johnny" value="<?php echo $dados['nome'];?>">
                        <p class="required">* O campo acima deve ter ao menos 3 caracteres</p>
                    </div>
                    <div>
                        <label for="cidade">Cidade de atuação</label>
                        <input type="text" class="input" name="cidade" id="cidade" placeholder="Barra de Santo Antônio" value="<?php echo $dados['cidade']?>">
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
                        <p>Este deslocamento está no orcamento previsto?</p>
                        <span>
                            <label for="sim">Sim</label>
                            <input type="radio"  name="previsto" id="sim" value="SIM" checked>
                        </span>
                        <span>
                            <label for="nao" >Não</label >
                            <input type="radio"  name="previsto" id="nao" value="NÃO" >
                        </span>
                    </div>
                    <div>
                        <label for="local">Local</label>
                        <button type="button" id="btnPegarLocal">Pegar localização</button>
                        <div id="box-input-local">
                            <span>
                                <span id="cobrir"></span>
                                <input type="text" class="input" name="local" id="local" placeholder="Cordernadas da localização">
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
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

    <script async>
    (g => { var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window; b = b[c] || (b[c] = {}); var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams, u = () => h || (h = new Promise(async (f, n) => { await (a = m.createElement("script")); e.set("libraries", [...r] + ""); for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]); e.set("callback", c + ".maps." + q); a.src = `https://maps.${c}apis.com/maps/api/js?` + e; d[q] = f; a.onerror = () => h = n(Error(p + " could not load.")); a.nonce = m.querySelector("script[nonce]")?.nonce || ""; m.head.append(a) })); d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n)) })
        ({ key: "AIzaSyCd5XbOjyBOfY73XFQZs9qOLWdg7lgX8kA", v: "beta" });
</script>

</html>