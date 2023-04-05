<div class="container py-5">
    <div class="row">
        <div class="col">
            <h2> Return borrowings</h2>
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
                        <?php echo $form->fields->borrowingId; ?>
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
<?php if ($borrowing && $borrowing['status'] === 'Borrowed') : ?>
    <div class="container my-5">
        <div class="row">
            <?php
            /** @var ItemEntity $borrowing  */ ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card" style="width: 100%; height:auto;">
                    <img src="/assets/images/<?php echo $borrowing['cover_image'] ?>" class="card-img-top" alt="coverImage" height="350px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $borrowing['title'] ?></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                borrowing code : #<?php echo $borrowing['borrowing_id']; ?>
                            </li>
                            <li class="list-group-item">
                                borrowing date : <?php echo $borrowing['created_at']; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="d-grid gap-2 d-md-block mx-auto">
                        <a href="/borrowing/confirm?id=<?php echo $borrowing['borrowing_id'] ?>" class="btn btn-success">Return borrowing</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>