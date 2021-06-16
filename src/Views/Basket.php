<?php require_once('incl/header.php'); ?>

<div class="container text-center">
	<div class="row justify-content-center dots-row">
		<h1 class="col-md-12 p-2"><?= $title; ?></h1>
		<p class="lead">De mooiste fietsen</p>

	</div>
	<section class="section">
		<div class="container">

			<div class="row d-flex align-items-center">
				<?php foreach ($bikes as $bike) : ?>

					<?php $price = $bike->get('model')->get('price'); ?>

					<div class="col-6 mb-4">
						<h2><?php echo $bike->get('model')->get('name'); ?></h2>
					</div>
					<div class="col-6 mb-4"><img src="src/Images/<?php echo $bike->get('model')->get('image'); ?>" alt="No image available"></div>

					<div class="col-2"><strong>
							<p>Prijs fiets:</p>€ <?php echo $bike->get('model')->get('price'); ?>
						</strong></div>
					<div class="col-5">
						<p class="text-center"><strong>Opties:</strong></p>
						<?php foreach ($bike->get('options') as $option) : ?>
							<?php echo $option->get('name') . "(" . $option->get('price') . ")<br>";
							$price += $option->get('price'); ?>
						<?php endforeach; ?>
					</div>
					<div class="col-2"><strong>
							<p>Totaal prijs:</p> € <?php echo $price; ?>
						</strong></div>
					<div class="col-3">
						<form method="post" action="index.php?controller=Basket&action=removeBike" enctype='multipart/form-data'>
							<input type="hidden" name="id" value="<?= $bike->get('id') ?>">
							<input type='submit' value='Verwijder fiets' name='button' class="btn btn-main-admin-edit">
						</form>
					</div>


				<?php endforeach; ?>
			</div>
			<div class="col-12 mt-4">
				<form method="post" action="index.php?controller=Basket&action=order" enctype='multipart/form-data'>
					<input type='submit' value='Bestel' name='button' class="btn btn-main">
				</form>
			</div>
		</div>
	</section>
</div>


<?php require_once('incl/footer.php'); ?>