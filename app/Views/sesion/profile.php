<main class="container">
    <?php $session = session(); ?>

    <?= "<h3>" . $session->getFlashdata('editError2') . "</h3>"; ?>

    <div class="container containerEditProfile row">
        <section class="col section-img-profile">
            <div class="card card-profile">
                <img class="card-img-top" src="<?php echo base_url('public/assets/img/photoProfile/' . trim(session('photo_p'))) ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= session('name') . " " . session('surname') ?></h5>
                    <hr class="my-4">
                    <p class="card-text">Alias: "<?= session('username') ?>"</p>
                    <hr class="my-4">
                    <p class="card-text">Correo: <?= session('email') ?></p>
                    <hr class="my-4">
                    <?php if (session('profile') == 1) {
                        $profile = 'Administrador';
                    } else {
                        $profile = 'Usuario';
                    } ?>
                    <p class="card-text">Perfil: "<?= $profile ?>"</p>

                </div>
            </div>

        </section>
        <section class="optionProfile col-8 card card-profile">
            <?= "<h3>" . $session->getFlashdata('editError') . "</h3>"; ?>
            <ul class="list-group list-group-flush">
                <?php $option = ['id' => '1']; ?>
                <hr class="my-4">
                <li class="list-group-item "><a href="<?php echo base_url('/editProfile?id=' . $option['id'] = 1); ?>" class="">Editar nombre y apellido</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('/editProfile?id=' . $option['id'] = 2); ?>">Editar email</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('/editProfile?id=' . $option['id'] = 3); ?>">Editar nombre de usuario</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('/editProfile?id=' . $option['id'] = 4); ?>">Cambiar foto de perfil</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('/editProfile?id=' . $option['id'] = 5); ?>">Cambiar contraseña </a></li>
                <li class="list-group-item bg-info "><a href="<?php echo base_url('/myPurchases'); ?>">MIS COMPRAS</a></li>
                <li class="list-group-item bg-danger "><a href="logout">Cerrar sesión</a></li>
                <hr class="my-4">
            </ul>
        </section>


    </div>
</main>