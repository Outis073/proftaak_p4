<?php require_once ('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
	<div class="container">
		<h1 class="display-3"><?= $langTitle; ?></h1>
		<p class="lead"><?= $langContent; ?></p>
		

		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Image</th>
					<th>Description</th>
					<th>Price</th>
					<th></th>

				</tr>
			</thead>

			<tbody>
				<?php foreach($models as $product) : ?>
					<tr>
						<td><?php echo $product->get('name'); ?></td>
						<td><img src="src/images/<?php echo $product->get('image'); ?>" alt="No image available"></td>
						<td><?php echo $product->get('description'); ?></td>
						<td><?php echo $product->get('price'); ?></td>
						<td><input type="hidden" name="id" value="<?= $product->get('id') ?>"><a href="index.php?controller=Home&action=getOptions">Toevoegen aan winkelwagen</a></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?php require_once ('incl/footer.php'); ?>


