<?php
require("config.php");

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Receitas - Talhos do Carlos</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/receitas.js"></script>
</head>

<body>
<div id="wrapper">
    <div id="header">
        <div class="logo">
            <img src="imagens/logo.png" alt="Logótipo">
        </div>
        <div class="header_direita">
            <img src="imagens/telefone.png" alt="Ícone telefone"/>
            <div class="numero_telefone">21 204 84 79</div>
            <div class="horario">De Segunda a Sábado<br>Horário: 08:00h às 13:00h<br>14:30h às 19:30h</div>
        </div>

        <div id="menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="especialidades.php">Especialidades</a></li>
                <li class="active"><a href="receitas.php">Receitas</a></li>
                <li><a href="contactos.php">Contactos</a></li>
                <li><a href="loja.php">Loja</a></li>
                <li><a href="cart.php">Ver Carrinho</a></li>
                <?php
                if (isset($_SESSION["user_id"])) {

                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {

                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div id="main">
        <h1>Receitas</h1>
        <p>Agora já se pode inspirar nas nossas receitas e desfrutar de bons momentos com aqueles que mais gosta!</p>
        <ul id="recipe_list">
            <li>
                <a href="#cabrito_assado" data-id="#cabrito_assado">Cabrito Assado</a>
            </li>
            <li>
                <a href="#bola_carne" data-id="#bola_carne">Bola de Carne</a>
            </li>
            <li>
                <a href="#carne_porco_alentejana" data-id="#carne_porco_alentejana">Carne de Porco à Alentejana</a>
            </li>
        </ul>

        <div id="cabrito_assado" class="receita">
            <h2>Cabrito assado no forno com batatinhas assadas</h2>
            <img src="imagens/cabritoassado.jpg" alt="Cabrito assado">
            <h3>Ingredientes para 4 pessoas:</h3>
            <ul>
                <li>1,5 kg de cabrito</li>
                <li>1 colher de sopa bem cheia de massa de pimentão</li>
                <li>4 dentes de alho picados</li>
                <li>3 folhas de louro</li>
                <li>1 cebola cortada em rodelas meia-lua</li>
                <li>Raminhos de salsa</li>
                <li>500 ml de vinho branco</li>
                <li>Sal q.b.</li>
                <li>Pimenta q.b.</li>
                <li>1 kg de batatinhas para assar</li>
                <li>30 ml de azeite</li>
                <li>2 colheres de sopa de banha</li>
                <li>200 ml de caldo de carne</li>
            </ul>
            <h3>Preparação:</h3>
            <ol>
                <li>Numa tigela, tempere o cabrito com sal, pimenta, os alhos picados e a massa de pimentão. Misture
                    tudo. Junte as folhas
                    de louro, as rodelas de cebola e os raminhos de salsa. Regue tudo com o vinho branco e guarde no
                    frigorífico de um
                    dia para o outro.
                </li>
                <li>No dia seguinte, tempere as batatas com sal, pimenta e metade do azeite. Misture tudo.</li>
                <li>Numa assadeira de barro, coloque no fundo os raminhos de salsa, a cebola e as folhas de louro. Por
                    cima, coloque a carne
                    e à volta da carne espalhe as batatas. Regue tudo com o marinado da carne, o caldo de carne e o
                    restante azeite. Por
                    cima, espalhe pedacinhos de banha.
                </li>
                <li>Leve ao forno pré-aquecidos nos 200º durante 1 hora e 10 minutos. A meio do tempo, vire a carne para
                    ficar loira de
                    ambos os lados.
                </li>
            </ol>
            <p>
                <strong>Depois do cabrito assado, sirva.</strong>
            </p>
        </div>
        <div id="bola_carne" class="receita">
            <h2>Bola de carnes fácil e rápida</h2>
            <img src="imagens/boladecarne.jpg" alt="Bola de carne" style="width:100%"/>
            <h3>Ingredientes:</h3>

            <h4>Para fazer a massa é necessario...</h4>
            <ul>
                <li>2 ovos grandes ou 3 pequenos</li>
                <li>1 chávena de leite</li>
                <li>1 dl de azeite</li>
                <li>2 chávenas de farinha</li>
                <li>1 colher de sopa de fermento em pó (usei Royal)</li>
            </ul>

            <h3>Para fazer o recheiro é necessario...</h3>
            <ul>
                <li>1 cebola picada</li>
                <li>1 frasco de salsichas e/ou outras carnes</li>
            </ul>

            <h4>Preparação:</h4>
            <ol>
                <li>Bater os ovos.</li>
                <li>Juntar o leite e o azeite e bater muito bem.</li>
                <li>Juntar a farinha e o fermento e mexer muito bem.</li>
                <li>Juntar a cebola picada e as salsichas picadas (ou outras carnes) e envolver.</li>
                <li>Colocar este preparado numa forma anti-aderente barrada com manteiga e polvilhada com farinha. Em
                    alternativa podem-se
                    pôr camadas de massa a alternar com a cebola e a carne.
                </li>
                <li>Vai ao forno pré aquecido cerca de 30 a 40 minutos. Verificar a cozedura com 1 palito.</li>
            </ol>
            <p>(Quem diz salsichas pode utilizar presunto, fiambre, chouriço ou bacon.)</p>
            <p>Fica ao vosso critério e gosto.</p>
            <p>
                <strong>Bom apetite!</strong>
            </p>
        </div>
        <div id="carne_porco_alentejana" class="receita">
            <h2>Carne de Porco à Alentejana</h2>
            <img src="imagens/carne_de_porco.jpg" alt="Carne de porco" style="width:100%"/>
            <h3>Ingredientes para 5 pessoas:</h3>
            <ul>
                <li>1Kg de carne de porco cortada aos cubos</li>
                <li>5 dentes de Alhos</li>
                <li>3 Folhas de louro</li>
                <li>Massa de pimentão q.b.</li>
                <li>Sal fino q.b.</li>
                <li>Pimenta q.b.</li>
                <li>Sumo de 1 limão</li>
                <li>Margarina e banha para fritar</li>
            </ul>
            <h3>Preparação:</h3>
            <ol>
                <li>Coloque a carne numa tigela. Pique os alhos e junte-os à carne. Junte as folhas de louro, 2 colheres
                    de massa de pimentão,
                    sal e pimenta. Mexa tudo e regue com o sumo do limão. Deixe de molho 2 horas para tomar gosto.
                </li>
                <li>Numa frigideira larga leve a aquecer a margarina e a banha. Escorra a carne e coloque na frigideira.
                    Deixe fritar 5
                    minutos. Junte o marinado e deixe cozinhar mais 5 minutos.
                </li>
            </ol>
            <p>
                <strong>Acompanhar com batatas fritas aos palitos ou arroz e bom apetite!</strong>
            </p>
        </div>

    </div>
    <div id="footer">
    </div>
</div>
</body>

</html>