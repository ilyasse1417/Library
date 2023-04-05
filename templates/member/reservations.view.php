<div class="container py-5">
    <div class="row">
        <div class="col">
            <h2> My reservations</h2>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <?php foreach ($reservations as $reservation) : ?>
            <?php /** @var ReservationEntity $reservation  */ ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card" style="width: 100%; height:auto;">
                    <img src="/assets/images/<?php echo $reservation['cover_image']; ?>" class="card-img-top" alt="coverImage" height="350px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $reservation['title']; ?></h5>
                        <span class="badge bg-secondary">Reservation code : #<?php echo $reservation['reservation_id']; ?></span>
                        <div class="d-grid gap-2 d-md-block mx-auto">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Cancel reservation
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-dialog modal-dialog-centered">
                Are you sure you want to cancel this reservation?
            </div>
            <div class="modal-footer">
                <a href="/reservation/cancel?id=<?php echo $reservation['reservation_id'] ?>" type="button" class="btn btn-danger">Yes</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>