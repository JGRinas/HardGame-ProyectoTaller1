<main>
    <div class="container usersContainer">

        <?php $session = session(); ?>


        <div class="row">

            <table class="table">
                <tr>
                    <th scope="col">fecha de compra</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ver detalles</th>
                </tr>

                <? if ($sales) : ?>
                    <?php foreach ($sales as $sale) : ?>

                        <?= "<tr scope='row' class='rowConsult'>"; ?>
                        <?= "<td>" . $sale['created_at'] . "</td>"; ?>
                        <?= "<td>" . $sale['email'] . "</td>"; ?>
                        <?= "<td>" . $sale['name'] ." ". $sale['surname'] . "</td>"; ?>
                        <td>
                            <a href="<?php echo base_url('userController/downloadPdfSale?id_sale=' . $sale['id_sale']); ?>" class="btn btn-info" role="button"><span class="material-symbols-outlined">visibility</span></a>
                        </td>
                        </tr>
                    <?php endforeach ?>
                <? endif; ?>

            </table>
        </div>
    </div>
</main>