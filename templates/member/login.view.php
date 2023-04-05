<div class="container py-5">
    <div class="row">
        <div class="col">
            <h2> Login</h2>
        </div>
    </div>
    <?php echo $form->start(); ?>
    <div class="row">
        <div class="col-lg-5">
            <?php echo $form->fields->nickname; ?>
            <?php echo $form->fields->password; ?>
            <?php echo $form->fields->submit; ?>
        </div>
    </div>
    <?php echo $form->end(); ?>
</div>