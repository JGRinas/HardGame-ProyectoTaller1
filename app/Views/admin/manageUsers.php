<main>
    <div class="container usersContainer">
    
    <?php $session = session();?>
    <?= $session->getFlashdata('deleteUserError');?>

        <div class="row">

        <table class="table">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Usuario</th>
            <th scope="col">Creación</th>
            <th scope="col">Acciones</th>
        </tr>

        <? if($users): ?>
            <?php foreach($users as $user):?>
                <?php if($user['deleted_at']){?>

                <?= "<tr scope='row' class='rowConsult bg-secondary'>"; ?>
                <?= "<td>".$user['id']."</td>"; ?>
                <?= "<td>".$user['name']."</td>"; ?>
                <?= "<td>".$user['email']."</td>"; ?>
                <?= "<td>".$user['username']."</td>"; ?>
                <?= "<td>".$user['created_at']."</td>"; ?>
            <td>                        

            <a href="<?php echo base_url('/AdminController/restoreUser?id=' . $user['id']); ?>" class="btn btn-warning" role="button"><span class="material-symbols-outlined">restore_from_trash</span></a>
            
            <?php }else{ ?>

                <?= "<tr scope='row' class='rowConsult'>"; ?>
                <?= "<td>".$user['id']."</td>"; ?>
                <?= "<td>".$user['name']."</td>"; ?>
                <?= "<td>".$user['email']."</td>"; ?>
                <?= "<td>".$user['username']."</td>"; ?>
                <?= "<td>".$user['created_at']."</td>"; ?>
            <td>                           
            <a href="<?php echo base_url('/AdminController/deleteUser?id='.$user['id']);?>" class="btn btn-danger" role="button" ><span class="material-symbols-outlined">delete</span></a>

            </td></tr>

            <?php } ?>
            <?php endforeach?>
        <? endif; ?>

    </table>
        </div>
    
        <?php echo $paginador->links();?>
    </div>
</main>