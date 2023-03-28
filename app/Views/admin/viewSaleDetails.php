<main>
    <div class="container usersContainer">

        <?php $session = session(); ?>
   

        <div class="row">

            <table class="table">
                <tr>
                    <th scope="col">fecha</th>
                    <th scope="col">Productos/cantidad</th>
                    <th scope="col">Precio total</th>
                    <th scope="col">Volver atrás</th>
                </tr>

                <? if ($sales) : ?>
                    <?php $products = '' ?>
                    <?php $date = '' ?>
                    <?php $price = 0 ?>
                    <?php foreach ($sales as $sale) : ?>

                        <?php $date = $sale['created_at'] ?>
                        <?php $products = $products  . $sale['title'] ." / ". $sale['detail_qty']. "</br>"?>
                        <?php $price += $sale['detail_price']*$sale['detail_qty'] ?>
                    <?php endforeach ?>

                    <?= "<tr scope='row' class='rowConsult'>"; ?>
                    <?= "<td>" . $date . "</td>"; ?>
                    <?= "<td>" .  $products . "</td>"; ?>
                    <?= "<td>" .  $price . "</td>"; ?>
                    <td>
                        <a href="javascript:history.back()" class="btn btn-info" role="button"><span class="material-symbols-outlined">arrow_back</span></a>
                    </td>
                    </tr>
                <? endif; ?>

            </table>
        </div>
    </div>
</main>