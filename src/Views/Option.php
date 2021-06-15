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
						<td>
							<form method="post" action="index.php?controller=Basket&action=addOption" enctype='multipart/form-data'>
								<input type="hidden" name="id" value="<?= $option->get('id') ?>">
	                  			<input type='submit' value='Toevoegen aan fiets' name='button'>
                			</form>
                		</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $bike->get('model')->get('name'); ?>
		<img src="src/images/<?php echo $bike->get('model')->get('image'); ?>" alt="No image available">
		<table>
			<thead>
				<tr>
					<th>Toevoeging</th>
					<th>Afbeelding</th>
					<th>Prijs</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($bikeOptions as $bikeOption) : ?>
					<tr>
						<td><?php echo $bikeOption->get('name'); ?></td>
						<td><img src="src/images/<?php echo $bikeOption->get('image'); ?>" alt="No image available"></td>
						<td><?php echo $bikeOption->get('price'); ?></td>
						<td>
							<form method="post" action="index.php?controller=Basket&action=removeOption" enctype='multipart/form-data'>
								<input type="hidden" name="id" value="<?= $bikeOption->get('id') ?>">
	                  			<input type='submit' value='Verwijderen' name='button'>
                			</form>
                		</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<form method="post" action="index.php?controller=Basket&action=addToBasket" enctype='multipart/form-data'>
  			<input type='submit' value='Voeg toe aan winkelwagen' name='button'>
		</form>
	</div>
</div>

<?php require_once ('incl/footer.php'); ?>


