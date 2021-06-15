<?php require_once('incl/header.php'); ?>

<div class="container text-center">
	<div class="row justify-content-center dots-row mb-4">
		<h1 class="col-md-12 pb-2"><?= $title; ?></h1>
		<p class="col-md-12 lead"><?= $content; ?></p>
	</div>

	<div class="container mt-4">
		<?php foreach ($options as $option) : ?>
			<div class="row mb-4 align-items-center section-options">

				<div class="col-md-3">
					<h5><?php echo $option->get('name'); ?></h5>
				</div>
				<div class="col-md-4"><img src="src/images/<?php echo $option->get('image'); ?>" alt="No image available"></div>
				<div class="col-md-2"><strong>€ <?php echo $option->get('price'); ?></strong></div>
				<div class="col-md-3">
					<form method="post" action="index.php?controller=Basket&action=addOption" enctype='multipart/form-data'>
						<input type="hidden" name="id" value="<?= $option->get('id') ?>">
						<input type='submit' value='Toevoegen aan fiets' name='button' class="btn btn-main-option">
					</form>
				</div>

			</div>
		<?php endforeach; ?>
		<div class="row justify-content-center">
			<h2 class="col-md-12"><?php echo $bike->get('model')->get('name'); ?></h2>
			<img class="col-md-6 align-self-center mb-3" src="src/images/<?php echo $bike->get('model')->get('image'); ?>" alt="No image available">
		</div>


		<div class="container mt-4">
			<div class="row justify-content-center">
				<div class="col-md-6 mt-4 mb-4">
					<h3>Gekozen opties</h3>
				</div>
			</div>

			<?php foreach ($bikeOptions as $bikeOption) : ?>
				<div class="row align-items-center">
					<div class="col-md-3">
						<h5><?php echo $bikeOption->get('name'); ?></h5>
					</div>
					<div class="col-md-4"><img src="src/images/<?php echo $bikeOption->get('image'); ?>" alt="No image available"></div>
					<div class="col-md-2"><strong>€ <?php echo $bikeOption->get('price'); ?></strong></div>
					<div class="col-md-3">
						<form method="post" action="index.php?controller=Basket&action=removeOption" enctype='multipart/form-data'>
							<input type="hidden" name="id" value="<?= $bikeOption->get('id') ?>">
							<input type='submit' value='Verwijderen' name='button' class="btn btn-main">
						</form>
					</div>
				</div>

			<?php endforeach; ?>
			<form method="post" action="index.php?controller=Basket&action=addToBasket" enctype='multipart/form-data'>
				<input type='submit' value='Voeg toe aan winkelwagen' name='button' class="btn btn-main-option">
			</form>

		</div>
	</div>
</div>


<?php require_once('incl/footer.php'); ?>