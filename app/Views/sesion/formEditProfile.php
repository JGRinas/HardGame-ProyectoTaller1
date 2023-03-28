<?php

if(isset($user)){
  $name = $user['name'];
  $surname = $user['surname'];
  $username = $user['username'];
  $email = $user['email'];
  $image = $user['photo_profile'];
}else{
  $name = '';
  $surname = '';
  $username = '';
  $email = '';
  $image = '';
}

$dataName = [
  'type' => 'text',
  'name' => 'name',
  'id' => 'name',
  'placeholder' => 'Nombre',
  'value' => $name
];

$dataSurname = [
  'type' => 'text',
  'name' => 'surname',
  'id' => 'surname',
  'placeholder' => 'Apellido',
  'value' => $surname
];

$dataEmail = [
  'type' => 'email',
  'name' => 'email',
  'id' => 'email',
  'placeholder' => 'Email',
  'value' => $email
];

$dataUser = [
  'type' => 'text',
  'name' => 'username',
  'id' => 'username',
  'placeholder' => 'Usuario',
  'value' => $username
];

$dataPassCurrent = [
  'name' => 'passC',
  'id' => 'passC',
  'placeholder' => 'Contraseña'
];

$dataPassNew = [
  'name' => 'pass',
  'id' => 'pass',
  'placeholder' => 'Contraseña nueva'
];

$dataRepeatPassNew = [
  'name' => 'passR',
  'id' => 'passR',
  'placeholder' => 'Repetir nueva contraseña'
];

$dataImage = [
  'name' => 'image',
  'class' => 'hide',
  'id' => 'imageRP',
  'placeholder' => $image
];
$session = session();


?>

<main>
<br>
  <div class="container">

    <?= form_open_multipart('updateProfile'); ?>
    <h3>Editar información</h3>

    <?php switch ($option) {
      case 1:
        echo "<div class='form-group'>" . form_input($dataName) . "</div>";
        echo "<div class='form-group'>" . form_input($dataSurname) . "</div>";
        echo "<div class='form-group'>" . form_password($dataPassCurrent) . "</div>";
        break;

      case 2:
        echo "<div class='form-group'>" . form_input($dataEmail) . "</div>";
        echo "<div class='form-group'>" . form_password($dataPassCurrent) . "</div>";
        break;

      case 3:
        echo "<div class='form-group'>" . form_input($dataUser) . "</div>";
        echo "<div class='form-group'>" . form_password($dataPassCurrent) . "</div>";
        break;

      case 4:
    ?>
        <br>
        <div class="form-group"> 
          <?= "<h4>" . form_label('Imagen: ', 'image') . "<img width='100' height= '100' src='public/assets/img/photoProfile/". $image ."'></h4>"; ?>
          <br>
          <?= form_upload($dataImage); ?>

          <div id="drop-zone" class="drop-zone">
            <span class="material-symbols-outlined icon-upload">file_upload</span>
            <p class="drop-zone-text">
              Arrastre aquí la imágen o haga click para cargarla
            </p>
          </div>
        </div>
        <br>
    <?php
        echo "<div class='form-group'>" . form_password($dataPassCurrent) . "</div>";
        break;

      case 5:
        echo "<div class='form-group'>" . form_password($dataPassCurrent) . "</div>";
        echo "<div class='form-group'>" . form_password($dataPassNew) . "</div>";
        echo "<div class='form-group'>" . form_password($dataRepeatPassNew) . "</div>";
        break;
    }  ?>

    <?= form_submit('updateProfile', 'Guardar', 'class= "btn btn-primary"'); ?>

    <a href="profile" class="btn btn-warning" role="button">Atras</a>
    <?= form_close(); ?>
  </div>
  <br>
</main>
