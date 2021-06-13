<?php require_once('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
    <div class="container">
        <h1 class="display-3"><?= $langTitle; ?></h1>
        <p class="lead"><?= $langContent; ?></p>

        <form action="index.php?controller=Contact&action=sendContactForm" method="post">
            Voornaam: <input type="text" name="first_name" required="required"><br>
            Achternaam: <input type="text" name="last_name" required="required"><br>
            Email: <input type="email" name="email" required="required"><br>
            Bericht:<br><textarea rows="5" name="message" cols="30" required="required"></textarea><br>
            <input type="submit" name="submit" value="Submit">
        </form>

    </div>
</div>

<?php require_once('incl/footer.php'); ?>