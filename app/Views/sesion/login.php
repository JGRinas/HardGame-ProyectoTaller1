<main class="form">

<div class="form-content"> 
<?php

echo form_open('loginUser');

$dataEmail = [
    'type' => 'email',
    'name' => 'emailL', 
    'id' => 'emailL',
    'placeholder' => 'Ingrese su correo'
];

$dataPass = [
  'name' => 'passL', 
  'id' => 'passL',
  'placeholder' => 'Ingrese su contraseña'
];
?>

<?php
$session = session();
echo "<h3>".$session->getFlashdata('loginError')."</h3>"
?>
<div class="form-group">
    <?= form_input($dataEmail) ?>
</div>

<div class="form-group">
    <?= form_password($dataPass) ?>
</div>

<div class="form-group">
<?= form_submit('loginUser', 'Iniciar Sesion', 'class = "btn btn-primary"');?>
</div>
</div>
<div class="form-group">
  <p>¿No tienes una cuenta? <a href="register">¡Regístrate!</a></p>
</div>
<?php echo form_close(); ?>

</main>
