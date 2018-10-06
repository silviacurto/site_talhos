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

    if (
        !empty($_POST["nome"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        !empty($_POST["morada"]) &&
        !empty($_POST["codigo_postal"]) &&
        !empty($_POST["cidade"]) &&
        strlen($_POST["nome"]) <= 64 &&
        strlen($_POST["morada"]) <= 255 &&
        strlen($_POST["codigo_postal"]) <= 32 &&
        strlen($_POST["cidade"]) <= 125 &&
        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
        $_POST["password"] === $_POST["repeat_password"]
    ) {
        $query = $db->prepare("
				INSERT INTO users
				(nome, email, password, morada, codigo_postal, cidade) 
				VALUES (?, ?, ?, ?, ?, ?)
			
			");

        $query->execute(

            array(
                $_POST["nome"],
                $_POST["email"],
                password_hash($_POST["password"], PASSWORD_DEFAULT),
                $_POST["morada"],
                $_POST["codigo_postal"],
                $_POST["cidade"]


            )

        );

        $message = "Conta criada com sucesso";
    } else {
        (print_r($_POST));
        $message = "Preencha os campos correctamente";
    }
}

?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Registo- Talhos do Carlos</title>
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
        <h1>Criação de conta - Talhos do Carlos</h1>
        <?php
        if (isset($message)) {
            echo "<p>" . $message . "</p>";
        }
        ?>

        <p>Se já tiver conta, <a href="login.php">faça login</a></p>
        <form method="post" action="register.php">
            <div>
                <label>
                    Nome
                    <input type="text" name="nome" required>
                </label>
            </div>
            <div>
                <label>
                    Email de Login
                    <input type="email" name="email" required>
                </label>
            </div>
            <div>
                <label>
                    Password
                    <input type="password" name="password" required>
                </label>
            </div>
            <div>
                <label>
                    Repetir password
                    <input type="password" name="repeat_password" required>
                </label>
            </div>
            <div>
                <label>
                    Morada
                    <input type="text" name="morada" required>
                </label>
            </div>
            <div>
                <label>
                    Codigo-postal
                    <input type="text" name="codigo_postal" required>
                </label>
            </div>
            <div>
                <label>
                    Cidade
                    <input type="text" name="cidade" required>
                </label>
            </div>
            <div>
                <input type="submit" name="send" value="Registar" required>
            </div>
        </form>
</body>

</html>