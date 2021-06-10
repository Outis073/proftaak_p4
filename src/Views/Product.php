<?php require_once (__DIR__ . '/incl/header.php'); ?>

<h1><?php echo $title; ?></h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($products as $product) : ?>
        <tr>
            <td><?php echo $product->get('id'); ?></td>
            <td><?php echo $product->get('name'); ?></td>
            <td><?php echo $product->get('description'); ?></td>
            <td><?php echo $product->get('price'); ?></td>
            <td><img src="src/images/<?php echo $product->get('image'); ?>" alt="No image available"></td>
            <td><a href="index.php?controller=Product&action=edit&id=<?php echo $product->get('id'); ?>">Model bewerken</a></td>
            <td><a href="index.php?controller=Product&action=delete&id=<?php echo $product->get('id'); ?>">Model verwijderen</a></td>
            <td>
                <form method="post" action="index.php?controller=product&action=changePrice">
                <input type="hidden" name="id" value="<?= $product->get('id') ?>">
                <input type="text" placeholder="Prijs" name="newPrice" id="person" class="form-control" value="<?php echo isset($person) ? $person : ""; ?>" >
            </td>
            <td><button type="submit" name="submit_button" class="btn btn-primary">Prijs veranderen</button></form></td>
            <td>
                <form method="post" action="index.php?controller=product&action=addImage" enctype='multipart/form-data'>
                  <input type='file' name='file' />
                  <input type="hidden" name="id" value="<?= $product->get('id') ?>">
                  <input type='submit' value='Save image' name='image_upload'>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
    <form enctype="multipart/form-data" action="index.php?controller=product&action=addProducts" method="post">
            
        <label>Upload Product CSV file Here</label>

        <input size='50' type='file' name='filename'>
        </br>
        <input type='submit' name='csvModels' value='Upload Products'>

    </form>
<nav>
    <a href="index.php?controller=Product&action=add">Model toevoegen</a>
</nav>
<?php require_once (__DIR__ . '/incl/footer.php'); ?>