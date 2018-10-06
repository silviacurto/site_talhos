<?php
require("config.php");

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Especialidades - Talhos do Carlos</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css"/>

    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/especialidades.js"></script>

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
                <li class="active"><a href="especialidades.php">Especialidades</a></li>
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
    </div>
    <div id="main">
        <h1>Especialidades</h1>
        <div class="carrossel">
            <div><img src="imagens/almondegas.jpg" alt=""></div>
            <div><img src="imagens/espetadas.jpg" alt=""></div>
            <div><img src="imagens/rolo.jpg" alt=""></div>
            <div><img src="imagens/perna.jpg" alt=""></div>
        </div>

    </div>
    <div id="footer">
    </div>
</div>
<script src="js/slick.min.js"></script>

</body>

</html>