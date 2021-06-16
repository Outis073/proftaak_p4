<?php require_once(__DIR__ . '/incl/header.php'); ?>

<div class="container-fluid text-center container-admin">
    <div class="row justify-content-center dots-row mb-4">
        <h1 class="col-md-12 pb-2"><?= $title; ?></h1>
    </div>




    <?php foreach ($products as $product) : ?>
        <div class="container bike-section">
            <div class="row align-items-center mt-4 justify-content-center">
                <div class="col-12 mb-4">
                    <h2><?php echo $product->get('name'); ?></h2>
                </div>
                <div class="col-12 border border-info p-3 mb-4">
                    <h5>Beschrijving</h5><br> <?php echo $product->get('description'); ?>
                </div>
                <div class="col-12">


                    <form class="form form-inline d-flex justify-content-center" method="post" action="index.php?controller=Product&action=changePrice">
                        <strong class="mr-4">€ <?php echo $product->get('price'); ?></strong>
                        <input type="hidden" name="id" value="<?= $product->get('id') ?>">
                        <input type="text" placeholder="Prijs" name="newPrice" id="person" class="form-control px-0 mb-4 ml-4" value="<?php echo isset($person) ? $person : ""; ?>">

                        <button type="submit" name="submit_button" class="btn btn-main-admin ml-4">Prijs veranderen</button>

                    </form>

                </div>
                <div class="col-12 mb-3"><img src="src/images/<?php echo $product->get('image'); ?>" alt="No image available"></div>
                <div class="row">
                    <div class="col-12 mb-3 mx-auto">
                        <h5> Afbeelding toevoegen</h5><br>
                        <form class="form-inline mx-auto" method="post" action="index.php?controller=product&action=addImage" enctype='multipart/form-data'>
                            <input class="form-control" type='file' id="formfile" name='file' />
                            <input type="hidden" name="id" value="<?= $product->get('id') ?>">
                            <input class="btn btn-main-admin" type='submit' value="Afbeelding opslaan" name='image_upload'>
                        </form>
                    </div>
                </div>






                <div class="col-12 mt-4">
                    <a class="btn btn-main-admin-edit" href="index.php?controller=Product&action=edit&id=<?php echo $product->get('id'); ?>">Model bewerken</a>
                    <a class="btn btn-main-admin-edit ml-2" href="index.php?controller=Product&action=delete&id=<?php echo $product->get('id'); ?>">Model verwijderen</a>
                </div>

            </div>
        </div>

    <?php endforeach; ?>
</div>

<div class="row align-items-center mt-4 justify-content-center admin-csv">
    <div class="col-12 text-center mb-4">
        <h5>Upload Product CSV bestand hier</h5>
    </div>
    <div class="col-8 d-flex justify-content-center">

        <form class="form-inline" enctype="multipart/form-data" action="index.php?controller=Product&action=addProducts" method="post">
            <input class="form-control" size='50' type='file' name='filename'>
            </br>
            <input class="btn btn-main-admin" type='submit' name='csvModels' value='Product uploaden'>

        </form>
    </div>
    <div class="col-4">
        <nav>
            <a class="btn btn-main-admin-edit" href=" index.php?controller=Product&action=add">Model toevoegen</a>
        </nav>
    </div>

</div>


<?php require_once(__DIR__ . '/incl/footer.php'); ?>