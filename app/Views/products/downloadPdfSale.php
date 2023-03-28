<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo base_url('public/assets/js/html2pdf.bundle.min.js'); ?>"></script>

    <script src="<?php echo base_url('public/assets/js/descargarPdf.js'); ?>"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="<?php echo base_url('public/assets/css/bootstrap.min.css') ?>">
    <title>Detalles compra</title>
</head>

<body>
<? if ($purchases) : ?>
                    <?php $products = '' ?>
                    <?php $date = '' ?>
                    <?php $email = '' ?>
                    <?php $price = 0; $qty='';?>
                    <?php foreach ($purchases as $purchase) : ?>
                        
                        <?php $date = $purchase['created_at'] ?>
                        <?php $products = $products  . $purchase['title']. "</br>"?>
                        <?php $qty = $qty . $purchase['detail_qty']. "</br>"?>
                        <?php $price += $purchase['detail_price']*$purchase['detail_qty'] ?>
                    <?php endforeach ?>
            <? endif; ?>

    <div class="card text-center">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5>HardGame
                </h5>
            </div>
            <div>
            <h3>Detalle de la compra</h3>
            </div>
            <div>
            <img src="<?php echo base_url('public/assets/img/logo-header.svg') ?>" width="100" height="100"  alt="">
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Email comprador: <?= session('email') ?></h5>
            <h5 class="card-title">Nombre comprador: <?= session('name'). " " . session('surname')?></h5>
    
            <table class="table d-flex justify-content-center">
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
            </tr>
            <tr >
                <td><?=$products?></td>
                <td><?=$qty?></td>
            </tr>
            </table>
        
            

            <h5 class="card-title">total: $<?= $price?></h5>
            <button class="btn btn-primary btnDescargarPdf material-symbols-outlined">file_download</button>
        </div>
        <div class="card-footer text-muted">
        Fecha: <?= $date ?>
        </div>
    </div>
</body>

</html>