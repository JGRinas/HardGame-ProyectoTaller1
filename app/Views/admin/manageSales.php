<main>
    <div class="container usersContainer">

        <?php $session = session(); ?>
        <?= $session->getFlashdata('deleteUserError'); ?>

        <div class="row">

            <table class="table">
                <tr>
                    <th scope="col">fecha</th>
                    <th scope="col">id</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ver detalles</th>
                </tr>

                <? if ($sales) : ?>
                    <?php foreach ($sales as $sale) : ?>

                        <?= "<tr scope='row' class='rowConsult'>"; ?>
                        <?= "<td>" . $sale['created_at'] . "</td>"; ?>
                        <?= "<td>" . $sale['id_sale'] . "</td>"; ?>
                        <?= "<td>" . $sale['email'] . "</td>"; ?>
                        <?= "<td>" . $sale['name'] ." ". $sale['surname'] . "</td>"; ?>
                        <td>
                            <a href="<?php echo base_url('viewSaleDetails?id_sale=' . $sale['id_sale']); ?>" class="btn btn-info" role="button"><span class="material-symbols-outlined">visibility</span></a>
                        </td>
                        </tr>
                    <?php endforeach ?>
                <? endif; ?>

            </table>
        </div>
    </div>
</main>