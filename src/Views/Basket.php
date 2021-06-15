<?php require_once ('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
	<div class="container">
		<h1 class="display-3"><?= $langHomeTitle; ?></h1>
		<p class="lead"><?= $langHomeContent; ?></p>
		<table>
			<thead>
				<tr>
					<th>Model</th>
					<th>Category</th>
					<th>Image</th>
					<th>Price</th>
					<th></th>

				</tr>
			</thead>

			<tbody>
				<?php foreach($bikes as $bike) : ?>
					<tr>
						<?php $price = $bike->get('model')->get('price'); ?>
						<td><?php echo $bike->get('model')->get('name'); ?></td>
						<td><img src="src/images/<?php echo $bike->get('model')->get('image'); ?>" alt="No image available"></td>
						<td><?php echo $bike->get('model')->get('price'); ?></td>
						<td>
							<?php foreach($bike->get('options') as $option) : ?>
								<?php echo $option->get('name') . "(" . $option->get('price') . ")";
								$price += $option->get('price'); ?>
							<?php endforeach; ?>
						</td>
						<td>Totaal prijs: <?php echo $price; ?></td>
						<td>
							<form method="post" action="index.php?controller=Basket&action=removeBike" enctype='multipart/form-data'>
								<input type="hidden" name="id" value="<?= $bike->get('id') ?>">
	                  			<input type='submit' value='Verwijder fiets' name='button'>
                			</form>
                		</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<form method="post" action="index.php?controller=Basket&action=order" enctype='multipart/form-data'>
  			<input type='submit' value='Bestel' name='button'>
		</form>
	</div>
</div>

<?php require_once ('incl/footer.php'); ?>


