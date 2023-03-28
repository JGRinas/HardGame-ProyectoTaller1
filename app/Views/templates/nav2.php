<nav class="nav2-header">

  <div class="menu-list-header" id="menu-h">
    <ul class="items-list-header">
      <li><a href="products">Productos</a></li>
      <li><a href="marketing">Comercialización</a></li>
      <li><a href="aboutUs">¿Quiénes somos?</a></li>
      <li><a href="help">Ayuda</a></li>
      <li><a href="contact">Contacto</a></li>

    </ul>

    <?php if (session('login') && session('profile') == 1) : ?>
      <hr class="my-4">
      <?= "<ul class='items-list-header'>" ?>
      <?= "<li><a href='registerProducts'>Registrar Producto</a></li>" ?>
      <?= "<li><a href='manageProducts'>Gestionar Productos</a></li>" ?>
      <?= "<li><a href='consults'>Ver consultas</a></li>" ?>
      <?= "<li><a href='manageUsers'>Gestionar Usuarios</a></li>" ?>
      <?= "<li><a href='manageSales'>Gestionar ventas</a></li></ul>" ?>
    <?php endif; ?>
  </div>

  <div class="view-list-header">
    <img src="public/assets/img/icons/view-list.svg" alt="" class="icon-view-list-header" onclick="show()">
  </div>
</nav>