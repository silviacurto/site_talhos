<?php
require("config.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    die();
}

if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {

    $query = $db->prepare("
		
			INSERT INTO orders
			(user_id, order_date, paid, status)
			VALUES(?, NOW(), 0, 'Not Shipped')
		");

    $query->execute(array($_SESSION["user_id"]));

    $order_id = $db->lastInsertId();

    foreach ($_SESSION["cart"] as $item) {

        $query = $db->prepare("
				INSERT INTO ordersdetails
				(order_id, product_id, preco, quantity)
				VALUES(?, ?, ?, ?)
			");

        $query->execute(

            array(
                $order_id,
                $item["produto_id"],
                $item["preco"],
                $item["quantity"]

            )
        );

        $query = $db->prepare("
			
				UPDATE produtos
				SET stock = stock - ?
				WHERE produto_id = ?
			
			");

        $query->execute(
            array(
                $item["quantity"],
                $item["produto_id"])
        );
    }

    unset($_SESSION["cart"]);

    die("Encomenda efectuada com sucesso, vai receber os detalhes por email");

} else {
    header("Location:loja.php");
    die();
}





