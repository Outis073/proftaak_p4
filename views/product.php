<?php require_once ( 'partials/header.php' ); ?>

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
            <td><a href="index.php?controller=Product&action=edit&id=<?php echo $product->get('id'); ?>">Model bewerken</a></td>
            <td><a href="index.php?controller=Product&action=delete&id=<?php echo $product->get('id'); ?>">Model verwijderen</a></td>
            <td>
                <div class="form-group"><form method="post" action="index.php?controller=product&action=changePrice">
                <input type="hidden" name="id" value="<?= $product->get('id') ?>">
                <label for="person">Prijs</label>
                <input type="text" placeholder="Prijs" name="newPrice" id="person" class="form-control" value="<?php echo isset($person) ? $person : ""; ?>" >
            </td>
            <td><button type="submit" name="submit_button" class="btn btn-primary">Prijs veranderen</button></form></div></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
    </table>

<nav>
    <a href="index.php?controller=Product&action=add">Model toevoegen</a>
</nav>
<?php require_once ( 'partials/footer.php' ); ?>