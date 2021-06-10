<?php require_once ('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
	<div class="container">
		<h1 class="display-3"><?= $title; ?></h1>
		<p class="lead"><?= $content; ?></p>
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Category</th>
					<th>Image</th>
					<th>Price</th>
					<th></th>

				</tr>
			</thead>

			<tbody>
				<?php foreach($options as $option) : ?>
					<tr>
						<td><?php echo $option->get('name'); ?></td>
						<td><?php echo $option->get('category'); ?></td>
						<td><img src="src/images/<?php echo $option->get('image'); ?>" alt="No image available"></td>
						<td><?php echo $option->get('price'); ?></td>
						<td><input type="hidden" name="id" value="<?= $option->get('id') ?>"><a href="index.php?controller=Product&action=addToBasket">Toevoegen aan fiets</a></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?php require_once ('incl/footer.php'); ?>


