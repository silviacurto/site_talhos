<?php
require("config.php");

if (isset($_POST["send"])) {

    if (
        !empty($_POST["produto_id"]) &&
        !empty($_POST["quantity"]) &&
        is_numeric($_POST["produto_id"]) &&
        is_numeric($_POST["quantity"]) &&
        $_POST["quantity"] > 0
    ) {
        $query = $db->prepare("
				SELECT produto_id, nome, peso, preco, stock 
				FROM produtos
				WHERE produto_id = ? AND stock >= ?
			");

        $query->execute(
            array($_POST["produto_id"], $_POST["quantity"])
        );

        $produto = $query->fetch(PDO::FETCH_ASSOC);

        if (!empty($produto)) {

            if (isset($_SESSION["cart"][$produto["produto_id"]])) {
                // Se o produto existir, adicionar apenas a quantidade
                $_SESSION["cart"][$produto["produto_id"]]["quantity"] += (int)$_POST["quantity"];
            } else {
                // Se o produto não existir no carrinho ainda, adicioná-lo
                $_SESSION["cart"][$produto["produto_id"]] = array(
                    "produto_id" => $produto["produto_id"],
                    "nome" => $produto["nome"],
                    "preco" => $produto["preco"],
                    "stock" => $produto["stock"],
                    "quantity" => (int)$_POST["quantity"]
                );
            }
        }
    }

    header("Location: cart.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Carrinho - Talhos do Carlos</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        table, tr, th, td {
            border: 1px solid darkgrey;
            border-collapse: collapse;
        }
        table {
            margin-left: 10px;
            margin-top: 20px;
        }
    </style>
    <script>
        window.onload = function () {

            var removeButtons = document.querySelectorAll(".remove");
            var inputQuantity = document.querySelectorAll(".quantity");

            for (var i = 0; i < removeButtons.length; i++) {

                removeButtons[i].onclick = function () {

                    var params = "request=remove&produto_id=" + this.dataset.produto_id;
                    var button = this;

                    var xhr = new XMLHttpRequest();

                    xhr.open("POST", "request.php", true);

                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onload = function () {
						location.reload();
                    };

                    xhr.send(params);
                };

                inputQuantity[i].onchange = function () {

                    var params = "request=updateCart&quantity=" + this.value + "&produto_id=" + this.dataset.produto_id;
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "request.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onload = function () {
						location.reload();
                    };
                    xhr.send(params);
                }
            }
        }
    </script>
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
                <li class="active"><a href="cart.php">Ver Carrinho</a></li>
                <?php
                if (isset($_SESSION["user_id"])) {

                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {

                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
            </ul>
        </div>

        <?php
        if (isset($_SESSION["cart"])) {
            ?>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Subtotais</th>
                    <th></th>
                </tr>
                <?php
                $total = 0;

                foreach ($_SESSION["cart"] as $item) {

                    $subtotal = $item["preco"] * $item["quantity"];

                    echo '
			<tr>
				<td>' . $item["nome"] . '</td>
				<td>€ ' . $item["preco"] . '</td>
				<td>
					<input data-produto_id="' . $item["produto_id"] . '" class="quantity" type="number" min="1" max="' . $item["stock"] . '" value="' . $item["quantity"] . '">
				</td>
				<td>€ ' . ($item["preco"] * $item["quantity"]) . '</td>
				<td><input data-produto_id="' . $item["produto_id"] . '" class="remove" type="button" value="X"></td>
			</tr>
		';
                    $total = $total + $subtotal;
                }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Total</strong></td>
                    <td>€ <?php echo $total; ?></td>
                    <td></td>
                </tr>
            </table>

            <?php
        } else {

            echo "<p>Ainda não colocou nada no carrinho</p>";

        }
        ?>

        <nav>
            <a href="loja.php">Voltar ao Início</a>
            <a href="finalizar_compra.php">Efectuar compra</a>

        </nav>
    </div>
</div>
</body>
</html>
