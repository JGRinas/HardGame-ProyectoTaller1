<br>
<main class="container">

    <div class="jumbotron" id="lista-productos-vista">
        <h6 class="display-4 text-uppercase font-weight-bold"><?= $product['title'] ?></h6>
        <hr class="my-4">
        <img class="" src="<?= base_url('public/assets/img/uploads/' . $product['image']) ?>" alt="Card image">
        <hr class="my-4">
        <p class="lead "><?= $product['description'] ?></p>
        <hr class="my-4">
        <div class="precio">Precio: $<span><?= $product['price'] ?></span></div>

        <div class="stock">Stock: <span class=""><?= $product['stock'] ?></span></div>

    </div>

</main>