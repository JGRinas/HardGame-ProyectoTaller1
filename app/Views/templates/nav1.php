<nav class="nav1-header">
    <a href="index"><img src="public/assets/img/logo-header.svg" alt="" class="logo-header"></a>
    <div class="search">
        <input type="text" placeholder="Buscar" required>
        <div class="material-icons-outlined icon-btn-search">search</div>
    </div>

    <?php if (session('login')) { ?>
        <ul>
            <img src="<?php echo base_url('public/assets/img/cart-shoppin.svg') ?>" class="nav-link dropdown-toggle img-fluid" height="60" width="60" data-toggle="dropdown" aria-haspopup="true"></img>

            <div id="carrito" class="dropdown-menu" aria-labelledby="navbarCollapse">
                <table id="lista-carrito" class="table">
                    <tbody>
                    </tbody>
                </table>

                <h5 class="hide" id="carritoVacio">Carrito vacío ¡Empieza a llenarlo!</h5>
                
                <a href="<?= base_url('cartView'); ?>" class="hide" id="procesar-pedido">Procesar pedido</a>
                <a href="" class="hide vaciar-carrito" id="vaciar-carrito">Vaciar carrito</a>
            </div>


            <?= "<li class='sesion-header'><a href='profile'>" . session('name') . " " . session('surname') . "</a></li>" ?>
            <li><a href="profile"><img width="50" height="50" class="img-profile-login" src="<?= base_url('public/assets/img/photoProfile/' . trim(session('photo_p'))) ?>" alt="Foto de perfil"></a>
        </ul>
    <?php } else { ?>

        <ul>
            <li class="sesion-header"><a href="login">Iniciar Sesion</a></li>
            <li class="sesion-header"><a href="register">Registrarse</a>
            <li>
            <li><a href="login"><img src="public/assets/img/icons/sesion-icon.svg" alt="account" class="icon-account-header"></a></li>
        </ul>

    <?php }; ?>

    <script src="<?php echo base_url('public/assets/js/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/bootstrap/js/bootstrap.bundle.js') ?>"></script>
</nav>