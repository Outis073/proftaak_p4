<?php require_once(__DIR__ . '/../incl/header.php'); ?>

<div class="container text-center">
    <div class="row justify-content-center dots-row">
        <h1 class="col-md-12 pb-2"><?= $langUserRegisterTitle; ?></h1>
        <p class="col-md-12 lead"><?= $langUserRegisterContent; ?></p>
    </div>


    <section>

        <div class="row">

            <div class="col-lg-8 mx-auto">
                <div class="bg-white rounded text-center p-5 shadow-down">


                    <form action="index.php?controller=User&action=register" method="POST" class="row">

                        <div class="col-md-12">
                            <input type="text" name="email" class="form-control px-0 mb-4 <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="<?= $langUserRegisterEmail ?>" autofocus>
                            <span class="invalid-feedback"><?= $langUserRegisterEmailErr[$email_err] ?></span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="firstName" class="form-control px-0 mb-4 <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>" placeholder="<?= $langUserRegisterFirstname ?>">
                            <span class="invalid-feedback"><?= $langUserRegisterFirstnameErr ?></span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="lastName" class="form-control px-0 mb-4 <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>" placeholder="<?= $langUserRegisterLastname ?>">
                            <span class="invalid-feedback"><?= $langUserRegisterLastnameErr ?></span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="street" id="street" class="form-control px-0 mb-4 <?php echo (!empty($street_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $street; ?>" placeholder="<?= $langUserRegisterStreet ?>">
                            <span class="invalid-feedback"><?= $langUserRegisterStreetErr ?></span>
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="houseNumber" id="houseNumber" class="form-control px-0 mb-4 <?php echo (!empty($houseNumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $houseNumber; ?>" placeholder="<?= $langUserRegisterHouseNumber ?>">
                            <span class="invalid-feedback"><?= $langUserRegisterHouseNumberErr ?></span>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="postalCode" id="postalCode" class="form-control px-0 mb-4 <?php echo (!empty($postalCode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $postalCode; ?>" placeholder="<?= $langUserRegisterPostalcode ?>">
                            <span class="invalid-feedback"><?= $langUserRegisterPostalcodeErr[$postalCode_err] ?></span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="city" id="city" class="form-control px-0 mb-4 <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>" placeholder="<?= $langUserRegisterCity ?>">
                            <span class="invalid-feedback"><?= $langUserRegisterCityErr ?></span>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="telephone" id="telephone" class="form-control px-0 mb-4 <?php echo (!empty($telephone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telephone; ?>" placeholder="<?= $langUserRegisterTelephone ?>">
                            <span class="invalid-feedback"><?= $langUserRegisterTelephoneErr ?></span>
                        </div>
                        <div class="col-md-12">
                            <input type="password" name="password" id="password" class="form-control px-0 mb-4 <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="<?= $langUserRegisterPassword ?>">
                            <span class="invalid-feedback"><?= $langUserRegisterPasswordErr[$password_err] ?></span>
                        </div>
                        <div class="col-md-12 mb-md-4">
                            <input type="password" name="passwordCheck" id="passwordCheck" class="form-control px-0 mb-4 <?php echo (!empty($passwordCheck_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $passwordCheck; ?>" placeholder="<?= $langUserRegisterPasswordCheck ?>">
                            <span class="invalid-feedback"><?= $langUserRegisterPasswordCheckErr[$passwordCheck_err] ?></span>
                        </div>
                        <div class="row mt-md-4">
                            <div class="col-md-6">
                                <input type="submit" value="<?= $langUserRegisterButton ?>" class="btn btn-main">
                            </div>
                            <div class="col-md-6">
                                <a href="index.php?controller=User&action=login" class="btn btn-main-account"><?= $langUserRegisterLogin ?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>



<?php require_once(__DIR__ . '/../incl/footer.php'); ?>