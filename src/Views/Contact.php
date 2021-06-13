<?php require_once('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
    <div class="container">
        <h1 class="display-3"><?= $langContactTitle; ?></h1>
        <p class="lead"><?= $langContactContent; ?></p>

        <form action="index.php?controller=Contact&action=sendContactForm" method="post">
        <?= $langContactFirstName ?> <input type="text" name="first_name" required="required"><br>
        <?= $langContactLastName ?> <input type="text" name="last_name" required="required"><br>
        <?= $langContactEmail ?><input type="email" name="email" required="required"><br>
        <?= $langContactComment ?><br><textarea rows="5" name="message" cols="30" required="required"></textarea><br>
            <input type="submit" name="submit" value="<?= $langContactButton ?>">
        </form>

    </div>
</div>

<?php require_once('incl/footer.php'); ?>