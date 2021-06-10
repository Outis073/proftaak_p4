<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?= 'index.php'; ?>"><?= 'VITA E-Bikes' ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= 'index.php' ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= './?controller=Product&action=index' ?>">Admin pagina</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= 'index.php?controller=Order&action=index' ?>">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ''; ?>/pages/about">About</a>
            </li>
        </ul>
        
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="./?controller=user&action=logout">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><?= $_SESSION['user_name'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><?= '(' . $_SESSION['user_type'] . ')' ?></a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="./?controller=user&action=register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./?controller=user&action=login">Login</a>
                </li>
            <?php endif; ?>
        </ul>
        </div>
    </div>
</nav>