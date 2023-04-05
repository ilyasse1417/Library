<div class="container py-5">
    <div class="row">
        <div class="col">
            <h2>Edit item</h2>
        </div>
    </div>
    <?php echo $form->start(); ?>
    <div class="row">
        <div class="col-lg-5">
            <?php echo $form->fields->title; ?>
            <?php echo $form->fields->authorName; ?>
            <?php echo $form->fields->type; ?>
            <?php echo $form->fields->typeValue; ?>
            <?php echo $form->fields->state; ?>
            <?php echo $form->fields->editionDate; ?>
            <?php echo $form->fields->purchaseDate; ?>
            <?php echo $form->fields->edit; ?>
        </div>
    </div>
    <?php echo $form->end(); ?>
</div>