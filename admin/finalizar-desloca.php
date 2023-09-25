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
    <script src="../js/finalizar-desloca.js" defer></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/finalizar-desloca.css">

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
        <?php 
            // listagem de dados

            include_once('../connection/connection.php');
            
            if (isset($_SESSION['usuario'])) {
                $user = $_SESSION['usuario'];


                    $sqlDados = $conn -> query("SELECT * FROM dados_deslocamento WHERE leiturista = '$user'");
                    
                    if ($sqlDados -> num_rows > 0) {
                        while($row = $sqlDados -> fetch_assoc()) {
                            if($row['situacao'] == 'Concluido') {
                                $classElement = 'visualizar';
                                $classSituacao = 'sit-concluida';
                                $text = 'Visualizar';
                            } else {
                                $classElement = 'finalizar';
                                $classSituacao = 'sit-incomp';
                                $text = 'Finalizar';

                            }

    
                        echo "<section class='box-cdc'>";
                            echo "<span>";
    
                            echo "<div class='inf-essenc'>";

                                echo "<p>CDC</p>";
                                    echo "<p class='dado-cdc'>".$row['cdc']."</p>";
                                        echo "<p>Situação <strong class='$classSituacao'>".$row['situacao']."</strong></p>";
                                    echo "<p>Ação <button class='acao-final $classElement'>$text</button></p>";
                                    echo "<ion-icon name='chevron-down-outline' class='icon-detalis'></ion-icon>";
                                echo "</div>"; //Fechamento do inf-essenc
                                    
                                    echo "<div class='details'>";
                                        echo "<ul>";
                                            echo "<li>";
                                                echo "<p>Leiturista</p>";
                                                echo "<p class='dado-name'>".$row['nome']."</p>";
                                            echo "</li>";
                                            echo "<li>";
                                                echo "<p>Cidade: </p>";
                                                echo "<p class='dado-city'>".$row['cidade']."</p>";
                                            echo "</li>";
                                            echo "<li>";
                                                echo "<p>Data:</p>";
                                                echo "<p class='dado-date'>".$row['data_deslocamento']."</p>";
                                            echo "</li>";
                                            echo "<li>";
                                                echo "<p>Deslocamento estava previsto:</p>";
                                                echo "<p class='dado-previsto'>".$row['previsto']."</p>";
                                            echo "</li>";
                                            echo "<li>";
                                                echo "<p class='dado-coord' >";
                        
                                                    echo " <p>Coordenadas:</p>";
                                                    echo "<p class='lat'>".$row['latitude'].",</p>";
                                                    echo "<p class='long'>".$row['longitude']."</p>";
                                                echo "<p>";
                                            echo "</li>";
                                            echo "</ul>"; //Fechamento UL
    
                                        echo "<div class='div-map'> </div>";
                            
                                        echo "<div class='box-obs'>";
                                            echo "<div class='box-acao-obs'>";
                                                echo "<p>Observação:</p>";
                                                echo "<button class='openObs'> Detalhes";
                                                    echo "<ion-icon name='chevron-down-outline'></ion-icon>";
                                                echo "</button>";
                                                
                                                
                                                echo "</div>"; //fechamento box acao obs
                                                echo "<div class='obs-contentExit'>";
                                                echo "<p class='dado-obs'>".$row['observacao']."</p>";
                                                echo "</div>";//Fechamento obs content
                                        echo "</div>"; //fechamento box obs
                                        echo "</div>"; //fechamento details
                                    echo "</span>";
                        echo "</section>";
                        }                    
                    }
                }      
        ?>
        <div class="box-acao-final">
            <div id="box-form-visual">
                <ion-icon class="icon-close-visual" name="close-outline" style="cursor: pointer;"></ion-icon>
                <h2>Pegar a localização atual</h2>
                <form action="index.php?acao=finalizar" method="post">
                    <label for="coord">Coordenadas</label>
                    <input type="text" name="coord" id="coord" placeholder="Ex -9.0000000 -35.238299">
                    <input type="hidden" id="cdcFinal" name="cdcF">
                    <input type="hidden" id="latFinal" name="latitudeF" >
                    <input type="hidden" id="longFinal" name="longitudeF" >
                    <input type="submit" value="Finalizar registro">
                </form>
                <button id="btnObterLocal">
                    <p>Obter localização</p>
                </button>
            </div>
            <div id="map">

            </div>

        </div>

        <div class="box-acao-visualizar">
            <div class="box-info-visualizar">
                <ion-icon class="icon-close-visual visualizar" name="close-outline" style="cursor: pointer;"></ion-icon>

                <span>
                    <p>Nome do leiturista:</p>
                    <p id="resposta-name">name</p>
                </span>
                <span>
                    <p>Cidade:</p>
                    <p id="resposta-city">city</p>
                </span>
                <span>
                    <p>CDC do deslocamento:</p>
                    <p id="resposta-cdc">1</p>
                </span>
                <span>
                    <p>Data de registro:</p>
                    <p id="resposta-data">date</p>
                </span>
                <span>
                    <p>Fora do previsto:</p>
                    <p id="resposta-previsto"></p>
                </span>
                <span>
                    <p>Coordenadas:</p>
                    <p id="resposta-coord">coord</p>
                </span>
                <span>
                    <div id="resposta-map"></div>
                </span>
                <span class="span-obs-visualizar">
                    <p>Observação:</p>
                    <div>
                        <p id="resposta-obs">OBSLorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa cupiditate
                            voluptatem error,
                            nisi nam dignissimos eius odit praesentium non tenetur illum adipisci, quia enim, sed vitae
                            architecto aspernatur quibusdam minus?</p>
                    </div>
                </span>
            </div>
        </div>

        <section class="box-cdc">
            <span>
                <div class="inf-essenc">
                    <p>CDC</p>
                    <p class="dado-cdc">362234</p>
                    <p>Situação <strong class="sit-incomp">Incompleto</strong></p>
                    <p>Ação <button class="acao-final finalizar">Finalizar</button></p>
                    <ion-icon name="chevron-down-outline" class="icon-detalis"></ion-icon>
                </div>
                <div class="details">

                    <ul>
                        <li>
                            <p>Leiturista</p>
                            <p class="dado-name">name 1</p>
                        </li>
                        <li>
                            <p>Cidade: </p>
                            <p class="dado-city">Barra de Santo Antônio</p>
                        </li>
                        <li>
                            <p>Data:</p>
                            <p class="dado-date"> 15/09/2023</p>
                        </li>
                        <li>
                            <p>Fora do previsto:</p>
                            <p class="dado-previsto">Não</p>
                        </li>
                        <li>
                            <p>Coordenadas:</p>
                            <p class="dado-coord">
                            <p class="lat">-9.389206,</p>
                            <p class="long"> -35.498140</p>
                            </p>
                        </li>
                    </ul>
                    <div class="div-map">

                    </div>
                    <div class="box-obs">

                        <div class="box-acao-obs">
                            <p>Observação:</p>
                            <button class="openObs">
                                detalhes
                                <ion-icon name="chevron-down-outline"></ion-icon>
                            </button>
                        </div>
                        <div class="obs-contentExit">
                            <p class="dado-obs"></p>
                        </div>
                    </div>
                </div>

            </span>
        </section>
        <section class="box-cdc">
            <span>
                <div class="inf-essenc">
                    <p>CDC </p>
                    <p class="dado-cdc">362234</p>
                    <p>Situação <strong class="sit-incomp">Incompleto</strong></p>
                    <p>Ação <button class="acao-final finalizar">Finalizar</button></p>
                    <ion-icon name="chevron-down-outline" class="icon-detalis"></ion-icon>
                </div>
                <div class="details">

                    <ul>
                        <li>
                            <p>Leiturista</p>
                            <p class="dado-name">name 1</p>
                        </li>
                        <li>
                            <p>Cidade:</p>
                            <p class="dado-city">Barra de Santo Antônio</p>
                        </li>
                        <li>
                            <p>Data: </p>
                            <p class="dado-date">15/09/2023</p>
                        </li>
                        <li>
                            <p>Fora do previsto:</p>
                            <p class="dado-previsto">Não</p>
                        </li>
                        <li>
                            <p>Coordenadas:</p>
                            <p class="dado-coord">
                            <p class="lat">-9.400409915647268,</p>
                            <p class="long"> -35.49715141097382</p>
                            </p>
                        </li>
                    </ul>
                    <div class="div-map">

                    </div>
                    <div class="box-obs">

                        <div class="box-acao-obs">
                            <p>Observação:</p>
                            <button class="openObs">
                                detalhes
                                <ion-icon name="chevron-down-outline"></ion-icon>
                            </button>
                        </div>
                        <div class="obs-contentExit">
                            <p class="dado-obs">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae
                                soluta aperiam sit
                                esse fugiat corporis architecto nostrum animi, voluptatem totam exercitationem
                                praesentium nisi molestiae in consequatur non vero. Est, at.</p>
                        </div>
                    </div>
                </div>

            </span>
        </section>
        <section class="box-cdc">
            <span>
                <div class="inf-essenc">
                    <p>CDC</p>
                    <p class="dado-cdc">362222</p>
                    <p>Situação <strong class="sit-concluida ">Concluido</strong></p>
                    <p>Ação <button class="acao-final visualizar">Visualizar</button></p>
                    <ion-icon name="chevron-down-outline" class="icon-detalis"></ion-icon>
                </div>
                <div class="details">

                    <ul>
                        <li>
                            <p>Leiturista</p>
                            <p class="dado-name">Lucas</p>
                        </li>
                        <li>
                            <p>Cidade:</p>
                            <p class="dado-city">Barra de Santo Antônio</p>
                        </li>
                        <li>
                            <p>Data: </p>
                            <p class="dado-date">15/09/2023</p>
                        </li>
                        <li>
                            <p>Fora do previsto:</p>
                            <p class="dado-previsto">Não</p>
                        </li>
                        <li>
                            <p class="dado-coord">
                            <p class="lat">-9.411001,</p>
                            <p class="long"> -35.497286</p>
                            </p>
                        </li>
                    </ul>
                    <div class="div-map">

                    </div>
                    <div class="box-obs">

                        <div class="box-acao-obs">
                            <p>Observação:</p>
                            <button class="openObs">
                                detalhes
                                <ion-icon name="chevron-down-outline"></ion-icon>
                            </button>
                        </div>
                        <div class="obs-contentExit">
                            <p class="dado-obs">Lorem ipsum dolor sit amet, consectetur Lorem ipsum dolor sit amet
                                consectetur, adipisicing elit. Hic praesentium sequi omnis culpa optio harum dolores
                                repellat laborum, officiis sed ex consequatur est necessitatibus nostrum non
                                reprehenderit, vel ea iure! </p>
                        </div>
                    </div>
                </div>

            </span>
        </section>
        <section class="box-cdc">
            <span>
                <div class="inf-essenc">
                    <p>CDC</p>
                    <p class="dado-cdc"> 111111</p>
                    <p>Situação <strong class="sit-concluida ">Concluido</strong></p>
                    <p>Ação <button class="acao-final visualizar">Visualizar</button></p>
                    <ion-icon name="chevron-down-outline" class="icon-detalis"></ion-icon>
                </div>
                <div class="details">

                    <ul>
                        <li>
                            <p>Leiturista</p>
                            <p class="dado-name">Deivison Johnny</p>
                        </li>
                        <li>
                            <p>Cidade:</p>
                            <p class="dado-city">Barra de Santo Antônio</p>
                        </li>
                        <li>
                            <p>Data: </p>
                            <p class="dado-date">15/09/2023</p>
                        </li>
                        <li>
                            <p>Fora do previsto:</p>
                            <p class="dado-previsto">SIMMM</p>
                        </li>
                        <li>
                            <p>Coordenadas:</p>
                            <p class="dado-coord">
                            <p class="lat">-9.368385,</p>
                            <p class="long"> -35.485592</p>
                            </p>
                        </li>
                    </ul>
                    <div class="div-map">

                    </div>
                    <div class="box-obs">

                        <div class="box-acao-obs">
                            <p>Observação:</p>
                            <button class="openObs">
                                detalhes
                                <ion-icon name="chevron-down-outline"></ion-icon>
                            </button>
                        </div>
                        <div class="obs-contentExit">
                            <p class="dado-obs">teste</p>
                        </div>
                    </div>
                </div>

            </span>
        </section>
    </main>

</body>

<script async>
    (g => { var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window; b = b[c] || (b[c] = {}); var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams, u = () => h || (h = new Promise(async (f, n) => { await (a = m.createElement("script")); e.set("libraries", [...r] + ""); for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]); e.set("callback", c + ".maps." + q); a.src = `https://maps.${c}apis.com/maps/api/js?` + e; d[q] = f; a.onerror = () => h = n(Error(p + " could not load.")); a.nonce = m.querySelector("script[nonce]")?.nonce || ""; m.head.append(a) })); d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n)) })
        ({ key: "AIzaSyCd5XbOjyBOfY73XFQZs9qOLWdg7lgX8kA", v: "beta" });
</script>

</html>