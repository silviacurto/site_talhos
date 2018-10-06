<?php
require("config.php");

if (
    !isset($_GET["categoria_id"]) ||
    empty($_GET["categoria_id"]) ||
    !is_numeric($_GET["categoria_id"])
) {
    die("categoria invalida");
}

$query = $db->prepare("
		SELECT p.produto_id, p.nome, c.nome AS categoria
		FROM produtos AS p
		INNER JOIN categorias c USING(categoria_id)
		where p.categoria_id = ?
	");

$query->execute(array($_GET["categoria_id"]));

$produtos = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($produtos)) {
    header("HTTP/1.1 404 Not Found");
    die("Não existem produtos para esta categoria");
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Categorias - Talhos do Carlos</title>
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
        <div id="main">
            <h1><?php echo $produtos[0]["categoria"]; ?></h1>
            <ul>
                <?php
                foreach ($produtos as $produto) {
                    echo '
			<li>
				<a href="produtoinfo.php?produto_id=' . $produto["produto_id"] . '">' . $produto["nome"] . '</a>
			</li>
		';
                }
                ?>
            </ul>
            <nav>
                <a href="loja.php">Voltar a loja</a>
            </nav>
        </div>
</body>

</html>