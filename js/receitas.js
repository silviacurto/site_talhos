window.onload = function () {
    var recipe_list = document.getElementById("recipe_list");
    var recipe_anchors = recipe_list.querySelectorAll("a");

    for (var i = 0; i < recipe_anchors.length; i++) {

        recipe_anchors[i].onclick = function (e) {

            // Esconde todos as receitas antes de mostrar a nova receita seleccionada
            for (var j = 0; j < recipe_anchors.length; j++) {
                document.querySelectorAll("#main .receita")[j].style.display = "none";
            }

            document.querySelector(this.dataset.id).style.display = "block";

            e.preventDefault();
        }

    }
};

 

