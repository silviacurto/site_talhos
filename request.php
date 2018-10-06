<?php


require("config.php");

if (
    $_POST["request"] === "remove" &&
    !empty($_POST["produto_id"]) &&
    is_numeric($_POST["produto_id"]) &&
    isset($_SESSION["cart"])

) {


    unset($_SESSION["cart"][(int)$_POST["produto_id"]]);

    if (empty($_SESSION["cart"])) {

        unset($_SESSION["cart"]);
    }


    die("true");


} elseif (

    $_POST["request"] === "updateCart" &&
    !empty($_POST["produto_id"]) &&
    !empty($_POST["quantity"]) &&
    is_numeric($_POST["produto_id"]) &&
    is_numeric($_POST["quantity"]) &&
    $_POST["quantity"] > 0 &&
    isset($_SESSION["cart"])
) {


    $query = $db->prepare("
			SELECT stock
			FROM produtos
			WHERE produto_id = ? AND stock >= ?
		
		");

    $query->execute(
        array(
            (int)$_POST["produto_id"],
            (int)$_POST["quantity"]
        )
    );

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!empty($result)) {
        $_SESSION["cart"][(int)$_POST["produto_id"]]["quantity"] = (int)$_POST["quantity"];
        die("true");
    }
}

