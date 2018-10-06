<?php
require("config.php");

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Contactos - Talhos do Carlos</title>
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
        <div id="menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="especialidades.php">Especialidades</a></li>
                <li><a href="receitas.php">Receitas</a></li>
                <li class="active"><a href="contactos.php">Contactos</a></li>
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
        <h1>Os nossos contactos:</h1>
        <p>Rua Dr. Manuel Pacheco Nobre nº19, Barreiro</p>
        <p><strong>Contacto:</strong> 21 204 84 79</p>
        <div id="mapa1">
            <iframe src="https://www.google.com/maps/embed?pb=!4v1529000365521!6m8!1m7!1sGpqjaAFcMgSSPnVu4oSaQg!2m2!1d38.66003265874892!2d-9.06360445337914!3f131.8592939404136!4f3.2602203917439994!5f0.7820865974627469"
                    width="600" height="450" frameborder="0" style="border:0" allowfullscreen
                    sandbox="allow-scripts"></iframe>
        </div>
        <p>Mercado Municipal 1º de Maio loja 4, Barreiro</p>
        <p><strong>Contacto:</strong> 21 019 01 46</p>
        <div id="mapa2">
            <iframe src="https://www.google.com/maps/embed?pb=!4v1529007616237!6m8!1m7!1sjpyh43ehWsJktDpIEvyl7g!2m2!1d38.66183222082108!2d-9.077925038389594!3f239.64800251235317!4f-3.376013598894801!5f1.1924812503605782"
                    width="600" height="450" frameborder="0" style="border:0" allowfullscreen
                    sandbox="allow-scripts"></iframe>
        </div>
        <p>Rua 1º de Maio nº66, Baixa da Banheira</p>
        <p><strong>Contactos:</strong> 21 202 38 80</p>
        <div id="mapa3">
            <iframe src="https://www.google.com/maps/embed?pb=!4v1529007752305!6m8!1m7!1sLauzCZx5nnHqAf2g8eRmtA!2m2!1d38.65714193615209!2d-9.043170050902587!3f295.1945846754802!4f-2.7913464949569686!5f0.7820865974627469"
                    width="600" height="450" frameborder="0" style="border:0" allowfullscreen
                    sandbox="allow-scripts"></iframe>
        </div>
    </div>
    <div id="footer">
    </div>
</div>
</body>

</html>