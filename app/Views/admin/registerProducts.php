<?php
if ($product) {
   $id = $idProduct;
   $title = $product['title'];
   $description = $product['description'];
   $brandI = $product['brand'];
   $categoryI = $product['category'];
   $stock = $product['stock'];
   $price = $product['price'];
   $image = $product['image'];
} else {
   $id = null;
   $title = '';
   $brandI = '';
   $categoryI = '';
   $description = '';
   $stock = '';
   $price = '';
   $image = '';
}
$dataTitle = [
   'type' => 'text',
   'name' => 'title',
   'placeholder' => 'Ingrese el título',
   'style' => 'width: 50%',
   'value' => $title
];

$dataDescription = [
   'name' => 'description',
   'style' => 'width: 50%',
   'value' => $description
];

$dataStock = [
   'type' => 'text',
   'name' => 'stock',
   'placeholder' => 'Ingrese el Stock',
   'style' => 'width: 50%',
   'value' => $stock
];

$dataPrice = [
   'type' => 'text',
   'name' => 'price',
   'placeholder' => 'Ingrese el precio',
   'style' => 'width: 50%',
   'value' => $price
];

$dataImage = [
   'name' => 'image',
   'class' => 'hide',
   'id' => 'imageRP',

];
$session = session();
?>

<main class="regProductForm ">
   <div class="container">

      <?= form_open_multipart('regProducts'); ?>

      <h3>Registro de producto</h3>
      <?="<h5>".$session->getFlashdata('error2')."</h5>"?>
      <br>

      <input type="hidden" name="id_product" value="<?= $id ?>">

      <div class="form-group">
         <?= "<h4>" . form_label('Titulo', 'title') . "</h4>"; ?>
         <?= form_input($dataTitle); ?>
         <p><?php if ($infoE) {
               echo $infoE['title'];
            } ?></p>

      </div>



      <div class="form-group">
         <?= "<h4>" . form_label('Marca', 'brand') . "</h4>"; ?>
         <br>
         <select name="brand">

            <?php foreach ($brand as $br) : ?>

               <?php if ($brandI == $br['brand_id']) : ?>
                  <?= "<option value=" . $br['brand_id'] . " selected>" . $br['brand_desc'] . "</option>" ?>
               <?php else : ?>
                  <?= "<option value=" . $br['brand_id'] . ">" . $br['brand_desc'] . "</option>" ?>
               <?php endif; ?>
            <?php endforeach; ?>

         </select>
         <br>
         <br>
         <a href="registerBrand" class="btn btn-danger" role="button">Registrar más marcas</a>
      </div>

      <div class="form-group">
         <?= "<h4>" . form_label('Descripcion', 'description') . "</h4>"; ?>
         <br>
         <?= form_textarea($dataDescription); ?>
         <p><?php if ($infoE) {
               echo $infoE['description'];
            } ?></p>

      </div>

      <div class="form-group">
         <?= "<h4>" . form_label('Stock', 'stock') . "</h4>"; ?>
         <br>
         <?= form_input($dataStock); ?>
         <p><?php if ($infoE) {
               echo $infoE['stock'];
            } ?></p>

      </div>

      <div class="form-group">
         <?= "<h4>" . form_label('Precio', 'price') . "</h4>"; ?>
         <br>
         <?= form_input($dataPrice); ?>
         <p><?php if ($infoE) {
               echo $infoE['price'];
            } ?></p>

      </div>

      <br>
      <div class="form-group">
         <?= "<h4>" . form_label('Imagen', 'image') . "</h4>"; ?>
         <br>
         <?= form_upload($dataImage); ?>

         <div id="drop-zone" class="drop-zone">
            <span class="material-symbols-outlined icon-upload">file_upload</span>
            <p class="drop-zone-text">
               Arrastre aquí la imágen o haga click para cargarla
            </p>
         </div>
         <?php 
         echo "<h4>" . $session->getFlashdata('imagenError') . "</h4>";
         ?>
         <img width="100" src=" <?= base_url('public/assets/img/uploads/' . $image) ?>">
      </div>
      <br>

      <div class="form-group">
         <br>
         <?= "<h4>" . form_label('Categoria', 'category') . "</h4>"; ?>

         <select name="category">

            <?php foreach ($category as $catego) : ?>
               <?php if ($categoryI == $catego['category_id']) : ?>
                  <?= "<option value=" . $catego['category_id'] . " selected>" . $catego['category_desc'] . "</option>" ?>
               <?php else : ?>
                  <?= "<option value=" . $catego['category_id'] . ">" . $catego['category_desc'] . "</option>" ?>
               <?php endif; ?>
            <?php endforeach; ?>

         </select>
         <br>
         <br>
         <a href="registerCategory" class="btn btn-danger" role="button">Registrar más categorías</a>

      </div>

      <div class="form-group">
         <?= form_submit('regProducts', 'Registrar producto', 'class = "btn btn-primary btn-block"'); ?>
      </div>

      <?= form_close(); ?>

   </div>
</main>