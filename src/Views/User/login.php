<?php require_once (__DIR__ . '/../incl/header.php'); ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <?php echo !empty($_SESSION['register_success']) ? '<div class="alert alert-success" id="msg-flash">'.$_SESSION['register_success'].'</div>' : ''; ?>
                <h1><?= $langUserLoginTitle; ?></h1> 
                <p><?= $langUserLoginContent; ?></p>
                <form method="POST" action="index.php?controller=user&action=login">

                    <div class = "form-group">
                        <label for="email"><?= $langUserLoginEmail  ?></label>
                        <input type="text" name="email" id="user" class="form-control form-control-sm <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="<?= $langUserLoginEmailPH ?>">
                        <span class="invalid-feedback"><?= $langUserLoginEmailErr[$email_err] ?></span>
                    </div>
                    <div class = "form-group">
                        <label for="password"><?= $langUserLoginPassword ?></label>
                        <input type="password" name="password" id="password" class="form-control form-control-sm <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="<?= $langUserLoginPasswordPH ?>">
                        <span class="invalid-feedback"><?= $langUserLoginPasswordErr[$password_err] ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="<?= $langUserLoginButton ?>" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="index.php?controller=User&action=register" class="btn btn-light btn-block"><?= $langUserLoginRegister ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<?php require_once (__DIR__ . '/../incl/footer.php'); ?>