<?php
require("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES["imagem"])) {
        $fileTemporaryName = $_FILES["imagem"]["tmp_name"];
        $fileName = $_FILES["imagem"]["name"];

        $currentDirectory = getcwd();
        $uploadPath = $currentDirectory . "/../imagens_loja/" . basename($fileName);

        $upload = move_uploaded_file($fileTemporaryName, $uploadPath);

        if (!$upload) {
            $_SESSION["erro"] = "Falha ao guardar imagem do produto";
            header("Refresh:0");
            die();
        }

        $query = $db->prepare("INSERT INTO produtos (nome,peso,preco,stock,categoria_id,imagem) VALUES (?,?,?,?,?,?)");
        $result = $query->execute(
            array($_POST["nome"], $_POST["peso"], $_POST["preco"], $_POST["stock"], $_POST["categoria"],
                basename($fileName))
        );
    } else {
        $_SESSION["erro"] = "O produto precisa de uma imagem!";
        header("Refresh:0");
        die();
    }

    if (!$result) {
        $_SESSION["erro"] = "Falha ao guardar dados do produto";
        header("Refresh:0");
        die();
    }

    $_SESSION["sucesso"] = "Alterações ao produto guardadas com sucesso";
    header("Location: index.php?categoria_id=" . $_POST["categoria"]);
    die();
}

$query = $db->prepare("SELECT categoria_id, nome FROM categorias");
$query->execute();
$categorias = $query->fetchAll(PDO::FETCH_ASSOC);

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
    <h3 class="my-3">Adicionar produto</h3>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <div class="form-group row my-4">
            <label for="categoria" class="col-sm-2 col-form-label">Categoria</label>
            <div class="col-sm-10">
                <select id="categoria" name="categoria" class="form-control">
                    <?php
                    foreach ($categorias as $categoria) {
                        echo '<option value="' . $categoria["categoria_id"] . '">' . $categoria["nome"] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row my-4">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do produto">
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
                <input type="text" class="form-control" id="peso" name="peso" placeholder="Peso">
            </div>
        </div>

        <div class="form-group row">
            <label for="preco" class="col-sm-2 col-form-label">Preço (€)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="preco" name="preco" placeholder="Preço">
            </div>
        </div>

        <div class="form-group row">
            <label for="stock" class="col-sm-2 col-form-label">Stock</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="stock" name="stock" min="0" step="1">
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