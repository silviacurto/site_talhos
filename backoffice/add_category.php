<?php
require("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $db->prepare("INSERT INTO categorias (nome) VALUES (?)");
    $result = $query->execute(
        array($_POST["nome"])
    );

    if (!$result) {
        $_SESSION["erro"] = "Falha ao guardar dados da categoria";
        header("Refresh:0");
        die();
    }

    $_SESSION["sucesso"] = "Categoria criada com sucesso";
    header("Location: index.php");
    die();
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
    <h3 class="my-3">Adicionar categoria</h3>
    <form action="add_category.php" method="post" enctype="multipart/form-data">
        <div class="form-group row my-4">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da categoria">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Gravar</button>
            </div>
        </div>
    </form>

<?php

include("footer.php");