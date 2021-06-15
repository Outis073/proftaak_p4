<?php require_once('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
    <div class="container">
        <h1 class="display-3"><?= $langContactTitle; ?></h1>
        <p class="lead"><?= $langContactContent; ?></p>


        <section class="section">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 mx-auto">
                        <div class="bg-white rounded text-center p-5 shadow-down">
                            <form action="index.php?controller=Contact&action=sendContactForm" method="POST" class="row">
                                <div class="col-md-6">
                                    <input type="text" id="name" name="first_name" placeholder="<?= $langContactFirstName ?>" class="form-control px-0 mb-4" required="required">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="name" name="last_name" placeholder="<?= $langContactLastName ?>" class="form-control px-0 mb-4" required="required">
                                </div>
                                <div class="col-md-12">
                                    <input type="email" id="email" name="email" placeholder="<?= $langContactEmail ?>" class="form-control px-0 mb-4" required="required">
                                </div>
                                <div class="col-md-12">
                                    <textarea name="message" id="message" class="form-control px-0 mb-4" placeholder="<?= $langContactComment ?>" required="required"></textarea>
                                </div>
                                <div class="col-lg-6 col-10 mx-auto">
                                    <input class="btn btn-main-contact" type="submit" name="submit" value="<?= $langContactButton ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

<?php require_once('incl/footer.php'); ?>