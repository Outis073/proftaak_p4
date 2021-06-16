<?php require_once(__DIR__ . '/../incl/header.php'); ?>

<div class="container text-center">
    <div class="row justify-content-center dots-row">
        <?php echo !empty($_SESSION['register_success']) ? '<div class="alert alert-success" id="msg-flash">' . $_SESSION['register_success'] . '</div>' : ''; ?>
        <h1 class="col-md-12 pb-2"><?= $langUserLoginTitle; ?></h1>
        <p class="col-md-12 lead"><?= $langUserLoginContent; ?></p>
    </div>


    <section>

        <div class="row">

            <div class="col-lg-8 mx-auto">
                <div class="bg-white rounded text-center p-5 shadow-down">

                    <form method="POST" action="index.php?controller=User&action=login" class="row">

                        <div class="col-md-12">

                            <input type="text" name="email" id="user" class="form-control px-0 mb-4" <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="<?= $langUserLoginEmailPH ?>">
                            <span class="invalid-feedback"><?= $langUserLoginEmailErr[$email_err] ?></span>
                        </div>
                        <div class="col-md-12">

                            <input type="password" name="password" id="password" class="form-control px-0 mb-4" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="<?= $langUserLoginPasswordPH ?>">
                            <span class="invalid-feedback"><?= $langUserLoginPasswordErr[$password_err] ?></span>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <input type="submit" value="<?= $langUserLoginButton ?>" class="btn btn-main">
                            </div>
                            <div class="col-md-6">
                                <a href="index.php?controller=User&action=register" class="btn btn-main-account"><?= $langUserLoginRegister ?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


<?php require_once(__DIR__ . '/../incl/footer.php'); ?>