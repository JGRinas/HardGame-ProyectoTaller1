<?php
$dataClient = [
    'type' => 'text',
    'id' => 'cliente',
    'name' => 'cliente',
    'placeholder' => 'Ingrese su nombre',
    'value' => session('name').' '.session('surname'),
    'disabled' => true
];

$dataEmail = [
    'type' => 'email',
    'id' => 'correo',
    'placeholder' => 'Ingrese su correo',
    'value' => session('email'),
    'disabled'=> true
];
$session = session();
?>

<main class="container">

    <div class="col">
        <br>
        <h2 class="d-flex justify-content-center mb-3">Detalles de la compra</h2>
        <?= "<h6>".$session->getFlashdata('stockError') ."</h6>"?>
        <div class="form-group row">
            <?= form_label('Cliente', 'cliente') ?>
            <?= form_input($dataClient) ?>
        </div>

        <div class="form-group row">
            <?= form_label('Correo', 'correo') ?>
            <?= form_input($dataEmail) ?>
        </div>

        <div id="carrito" class="table-responsive">
            <table class="table" id="lista-compra">
                <thead>
                    <tr>
                        
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Eliminar</th>
                    </tr>

                </thead>

                <tbody id="eliminar-producto-compra">
                    
                    <?php if ($cart) : ?>
                        <?php foreach ($cart->contents() as $product) : ?>
                            <tr>
                            
                                <th scope="col"><?= $product['name']?></th>
                                <th scope="col"><?= $product['qty']?></th>
                                <th scope="col"><?= $product['price']?></th>
                                <th scope="col"><?= $product['subtotal']?></th>
                                <th scope="col"><a href="" class="borrar-producto-compra fas fa-times-circle" data-id="<?=$product['id']?>"></a></th>
                                <th scope="col" class="hide" id="rowid"><?= $product['rowid']?></th>

                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>

                <tr>
                    <th colspan="4" scope="col" class="text-right">TOTAL : $<?= $cart->total(); ?></th>
                    <th scope="col">
                        <p id="total"></p>
                    </th>
                </tr>
            </table>
        </div>

        <div class="row justify-content-center" id="loaders">
            <img id="cargando" src="<?php echo base_url('public/assets/img/cargando.gif') ?>" width="220">
        </div>

        <div class="row justify-content-between">

            <div class="col-md-4 mb-2">
                <a href="<?php echo base_url('products') ?>" class="btn btn-info btn-block">Seguir comprando<a>
            </div>

            <div class="col-xs-12 col-md-4">
                <a href="" class="btn btn-success btn-block" id="procesar-compra">Realizar compra</a>
            </div>

        </div>

    </div>
    <br>
</main>