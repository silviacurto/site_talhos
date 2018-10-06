<?php

require("config.php");

if (
    !isset($_GET["produto_id"]) ||
    empty ($_GET["produto_id"]) ||
    !is_numeric($_GET["produto_id"])
) {

    die("Produto Invalido");
}

$query = $db->prepare("
		SELECT produto_id, nome, peso, imagem, preco, stock, categoria_id
		FROM produtos
		WHERE produto_id = ?
	");

$query->execute(array($_GET["produto_id"]));

$produto = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($produto)) {
    header("HTTP/1.1 404 Not Found");
    die("produto inesxistente");
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title><?php echo $produto[0]["nome"]; ?> - Talhos do Carlos</title>
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
                <li class="active"><a href="loja.php">Loja</a></li>
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


    <main>
        <div class="info">
            <h1><?php echo $produto[0]["nome"]; ?></h1>
            <div><img src="imagens_loja/<?php echo $produto[0]["imagem"]; ?>" alt=""></div>
            <div><?php echo $produto[0]["peso"]; ?></div>
        </div>
        <div class="cart">
            <div class="preco">€ <?php echo $produto[0]["preco"]; ?></div>

            <?php

            if ($produto[0]["stock"] > 0) {

                ?>
                <div class="add_cart">

                    <form method="post" action="cart.php">
                        <label>
                            Quantidade
                            <input type="number" name="quantity" value="1" min="1"
                                   max="<?php echo $produto[0]["stock"]; ?>" required>
                        </label>
                        <input type="hidden" name="produto_id" value="<?php echo $produto[0]["produto_id"]; ?>">
                        <input type="submit" name="send" value="Adicionar ao Carrinho">
                    </form>
                </div>

                <?php
            } else {

                echo "<p>Lamentamos, mas o produto está esgotado</p>";
            }
            ?>
        </div>
        <nav>
            <a href="loja.php">Voltar ao Início</a>
            <a href="produtos.php?categoria_id=<?php echo $produto[0]["categoria_id"]; ?>">Voltar atrás</a>
        </nav>
    </main>
</div>
</body>
</html>

