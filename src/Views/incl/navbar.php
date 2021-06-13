<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?= 'index.php'; ?>"><?= 'VITA E-Bikes' ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <?php if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] == "customer") : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= 'index.php' ?>">Home</a>
                    </li>
                        <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "customer") : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= 'index.php?controller=Order&action=index' ?>">Orders</a>
                            </li>
                        <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= 'index.php?controller=Contact&action=index' ?>">Contact</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= './?controller=Product&action=index' ?>">Producten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= 'index.php?controller=Search&action=searchHistory' ?>">Zoekopdrachten</a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] == "customer") : ?>
                <div class="search-container">
                    <form class="search" action="./?controller=search" method="POST">
                        <input class="" type="text" placeholder="Zoek.." name="search" />
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            <?php endif; ?> 

            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./?controller=user&action=logout">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"><?= $_SESSION['user_name'] ?></a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./?controller=user&action=register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./?controller=user&action=login">Login</a>
                    </li>
                <?php endif; ?>
                <?php if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] == "customer") : ?>
                   <form method="post" action="index.php?controller=Home&action=changeLanguage">
                       <input type="hidden" name="language" value="en">
                       <button type="submit" name="submit_button" class="btn btn-primary">English</button>   
                    </form>
                    
                    <form method="post" action="index.php?controller=Home&action=changeLanguage">
                       <input type="hidden" name="language" value="nl">
                       <button type="submit" name="submit_button" class="btn btn-primary">Dutch</button>
                    </form>
                <?php endif; ?> 
            </ul>
        </div>
    </div>
</nav>