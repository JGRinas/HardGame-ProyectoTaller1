<?php

$dataNewCategory = [
    'name' => 'category_desc',
];
$session = session();
?>
<main class="form">
<div class="container">


<?= form_open('regCategory');?>
<?= $session->getFlashdata('insertInfo');?>

<div class="form-group"> 
<?= "<h4>".form_label('Nueva categoría', 'category_desc')."</h4>";?>
<?= form_input($dataNewCategory);?>
</div>

<?= form_submit('regCategory', 'Guardar', 'class = "btn btn-primary"');?>
<?= form_close();?>

</div>
</main>


