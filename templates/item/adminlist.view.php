<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="bg-light  p-3 border">
                <?php echo $form->start(); ?>
                <div class="row">
                    <div class="col-lg-3">
                        <?php echo $form->fields->searchBar; ?>
                    </div>
                    <div class="col-lg-3">
                        <?php echo $form->fields->type; ?>
                    </div>
                    <div class="col-lg-3">
                        <?php echo $form->fields->state; ?>
                    </div>
                    <div class="col-lg-3">
                        <?php echo $form->fields->status; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">
                        <?php echo $form->fields->submit; ?>
                    </div>
                    <div class="col-lg-1 my-1">
                        <a href="/item/list/" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
                <?php echo $form->end(); ?>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <?php foreach ($itemsList as $item) : ?>
            <?php /** @var ItemEntity $item  */ ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card" style="width: 100%; height:auto;">
                    <img src="/assets/images/<?php echo $item->getCoverImage() ?>" class="card-img-top" alt="coverImage" height="350px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item->getTitle() ?></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Author : <?php echo $item->getAuthorName(); ?>
                            </li>
                            <li class="list-group-item">
                                State : <?php echo $item->getState(); ?>
                            </li>
                            <li class="list-group-item">
                                Type : <?php echo $item->getType(); ?>
                            </li>
                            <?php if ($item->getType() === 'Book' || $item->getType() === 'Comic') : ?>
                                <li class="list-group-item">
                                    Number of pages :<?php echo $item->getTypeValue(); ?> pages
                                </li>
                            <?php else : ?>
                                <li class="list-group-item">
                                    Duration : <?php echo $item->getTypeValue(); ?> min
                                </li>
                            <?php endif ?>
                            <li class="list-group-item">
                                Edited : <?php echo $item->getEditionDate(); ?>
                            </li>
                            <li class="list-group-item">
                                Purchased : <?php echo $item->getPurchaseDate(); ?>
                            </li>
                        </ul>
                    </div>
                    <?php if ($item->getStatus() === 'Available') : ?>
                        <div class="d-grid gap-2 d-md-block mx-auto">
                            <a href="/reservation/create?id=<?php echo $item->getId() ?>" class="btn btn-success">Borrow</a>
                        </div>
                    <?php else : ?>
                        <div class="d-grid gap-2 d-md-block mx-auto">
                            <a href="" class="btn btn-primary disabled"><?php echo $item->getStatus(); ?></a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>