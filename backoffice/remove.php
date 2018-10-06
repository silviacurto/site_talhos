<?php
require("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $db->prepare("DELETE FROM produtos WHERE produto_id = ?");
    $result = $query->execute(
        array($_POST["id"])
    );

    if (!$result) {
        $_SESSION["erro"] = "Falha ao apagar a produto";
        header("Refresh:0");
        die();
    }

    $_SESSION["sucesso"] = "Produto apagado com sucesso";
    header("Location: index.php");
    die();
} else {
    if (!isset($_GET["id"])) {
        header("Location: index.php");
        die();
    }

    $query = $db->prepare("SELECT * FROM produtos WHERE produto_id = ?");
    $query->execute(array($_GET["id"]));
    $categoria = $query->fetch(PDO::FETCH_ASSOC);
}

include("head.php");
include("navbar.php");

?>
<?php
if (isset($_SESSION["erro"])) {
    ?>
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION["erro"]; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    <?php
}
unset($_SESSION["erro"]);
?>
    <div class="row mt-3 ml-1">
        <a href="index.php">< Voltar atrás</a>
    </div>
    <h3 class="my-3">Eliminar produto <?php echo $categoria["nome"]; ?>?</h3>
    <form action="remove.php" method="post" enctype="multipart/form-data">
        <input type="text" name="id" hidden value="<?php echo $_GET["id"]; ?>">
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </form>

<?php

include("footer.php");