<?php
$session = session();

$dataId = [
    'name' => 'id_message',
    'value' => $idMessage,
];
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
                    <th scope="col">Enviar</th>
                </tr>

                <? if ($consult) : ?>

                    <?php foreach ($consult as $cons) : ?>

                        <?= "<tr scope='row' class='rowConsult'>"; ?>
                        <?= "<td>" . $cons['created_at'] . "</td>"; ?>
                        <?= "<td>" . $cons['theme'] . "</td>"; ?>
                        <?= "<td><textarea class='textareaConsult' disabled>" . $cons['consult'] . "</textarea></td>"; ?>
                        <?= form_open('consultAnswerReg'); ?>

                        <?php
                        $dataTextArea = [
                            'name' => 'answer',
                            'class' => 'textareaConsult',
                            'value' => $cons['answer']
                        ];
                        ?>
                        
                        <?= "<td>" . form_textarea($dataTextArea) . "</td>"; ?>     
                        <input type="hidden" id="id_message" name="id_message" value="<?= $idMessage ?>">             
                        <?= "<td>" . form_submit('consultAnswerReg', 'send', "class = 'btn btn-primary material-symbols-outlined'"). "</td>"; ?>
                        <?= form_close(); ?>

                    <?php endforeach ?>

                <? endif; ?>

            </table>
        </div>

    </div>
</main>