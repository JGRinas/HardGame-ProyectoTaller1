<main>
    <div class="container usersContainer">

        <?php $session = session(); ?>
        <?= $session->getFlashdata('deleteProductError'); ?>

        <div class="row">

            <table class="table">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acción</th>
                </tr>

                <? if ($products) : ?>
                    <?php foreach ($products as $product) : ?>
                        <?php if ($product['deleted_at'] === null) { ?>
                            <?= "<tr scope='row' class='rowConsult'>"; ?>
                            <?= "<td>" . $product['title'] . "</td>"; ?>
                            <?php foreach($brand as $br){
                                if($br['brand_id'] == $product['brand']){
                                    echo "<td>" . $br['brand_desc']. "</td>";
                                }
                            }?>
                         
                            <?php foreach($category as $cat){
                                if($cat['category_id'] == $product['category']){
                                    echo "<td>" . $cat['category_desc']. "</td>";
                                }
                            }?>
                         
                            <?= "<td><textarea class='textareaConsult' disabled>" . $product['description'] . "</textarea></td>"; ?>
                            <?= "<td>$" . $product['price'] . "</td>"; ?>
                            <?= "<td>" . $product['stock'] . "</td>"; ?>
                            <?= "<td><img width='100' src=" . base_url('public/assets/img/uploads/' . $product['image']) . "></td>"; ?>
                            <td>

                                <a href="<?php echo base_url('/AdminController/deleteProduct?id=' . $product['id']); ?>" class="btn btn-danger" role="button"><span class="material-symbols-outlined">delete</span></a>

                                <a href="<?php echo base_url('registerProducts?id=' . $product['id']); ?>" class="btn btn-primary" role="button"><span class="material-symbols-outlined">edit_note</span></a>

                            <?php } else { ?>

                                <?= "<tr scope='row' class='rowConsult bg-secondary'>"; ?>
                                <?= "<td>" . $product['title'] . "</td>"; ?>
                                <?= "<td>" . $product['brand'] . "</td>"; ?>
                                <?= "<td>" . $product['category'] . "</td>"; ?>
                                <?= "<td><textarea class='textareaConsult' disabled>" . $product['description'] . "</textarea></td>"; ?>
                                <?= "<td>$" . $product['price'] . "</td>"; ?>
                                <?= "<td>" . $product['stock'] . "</td>"; ?>
                                <?= "<td><img width='100' src=" . base_url('public/assets/img/uploads/' . $product['image']) . "></td>"; ?>
                            <td>

                                <a href="<?php echo base_url('/AdminController/restoreProduct?id=' . $product['id']); ?>" class="btn btn-warning" role="button"><span class="material-symbols-outlined">restore_from_trash</span></a>

                            <?php } ?>
                        <?php endforeach ?>
                    <? endif; ?>

            </table>
        </div>


    </div>
</main>