<?php require_once('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
    <div class="container">
        <h1 class="display-3"><?= $langTitle; ?></h1>
        <p class="lead"><?= $langContent; ?></p>

        <form action="" method="post">
            Voornaam: <input type="text" name="first_name"><br>
            Achternaam: <input type="text" name="last_name"><br>
            Email: <input type="text" name="email"><br>
            Bericht:<br><textarea rows="5" name="message" cols="30"></textarea><br>
            <input type="submit" name="submit" value="Submit">
        </form>

    </div>
</div>

<?php require_once('incl/footer.php'); ?>