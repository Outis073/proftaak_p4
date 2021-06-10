<?php require_once (__DIR__ . '/../incl/header.php'); ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h1><?= $title; ?></h1>
            <p><?= $content; ?></p>

            <form action="index.php?controller=User&action=register" method="POST">

                <div class = "form-group">
                    <label for="email">E-mail adres<sup>*</sup></label>
                    <input type="text" name="email" class="form-control form-control-sm <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>"  placeholder="E-mail adres" autofocus>
                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                </div>
                <div class = "form-group">
                    <label for="firstName">Voornaam</label>
                    <input type="text" name="firstName" class="form-control form-control-sm <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>" placeholder="Voornaam">
                    <span class="invalid-feedback"><?php echo $firstName_err; ?></span>
                </div>
                <div class = "form-group">
                    <label for="lastName">Achternaam</label>
                    <input type="text" name="lastName" class="form-control form-control-sm <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>" placeholder="Achternaam" >
                    <span class="invalid-feedback"><?php echo $lastName_err; ?></span>
                </div>
                <div class = "form-group">
                    <label for="street">Straat</label>
                    <input type="text" name="street" id="street" class="form-control form-control-sm <?php echo (!empty($street_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $street; ?>" placeholder="Straat" >
                    <span class="invalid-feedback"><?php echo $street_err; ?></span>
                </div>

                <div class = "form-group">
                    <label for="houseNumber">Huisnr</label>
                    <input type="text" name="houseNumber" id="houseNumber" class="form-control form-control-sm <?php echo (!empty($houseNumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $houseNumber; ?>" placeholder="Huisnr" >
                    <span class="invalid-feedback"><?php echo $houseNumber_err; ?></span>
                </div>
                <div class = "form-group">
                    <label for="postalCode">Postcode</label>
                    <input type="text" name="postalCode" id="postalCode" class="form-control form-control-sm <?php echo (!empty($postalCode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $postalCode; ?>" placeholder="Postcode" >
                    <span class="invalid-feedback"><?php echo $postalCode_err; ?></span>
                </div>
                <div class = "form-group">
                    <label for="city">Woonplaats</label>
                    <input type="text" name="city" id="city" class="form-control form-control-sm <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>" placeholder="Woonplaats" >
                    <span class="invalid-feedback"><?php echo $city_err; ?></span>
                </div>
                <div class = "form-group">
                    <label for="telephone">Telefoonnr</label>
                    <input type="text" name="telephone" id="telephone" class="form-control form-control-sm <?php echo (!empty($telephone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telephone; ?>" placeholder="Telefoonnr" >
                    <span class="invalid-feedback"><?php echo $telephone_err; ?></span>
                </div>
                <div class = "form-group">
                    <label for="password">Wachtwoord<sup>*</sup></label>
                    <input type="password" name="password" id="password" class="form-control form-control-sm <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Wachtwoord" >
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class = "form-group">
                    <label for="passwordCheck">Wachtwoord controle<sup>*</sup></label>
                    <input type="password" name="passwordCheck" id="passwordCheck" class="form-control form-control-sm <?php echo (!empty($passwordCheck_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $passwordCheck; ?>" placeholder="Wachtwoord ter controle" >
                    <span class="invalid-feedback"><?php echo $passwordCheck_err; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Registreer" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="index.php?controller=User&action=login" class="btn btn-light btn-block">Al een account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once (__DIR__ . '/../incl/footer.php'); ?>