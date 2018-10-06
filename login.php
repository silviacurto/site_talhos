<?php
require("config.php");

if (isset($_SESSION["user_id"])) {
    header("Location: ./");
    die();
}


if (isset($_POST["send"])) {

    foreach ($_POST as $key => $value) {
        $_POST[$key] = strip_tags(trim($value));
    }

    if (!empty($_POST["email"]) && !empty($_POST["password"])) {

        $query = $db->prepare("
				SELECT user_id, password, administrador
				FROM users
				WHERE email=?
			
			
			");
        $query->execute(array($_POST["email"]));
        $user = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($user)) {

            if (password_verify($_POST["password"], $user[0]["password"])) {

                $_SESSION["user_id"] = $user[0]["user_id"];
                $_SESSION["administrador"] = $user[0]["administrador"];
                header("Location: index.php");
                die();
            } else {
                $message = "Dados incorrectos";
            }
        } else {

            $message = "Dados incorrectos";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Login - Talhos do Carlos</title>
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
            <li><a href="index.php">Home</a></li>
            <li><a href="especialidades.php">Especialidades</a></li>
            <li><a href="receitas.php">Receitas</a></li>
            <li><a href="contactos.php">Contactos</a></li>
            <li><a href="loja.php">Loja</a></li>
            <li><a href="cart.php">Ver Carrinho</a></li>
            <?php
            if (isset($_SESSION["user_id"])) {

                echo '<li><a href="logout.php">Logout</a></li>';
            } else {

                echo '<li class="active"><a href="login.php">Login</a></li>';
            }
            ?>

        </ul>
    </div>
    <div id="main">
        <h1>Login</h1>

        <?php
        if (isset($message)) {
            echo "<p>" . $message . "</p>";
        }


        ?>
        <p>Se ainda não tiver conta, <a href="register.php">registe-se</a></p>
        <form method="post" action="login.php">
            <div>
                <label>
                    Email de Login
                    <input type="email" name="email">
                </label>
            </div>
            <div>
                <label>
                    Password da loja
                    <input type="password" name="password" required>
                </label>
            </div>
            <div>
                <input type="submit" name="send" value="Login">
            </div>
        </form>
    </div>
</div>
</body>

</html>