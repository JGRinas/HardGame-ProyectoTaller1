<?php

$dataNewCategory = [
    'name' => 'brand_desc',
];
$session = session();
?>
<main class="form">
<div class="container">


<?= form_open('regBrand');?>
<?= $session->getFlashdata('insertInfo');?>

<div class="form-group"> 
<?= "<h4>".form_label('Nueva marca', 'brand_desc')."</h4>";?>
<?= form_input($dataNewCategory);?>
</div>

<?= form_submit('regBrand', 'Guardar', 'class = "btn btn-primary"');?>
<?= form_close();?>

</div>
</main>


