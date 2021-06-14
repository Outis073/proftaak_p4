<?php require_once('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
	<div class="container">
		<h1 class="display-3"><?= $langTitle; ?></h1>
		<p class="lead"><?= $langContent; ?></p>

		<div class="container">
			<div class="row" id="benaming">
				<div class="col-2">Name</div>
				<div class="col-4">Image</div>
				<div class="col-4">Description</div>
				<div class="col-2">Price</div>
			</div>
			<?php foreach ($models as $product) : ?>
				<div class="row my-auto">
					<div class="col-2"><?php echo $product->get('name'); ?></div>
					<div class="col-4"><img src="src/images/<?php echo $product->get('image'); ?>" alt="No image available"></div>
					<div class="col-4"><?php echo $product->get('description'); ?></div>
					<div class="col-2"><input type="hidden" name="id" value="<?= $product->get('id') ?>"><a href="index.php?controller=Home&action=getOptions" class="btn btn-primary">Toevoegen aan <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
								<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
							</svg></a></div>
				</div>
			<?php endforeach; ?>
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
					<?php foreach ($models as $product) : ?>
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

	<?php require_once('incl/footer.php'); ?>