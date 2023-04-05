<div class="container py-5">
    <div class="row">
        <div class="col">
            <h2>Item manager</h2>
        </div>
        <div class="col">
            <a href="/item/create" class="btn btn-primary float-end">+ Add item</a>
        </div>
    </div>
</div>
<div class="container mt-2">
    <div class="row">
        <div class="col-3">
            <div class="bg-light  p-3 border">
                <?php echo $form->start(); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo $form->fields->itemId; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">
                        <?php echo $form->fields->submit; ?>
                    </div>
                </div>
                <?php echo $form->end(); ?>
            </div>
        </div>
    </div>
</div>
<?php if ($item) : ?>
    <div class="container my-5">
        <div class="row">
            <?php
            /** @var ItemEntity $item  */ ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card" style="width: 100%; height:auto;">
                    <img src="/assets/images/<?php echo $item['cover_image'] ?>" class="card-img-top" alt="coverImage" height="350px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['title'] ?></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Item code : #<?php echo $item['id']; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="d-grid gap-2 d-md-block mx-auto">
                        <a href="/item/edit?id=<?php echo $item['id'] ?>" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-dialog modal-dialog-centered">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <a href="/item/delete?id=<?php echo $item['id'] ?>" type="button" class="btn btn-danger">Yes</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>