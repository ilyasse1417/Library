<div class="container py-5">
    <div class="row">
        <div class="col">
            <h2> Be a member</h2>
        </div>
    </div>
    <?php echo $form->start(); ?>
    <div class="row">
        <div class="col-lg-5">
            <?php echo $form->fields->nickname; ?>
            <?php echo $form->fields->email; ?>
            <?php echo $form->fields->password; ?>
            <?php echo $form->fields->fullName; ?>
            <?php echo $form->fields->address; ?>
            <?php echo $form->fields->phone; ?>
            <?php echo $form->fields->cin; ?>
            <?php echo $form->fields->type; ?>
            <?php echo $form->fields->birthDate; ?>
            <?php echo $form->fields->submit; ?>
        </div>
    </div>
    <?php echo $form->end(); ?>
</div>