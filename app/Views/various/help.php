<?php

$dataName = [
    'type' => 'text',
    'name' => 'name',
    'id' => 'name',
    'value' => session('name') . ' ' . session('surname'),
    'disabled' => true
];

$dataEmail = [
    'type' => 'email',
    'name' => 'email',
    'id' => 'email',
    'value' => session('email'),
    'disabled' => true
];

$dataTheme = [
    'type' => 'text',
    'name' => 'theme',
    'id' => 'theme',
    'placeholder' => 'Ingrese el tema de la consulta'
];

$dataConsult = [
    'name' => 'consult',
    'id' => 'consult',
];

?>

<main class="container">

    <div class="form">

        <?= form_open('registerHelp'); ?>

        <div class="form-container">

            <div class="form-group">
                <?= form_input($dataName); ?>
            </div>

            <div class="form-group">
                <?= form_input($dataEmail); ?>
            </div>

            <div class="form-group">
                <?= form_input($dataTheme); ?>
                <?php if($infoE){echo $infoE['theme'];}?>
            </div>

            <div class="form-group">
                <?= form_textarea($dataConsult); ?>
                <p><?php if($infoE){echo $infoE['consult'];}?></p>
            </div>
            
            

            <div class="form-group">
                <?= form_submit('registerHelp', 'Enviar consulta', "class = 'btn btn-primary'"); ?>
            </div>

            <div class="form-group">
                <a href="consultSend" class="btn btn-success btn-block" >ver consultas enviadas</a>
            </div>

        </div>

        <?= form_close(); ?>
    </div>

</main>