<?php
require("config.php");

$query = $db->prepare("SELECT categoria_id, nome FROM categorias");

$query->execute();

$categorias = $query->fetchAll(PDO::FETCH_ASSOC);

include("head.php");
include("navbar.php");

?>
    <div class="row my-4">
        <?php
        if (isset($_SESSION["sucesso"])) {
            ?>
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION["sucesso"]; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php
        }
        unset($_SESSION["sucesso"]);
        ?>
        <div class="col-lg-12 mb-3">
            <a href="add.php" class="btn btn-primary my-1">Adicionar produto</a>
            <a href="add_category.php" class="btn btn-primary my-1">Adicionar categoria</a>
            <?php
            if (isset($_GET["categoria_id"])) {
                echo "<a href='remove_category.php?id=" . $_GET["categoria_id"] . "' class='btn btn-danger my-1'>Remover categoria</a>";
            }
            ?>
        </div>
        <div class="col-lg-3">

            <h1 class="my-4">Categorias</h1>
            <div class="list-group">
                <?php
                foreach ($categorias as $categoria) {
                    echo '<a class="list-group-item';
                    if (isset($_GET["categoria_id"]) && $categoria["categoria_id"] === $_GET["categoria_id"]) {
                        echo ' active';
                    }
                    echo '" href="?categoria_id=' . $categoria["categoria_id"] . '">' . $categoria["nome"] . '</a>';
                }
                ?>
            </div>

        </div>

        <div class="col-lg-9">

            <div class="row">

                <?php

                if (isset($_GET["categoria_id"]) &&
                    !empty($_GET["categoria_id"]) &&
                    is_numeric($_GET["categoria_id"])
                ) {
                    $query = $db->prepare("
                            SELECT p.produto_id, p.nome, p.stock, c.nome AS categoria, p.preco, p.imagem
                            FROM produtos AS p
                            INNER JOIN categorias c USING(categoria_id)
                            where p.categoria_id = ?
                        ");

                    $query->execute(array($_GET["categoria_id"]));

                    $produtos = $query->fetchAll(PDO::FETCH_ASSOC);
                    if (count($produtos) === 0) {
                        echo "<h3>Sem produtos</h3>";
                    }
                    foreach ($produtos as $produto) {
                        echo '<div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="card-img-top" src="../imagens_loja/' . $produto["imagem"] . '" alt="">
                                        <h4 class="card-title">
                                            <a href="edit.php?produto_id=' . $produto["produto_id"] . '">' . $produto["nome"] . '</a>
                                        </h4>
                                        <h5>€ ' . $produto["preco"] . '</h5>
                                        <p>' . $produto["stock"] . ' em stock</p>
                                    </div>
                                </div>
                            </div>';
                    }
                } else {
                    ?>
                    <h4 class="ml-3 my-4">Por favor seleccione uma categoria.</h4>
                    <?php
                }
                ?>
            </div>

        </div>

    </div>

<?php

include("footer.php");