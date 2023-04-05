<div class="container py-5">
    <div class="row">
        <div class="col">
            <h2> My borrowings</h2>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <?php foreach ($borrowings as $borrowing) : ?>
            <?php /** @var borrowingEntity $borrowing  */ ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card" style="width: 100%; height:auto;">
                    <img src="/assets/images/<?php echo $borrowing['cover_image']; ?>" class="card-img-top" alt="coverImage" height="350px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $borrowing['title']; ?></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Author : <?php echo $borrowing['author_name']; ?>
                            </li>
                            <li class="list-group-item">
                                State : <?php echo $borrowing['state']; ?>
                            </li>
                            <li class="list-group-item">
                                Type : <?php echo $borrowing['type']; ?>
                            </li>
                            <?php if ($borrowing['type'] === 'Book' || $borrowing['type'] === 'Comic') : ?>
                                <li class="list-group-item">
                                    Number of pages :<?php echo $borrowing['type_value']; ?> pages
                                </li>
                            <?php else : ?>
                                <li class="list-group-item">
                                    Duration : <?php echo $borrowing['type_value']; ?> min
                                </li>
                            <?php endif ?>
                            <li class="list-group-item">
                                Edited : <?php echo $borrowing['edition_date']; ?>
                            </li>
                            <li class="list-group-item">
                                Purchased : <?php echo $borrowing['purchase_date']; ?>
                            </li>
                            <span class="badge bg-secondary">Borrowing code : #<?php echo $borrowing['borrowing_id']; ?></span>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>