    <main>
        <div class="container-grid">
            <section class="sidebar-options card mb-4 ">

                <h3>Categorías</h3>
                <ul>
                    <? if ($category) : ?>
                        <?php foreach ($category as $cat) : ?>
                            <li><?= "<a href=" . base_url('products?id=' . $cat['category_id']) . ">" . $cat['category_desc'] . "</a>"; ?></li>
                        <?php endforeach ?>
                    <? endif; ?>
                </ul>
                <h3>Costo de envío</h3>
                <ul>
                    <li><a href="#">Gratis</a></li>
                </ul>

                <h3>Pago</h3>
                <ul>
                    <li><a href="">Cuotas sin interés</a> </li>
                    <li><a href="">Hasta 24 cuotas</a> </li>
                </ul>

                <h3>Precio</h3>
                <ul><?php $amount = 0; ?>
                    <?php foreach ($products as $product) : ?>

                        <?php if ($amount < $product['price']) { ?>
                            <?php $amount = $product['price'] ?>
                        <?php } ?>
                        <?php
                        $amountLow = $amount * 0.3;
                        $amountHigh = $amount * 0.6
                        ?>

                    <?php endforeach; ?>
                    <li><a href="<?php echo base_url('products?id=' . $optionCat . '?price=' . '1')  ?>">Hasta $<?php echo $amountLow; ?></a></li>
                    <li><a href="#">De $<?php echo $amountLow; ?> a $<?php echo $amountHigh; ?> </a></li>
                    <li><a href="#">Más de $<?php echo $amountHigh; ?></a></li>
                </ul>
            </section>

            <section class="nester-grid" id="lista-productos">

                <?php if ($products && $optionCat > 0) { ?>

                    <?php foreach ($products as $product) : ?>
                        <?php if ($optionCat == $product['category'] && $product['stock'] > 0) { ?>


                            <?= "<div class='product-items card mb-4 shadow-sm card-header '>" ?>
                            <br>
                            <div class="product-price">
                                <h6><?= $product['title'] ?></h6>
                            </div>
                            <div class="product-item-img">
                                <a href='#'><img src="<?= base_url('public/assets/img/uploads/' . $product['image']) ?>" alt="img" class="products-img"></a>
                            </div>

                            <div class="product-price precio">$<span class=""><?= $product['price'] ?></span></div>
                            <div class="stock hide"><span class=""><?= $product['stock'] ?></span></div>
                            <br>
                            <div><a href="<?= base_url('viewInfoProduct?id_producto=' . $product['id']) ?>" class="btn btn-block btn-info">Ver información</a></div>
                            <br>
                            <?php if (session('login')) : ?>
                                <?= form_open('addToCart'); ?>
                                <?= form_hidden('id', $product['id']); ?>
                                <?= form_hidden('image', $product['image']); ?>
                                <?= form_hidden('title', $product['title']); ?>
                                <?= form_hidden('price', $product['price']); ?>
                                <div class="dataId"><input type="submit" class="btn btn-block btn-warning agregar-carrito" data-id="<?= $product['id'] ?>" value="Agregar al carrito"></div>
                                <?= form_close(); ?>
                            <?php endif; ?>
        </div>

    <?php } ?>
    <?php endforeach; ?>
    <?php } else {
                    ($products && $optionCat == 0); ?>


        <?php foreach ($products as $product) : ?>

          <?php if($product['stock'] > 0):?>
            <?= "<div class='product-items card mb-4 shadow-sm card-header '>" ?>
            <br>
            <div class="product-price">
                <h6><?= $product['title'] ?></h6>
            </div>
            <div class="product-item-img">
                <a href='#'><img src="<?= base_url('public/assets/img/uploads/' . $product['image']) ?>" alt="img" class="products-img"></a>
            </div>

            <div class="product-price precio">$<span class=""><?= $product['price'] ?></span></div>
            <div class="stock hide"><span class=""><?= $product['stock'] ?></span></div>
            <br>
            <div><a href="<?= base_url('viewInfoProduct?id_producto=' . $product['id']) ?>" class="btn btn-block btn-info">Ver información</a></div>
            <br>
            <?php if (session('login')) : ?>
                <?= form_open('addToCart'); ?>
                <?= form_hidden('id', $product['id']); ?>
                <?= form_hidden('image', $product['image']); ?>
                <?= form_hidden('title', $product['title']); ?>
                <?= form_hidden('price', $product['price']); ?>
                <div class="dataId"><input type="submit" class="btn btn-block btn-warning agregar-carrito" data-id="<?= $product['id'] ?>" value="Agregar al carrito"></div>
                <?= form_close(); ?>
            <?php endif; ?>
            </div>
            <?php endif; ?>

        <?php endforeach; ?>
    <?php } ?>
    </section>

    </div>
    </main>