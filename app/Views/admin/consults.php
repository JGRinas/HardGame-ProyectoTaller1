<main>
    <div class="container consultsContainer">

        <?php $session = session(); ?>
        <?= $session->getFlashdata('deleteConsultError'); ?>

        <div class="row">

            <table class="table">
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tema</th>
                    <th scope="col">Consulta</th>
                    <th scope="col">Acciones</th>
                </tr>

                <? if ($users) : ?>

                    <?php foreach ($users as $user) : ?>

                        <?php if ($user['deleted_at']) { ?>

                            <?= "<tr scope='row' class='rowConsult bg-secondary'>"; ?>
                            <?= "<td>" . $user['created_at'] . "</td>"; ?>
                            <?= "<td>" . $user['name'] . "</td>"; ?>
                            <?= "<td>" . $user['email'] . "</td>"; ?>
                            <?= "<td>" . $user['theme'] . "</td>"; ?>
                            <?= "<td><textarea class='textareaConsult' disabled>" . $user['consult'] . "</textarea></td>"; ?>

                            <td>
                                <a href="<?php echo base_url('/AdminController/restoreConsult?id_message=' . $user['id_message']); ?>" class="btn btn-warning" role="button"><span class="material-symbols-outlined">restore_from_trash</span></a>
                            </td>
                            </tr>

                        <?php } else { ?>

                            <?= "<tr scope='row' class='rowConsult'>"; ?>
                            <?= "<td>" . $user['created_at'] . "</td>"; ?>
                            <?= "<td>" . $user['name'] . "</td>"; ?>
                            <?= "<td>" . $user['email'] . "</td>"; ?>
                            <?= "<td>" . $user['theme'] . "</td>"; ?>
                            <?= "<td><textarea class='textareaConsult' disabled>" . $user['consult'] . "</textarea></td>"; ?>

                            <td>
                                <a href="<?php echo base_url('/AdminController/deleteConsult?id_message=' . $user['id_message']); ?>" class="btn btn-danger" role="button"><span class="material-symbols-outlined">delete</span></a>
                                <br>
                                <a href="<?php echo base_url('/consultAnswer?id_message=' . $user['id_message']); ?>" class="btn btn-primary" role="button"><span class="material-symbols-outlined">comment</span></a>
                            </td>
                            </tr>

                        <?php } ?>

                    <?php endforeach ?>

                <? endif; ?>

            </table>
        </div>

        <?php echo $paginador->links(); ?>
    </div>
</main>