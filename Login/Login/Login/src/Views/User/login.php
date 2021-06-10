<?php require_once (__DIR__ . '/../incl/header.php'); ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <?php echo !empty($_SESSION['register_success']) ? '<div class="alert alert-success" id="msg-flash">'.$_SESSION['register_success'].'</div>' : ''; ?>
                <h1><?= $title; ?></h1>
                <p><?= $content; ?></p>
                <form method="POST" action="index.php?controller=user&action=login">

                    <div class = "form-group">
                        <label for="email">Gebruikersnaam</label>
                        <input type="text" name="email" id="user" class="form-control form-control-sm <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="E-mail adres">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>
                    <div class = "form-group">
                        <label for="password">Wachtwoord</label>
                        <input type="password" name="password" id="password" class="form-control form-control-sm <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Wachtwoord">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Inloggen" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="index.php?controller=User&action=register" class="btn btn-light btn-block">Nog geen account? Registreer</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<?php require_once (__DIR__ . '/../incl/footer.php'); ?>