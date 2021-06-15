<?php require_once (__DIR__ . '/../incl/header.php'); ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h1><?= $langUserRegisterTitle; ?></h1>
            <p><?= $langUserRegisterContent; ?></p>

            <form action="index.php?controller=User&action=register" method="POST">

                <div class = "form-group">
                    <label for="email"><?= $langUserRegisterEmail ?><sup>*</sup></label>
                    <input type="text" name="email" class="form-control form-control-sm <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>"  placeholder="<?= $langUserRegisterEmail ?>" autofocus>
                    <span class="invalid-feedback"><?= $langUserRegisterEmailErr[$email_err] ?></span>
                </div>
                <div class = "form-group">
                    <label for="firstName"><?= $langUserRegisterFirstname ?></label>
                    <input type="text" name="firstName" class="form-control form-control-sm <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>" placeholder="<?= $langUserRegisterFirstname ?>">
                    <span class="invalid-feedback"><?= $langUserRegisterFirstnameErr ?></span>
                </div>
                <div class = "form-group">
                    <label for="lastName"><?= $langUserRegisterLastname ?></label>
                    <input type="text" name="lastName" class="form-control form-control-sm <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>" placeholder="<?= $langUserRegisterLastname ?>" >
                    <span class="invalid-feedback"><?= $langUserRegisterLastnameErr ?></span>
                </div>
                <div class = "form-group">
                    <label for="street"><?= $langUserRegisterStreet ?></label>
                    <input type="text" name="street" id="street" class="form-control form-control-sm <?php echo (!empty($street_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $street; ?>" placeholder="<?= $langUserRegisterStreet ?>" >
                    <span class="invalid-feedback"><?= $langUserRegisterStreetErr ?></span>
                </div>

                <div class = "form-group">
                    <label for="houseNumber"><?= $langUserRegisterHouseNumber ?></label>
                    <input type="text" name="houseNumber" id="houseNumber" class="form-control form-control-sm <?php echo (!empty($houseNumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $houseNumber; ?>" placeholder="<?= $langUserRegisterHouseNumber ?>" >
                    <span class="invalid-feedback"><?= $langUserRegisterHouseNumberErr ?></span>
                </div>
                <div class = "form-group">
                    <label for="postalCode"><?= $langUserRegisterPostalcode ?></label>
                    <input type="text" name="postalCode" id="postalCode" class="form-control form-control-sm <?php echo (!empty($postalCode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $postalCode; ?>" placeholder="<?= $langUserRegisterPostalcode ?>" >
                    <span class="invalid-feedback"><?= $langUserRegisterPostalcodeErr[$postalCode_err] ?></span>
                </div>
                <div class = "form-group">
                    <label for="city"><?= $langUserRegisterCity ?></label>
                    <input type="text" name="city" id="city" class="form-control form-control-sm <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>" placeholder="<?= $langUserRegisterCity ?>" >
                    <span class="invalid-feedback"><?= $langUserRegisterCityErr ?></span>
                </div>
                <div class = "form-group">
                    <label for="telephone"><?= $langUserRegisterTelephone ?></label>
                    <input type="text" name="telephone" id="telephone" class="form-control form-control-sm <?php echo (!empty($telephone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telephone; ?>" placeholder="<?= $langUserRegisterTelephone ?>" >
                    <span class="invalid-feedback"><?= $langUserRegisterTelephoneErr ?></span>
                </div>
                <div class = "form-group">
                    <label for="password"><?= $langUserRegisterPassword ?><sup>*</sup></label>
                    <input type="password" name="password" id="password" class="form-control form-control-sm <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="<?= $langUserRegisterPassword ?>" >
                    <span class="invalid-feedback"><?= $langUserRegisterPasswordErr[$password_err] ?></span>
                </div>
                <div class = "form-group">
                    <label for="passwordCheck"><?= $langUserRegisterPasswordCheck ?><sup>*</sup></label>
                    <input type="password" name="passwordCheck" id="passwordCheck" class="form-control form-control-sm <?php echo (!empty($passwordCheck_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $passwordCheck; ?>" placeholder="<?= $langUserRegisterPasswordCheck ?>" >
                    <span class="invalid-feedback"><?= $langUserRegisterPasswordCheckErr[$passwordCheck_err] ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="<?= $langUserRegisterButton ?>" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="index.php?controller=User&action=login" class="btn btn-light btn-block"><?= $langUserRegisterLogin ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once (__DIR__ . '/../incl/footer.php'); ?>