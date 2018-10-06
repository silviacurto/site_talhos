<?php
require("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //TODO validar os inputs

    if (isset($_FILES["imagem"])) {
        $fileTemporaryName = $_FILES["imagem"]["tmp_name"];
        $fileName = $_FILES["imagem"]["name"];

        $currentDirectory = getcwd();
        $uploadPath = $currentDirectory . "/../imagens_loja/" . basename($fileName);

        $upload = move_uploaded_file($fileTemporaryName, $uploadPath);

        if (!$upload) {
            $_SESSION["erro"] = "Falha ao guardar imagem do produto";
            header("Location: edit.php?produto_id=" . $_POST["produto_id"]);
            die();
        }

        $query = $db->prepare("UPDATE produtos SET nome=?, peso=?, preco=?, stock=?, categoria_id=?, imagem=? WHERE produto_id = ?");
        $result = $query->execute(
            array($_POST["nome"], $_POST["peso"], $_POST["preco"], $_POST["stock"], $_POST["categoria"], basename($fileName), $_POST["produto_id"])
        );
    } else {
        $query = $db->prepare("UPDATE produtos SET nome=?, peso=?, preco=?, stock=?, categoria_id=? WHERE produto_id = ?");
        $result = $query->execute(
            array($_POST["nome"], $_POST["peso"], $_POST["preco"], $_POST["stock"], $_POST["categoria"], $_POST["produto_id"])
        );
    }

    if (!$result) {
        $_SESSION["erro"] = "Falha ao guardar dados do produto";
        header("Location: edit.php?produto_id=" . $_POST["produto_id"]);
        die();
    }

    $_SESSION["sucesso"] = "Alterações ao produto guardadas com sucesso";
    header("Location: index.php?categoria_id=" . $_POST["categoria"]);
    die();
}

if (!isset($_GET["produto_id"])) {
    header("Location: index.php");
    die();
}

$query = $db->prepare("SELECT categoria_id, nome FROM categorias");
$query->execute();
$categorias = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT * FROM produtos WHERE produto_id = ?");
$query->execute(array($_GET["produto_id"]));
$produto = $query->fetch(PDO::FETCH_ASSOC);

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
    <h3 class="my-3">Editar produto</h3>
    <form action="edit.php" method="post" enctype="multipart/form-data">
        <div class="form-group row my-4">
            <label for="categoria" class="col-sm-2 col-form-label">Categoria</label>
            <div class="col-sm-10">
                <select id="categoria" name="categoria" class="form-control">
                    <?php
                    foreach ($categorias as $categoria) {
                        echo '<option ';
                        if ($produto["categoria_id"] === $categoria["categoria_id"]) {
                            echo 'selected ';
                        }
                        echo 'value="' . $categoria["categoria_id"] . '">' . $categoria["nome"] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row my-4">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do produto"
                       value="<?php echo $produto["nome"]; ?>">
            </div>
        </div>

        <div class="form-group row my-4">
            <label class="col-sm-2 col-form-label">Imagem</label>
            <div class="col-sm-10">
                <img src="../imagens_loja/<?php echo $produto["imagem"]; ?>" alt="" class="img-thumbnail">
            </div>
        </div>

        <div class="form-group row my-4">
            <label for="imagem" class="col-sm-2 col-form-label">Nova imagem</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="imagem" name="imagem">
            </div>
        </div>

        <div class="form-group row">
            <label for="peso" class="col-sm-2 col-form-label">Peso</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="peso" name="peso" placeholder="Peso"
                       value="<?php echo $produto["peso"]; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="preco" class="col-sm-2 col-form-label">Preço (€)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="preco" name="preco" placeholder="Preço"
                       value="<?php echo $produto["preco"]; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="stock" class="col-sm-2 col-form-label">Stock</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="stock" name="stock" min="0" step="1"
                       value="<?php echo $produto["stock"]; ?>">
            </div>
        </div>

        <input type="text" name="produto_id" hidden value="<?php echo $produto["produto_id"]; ?>">

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Gravar</button>
                <a class="btn btn-danger" href="remove.php?id=<?php echo $produto["produto_id"]; ?>">Apagar</a>
            </div>
        </div>
    </form>

<?php

include("footer.php");