<div class="container py-5">
    <div class="row">
        <div class="col">
            <h2> Confirm Reservations</h2>
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
                        <?php echo $form->fields->reservationId; ?>
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
<?php if ($reservation && $reservation['status'] === 'Reserved') : ?>
    <div class="container my-5">
        <div class="row">
            <?php
            /** @var ItemEntity $reservation  */ ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card" style="width: 100%; height:auto;">
                    <img src="/assets/images/<?php echo $reservation['cover_image'] ?>" class="card-img-top" alt="coverImage" height="350px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $reservation['title'] ?></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Reservation code : #<?php echo $reservation['reservation_id']; ?>
                            </li>
                            <li class="list-group-item">
                                Reservation date : <?php echo $reservation['created_at']; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="d-grid gap-2 d-md-block mx-auto">
                        <a href="/reservation/confirm?id=<?php echo $reservation['reservation_id'] ?>" class="btn btn-success">Confirm reservation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>