<?php
require("config.php");

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Talhos do Carlos</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
    </div>
    <div id="menu">
        <ul>
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="especialidades.php">Especialidades</a></li>
            <li><a href="receitas.php">Receitas</a></li>
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
    <div id="main">

        <h1>Quem somos...</h1>
        <div><img src="imagens/banner-carne.jpg" alt=""></div>
        <p><strong>Talhos do Carlos</strong> nasceu há 25 anos, mas os seus fundadores contam com 37 anos de experiência
            no ramo.</p>
        <p>O interesse pelo ramo das carnes iniciou-se quando um dos fundadores ainda vivia no Alentejo, e com 12 anos
            de idade saia da escola e ia assistir ao trabalho do seu tio que na altura era proprietário de alguns
            talhos. </p>
        <p>Com força de vontade e paciência o primeiro talho foi fundado em 1989, sendo que neste momento existem 3
            espaços.</p>
        <p><strong>O que distingue os Talhos do Carlos dos restantes?</strong><br>
            Talhos do Carlos distinguem-se pelo atendimento ao público cuidado, personalizado e a garantia de servir os
            produtos mais frescos e de qualidade aos seus clientes.</p>
        <p>São aceites encomendas das diversas especialidades, sendo que todas se podem personalizar consoante o gosto
            de cada cliente e ainda existe a possibilidade de entregar as suas compras em casa. </p>
    </div>
    <div id="footer">
    </div>
</div>
</body>

</html>

