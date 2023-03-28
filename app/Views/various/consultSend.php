<?php
$session = session();

?>

<main>
    <div class="container consultsContainer">

        <?php $session = session(); ?>
        <?= $session->getFlashdata('deleteConsultError'); ?>

        <div class="row">

            <table class="table">
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Tema</th>
                    <th scope="col">Consulta</th>
                    <th scope="col">Respuesta</th>
                </tr>

                <? if ($consults) : ?>

                    <?php foreach ($consults as $consult) : ?>

                            <?= "<tr scope='row' class='rowConsult'>"; ?>
                            <?= "<td>" . $consult['created_at'] . "</td>"; ?>
                            <?= "<td>" . $consult['theme'] . "</td>"; ?>
                            <?= "<td><textarea class='textareaConsult' disabled>" . $consult['consult'] . "</textarea></td>"; ?>
                            <?= "<td><textarea class='textareaConsult' disabled>" . $consult['answer'] . "</textarea></td>"; ?>
                            

                            </tr>


                    <?php endforeach ?>

                <? endif; ?>

            </table>
        </div>

    </div>
</main>