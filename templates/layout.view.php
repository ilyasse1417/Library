<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library.ma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #e3f2fd;">
        <div class="container">
            <?php if ($this->getUser()) : ?>
                <a class="navbar-brand" href="/item/list">
                    Solithèque
                </a>
            <?php else : ?>
                <a class="navbar-brand" href="/">
                    Solithèque
                </a>
            <?php endif ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <?php if ($user) : ?>
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $user->getNickName(); ?>
                            </button>
                            <?php if (!$this->isAdmin($user)) : ?>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="/member/profile">Profile</a></li>
                                    <li><a class="dropdown-item" href="/member/reservations">My reservations</a></li>
                                    <li><a class="dropdown-item" href="/member/borrowings">My borrowings</a></li>
                                    <li><a class="dropdown-item" href="/member/logout">Log out</a></li>
                                </ul>
                            <?php else : ?>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="/member/profile">Profile</a></li>
                                    <li><a class="dropdown-item" href="/member/confirmreservations">Confirm reservations</a></li>
                                    <li><a class="dropdown-item" href="/member/returnborrowings">Return borrowings</a></li>
                                    <li><a class="dropdown-item" href="/member/itemmanager">Item manager</a></li>
                                    <li><a class="dropdown-item" href="/member/logout">Log out</a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/member/login">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a href="/member/create" class="nav-link active" aria-current="page" href="#">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main style="padding-top: 65px;">
        <div class="container" style="margin-top: 10px;">
            <div class="row">
                <?php $this->printFlashMessages(); ?>
            </div>
        </div>
        <?php echo $content ?>
    </main>
    <footer>
        <div class="container">
            <div class="d-lg-flex justify-content-lg-between py-5 text-center text-lg-start">
                <div class="pb-3">
                    <a href="/"><img src="/assets/images/logo.png" alt="logo" style="height:60px"></a>
                </div>
                <div class="text-white">
                    <div>
                        <i class="fa-solid fa-envelope me-2"></i>
                        <span>contact@library.ma</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-mobile-screen-button  me-2"></i>
                        <span>+212 5 39 23 58 45</span>
                    </div>
                    <div>
                    </div>
                </div>
                <div class="pt-3">
                    <a href="#" class="text-white"> <i class="fa-brands fa-2xl m-2 fa-facebook"></i></a>
                    <a href="#" class="text-white"><i class="fa-brands fa-2xl mx-2 fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/eec721374e.js" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
</body>

</html>