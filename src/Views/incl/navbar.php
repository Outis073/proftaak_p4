<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?= 'index.php'; ?>"><?= 'VITA E-Bikes' ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <?php if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] == "customer") : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= 'index.php' ?>"><?= $langNavbarHome ?></a>
                    </li>
                    <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == "customer") : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= 'index.php?controller=Order&action=index' ?>"><?= $langNavbarOrders ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= 'index.php?controller=Contact&action=index' ?>"><?= $langNavbarContact ?></a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= './?controller=Product&action=index' ?>"><?= $langNavbarProducts ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= 'index.php?controller=Search&action=searchHistory' ?>"><?= $langNavbarSearchResults ?></a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] == "customer") : ?>
                <div class="search-container">
                    <form class="search" action="./?controller=search" method="POST">
                        <input type="text" placeholder="<?= $langNavbarSearch ?>" name="search" />
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            <?php endif; ?>

            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./?controller=user&action=logout"><?= $langNavbarLogoff ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"><?= $_SESSION['user_name'] ?></a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./?controller=user&action=register"><?= $langNavbarRegister ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./?controller=user&action=login"><?= $langNavbarLogin ?></a>
                    </li>
                <?php endif; ?>
                <?php if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] == "customer") : ?>
                    <div class="navbar-nav ml-4">
                        <form class="nav-item" method="post" action="index.php?controller=Home&action=changeLanguage">
                            <input type="hidden" name="language" value="en">
                            <button type="submit" name="submit_button" class="btn btn-taal">English</button>
                        </form>
                        <form class="nav-item" method="post" action="index.php?controller=Home&action=changeLanguage">
                            <input type="hidden" name="language" value="nl">
                            <button type="submit" name="submit_button" class="btn btn-taal">Nederlands</button>
                        </form>
                    </div>
                <?php endif; ?>
            </ul>

            <div class="navbar-nav ml-2">

                <form class="nav-item" method="post" action="">
                    <button type="submit" name="submit_button" class="btn btn-main-admin-edit ml-4"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-cart-fill" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg></button>
                </form>
            </div>
        </div>
    </div>
</nav>