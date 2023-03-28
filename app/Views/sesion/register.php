<main class="container">

    <div class="form h-100">
        <?php

        echo form_open('registerUser');

        $dataName = [
            'type' => 'text',
            'name' => 'name',
            'id' => 'name',
            'placeholder' => 'Nombre'
        ];

        $dataSurname = [
            'type' => 'text',
            'name' => 'surname',
            'id' => 'surname',
            'placeholder' => 'Apellido'
        ];

        $dataEmail = [
            'type' => 'email',
            'name' => 'email',
            'id' => 'email',
            'placeholder' => 'Email'
        ];

        $dataUser = [
            'type' => 'text',
            'name' => 'username',
            'id' => 'username',
            'placeholder' => 'Usuario'
        ];

        $dataPass = [
            'name' => 'pass',
            'id' => 'pass',
            'placeholder' => 'Contraseña'
        ];

        $dataPass2 = [
            'name' => 'passR',
            'id' => 'passR',
            'placeholder' => 'Repita su contraseña'
        ];

        $dataAceptTerms = [
            'name' => 'accept_terms',
            'id' => 'accept_terms',
            'value' => 'checked'
        ];
        //CSS line 419

        $session = session()
        ?>

        <?php $session = session(); ?>

        <div class="form-group">
            <?php echo form_input($dataName) ?>
            <?php if (isset($infoE['name'])) {
                echo $infoE['name'];
            } ?>
        </div>

        <div class="form-group">
            <?php echo form_input($dataSurname) ?>
            <?php if (isset($infoE['surname'])) {
                echo $infoE['surname'];
            } ?>
        </div>

        <div class="form-group">
            <?php echo form_input($dataEmail) ?>
            <?php if (isset($infoE['email'])) {
                echo $infoE['email'];
            } ?>
        </div>


        <div class="form-group">
            <?php echo form_input($dataUser) ?>
            <?php if (isset($infoE['username'])) {
                echo $infoE['username'];
            } ?>
        </div>
        <div class="form-group">
            <?php echo form_password($dataPass) ?>

        </div>

        <div class="form-group">
            <?php echo form_password($dataPass2) ?>
            <?php if (isset($infoE['passR'])) {
                echo $infoE['passR'];
            } ?>
            <?= "<p>" . $session->getFlashdata('regError2') . "</p><br>"; ?>

        </div>

        <div class="form-group checked-btn">
            <p><?php echo form_checkbox($dataAceptTerms); ?> acepto los <a href="terms">Terminos y Condiciones de uso</a></p>
        </div>
        <?php if (isset($infoE['accept_terms'])): ?>
            <div class="form-group">
            <?= $infoE['accept_terms']; ?>
            </div>
            
         <?php endif;?>
        
        

        <div class="form-group">
            <?php echo form_submit('registerUser', 'Registrarme', 'class = "btn btn-primary"');
            ?>
        </div>

        <div class="form-group checked-btn">
            <p>¿Ya tienes una cuenta? <a href="login">¡Inicia sesión!</a></p>
        </div>

    </div>

    <?php echo form_close(); ?>

</main>