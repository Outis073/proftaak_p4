<?php require_once('incl/header.php'); ?>


<div class="container text-center">
	<div class="row justify-content-center dots-row">
		<h1 class="col-md-12"><?= $langHomeTitle; ?></h1>
		<p class="col-md-12 lead"><?= $langHomeContent; ?></p>
	</div>

	<h2> Vita Modellen </h2>
	<?php foreach ($models as $product) : ?>
		<section class="section section-products">
			<div class="container">
				<div class="row mb-4">
					<div class="col-md-6 text-center mb-5 mb-md-0">
						<img src="src/images/<?php echo $product->get('image'); ?>" alt="No image available">
					</div>
					<div class="col-md-6 align-self-center text-center text-md-left">
						<div class="block">
							<h3 class="font-weight-bold mb-4 font-size-60"><?php echo $product->get('name'); ?></h3>
							<p class="mb-4 beschrijving"><?php echo $product->get('description'); ?></p>
							<form method="post" action="index.php?controller=Home&action=getOptions">
								<input type="hidden" name="id" value="<?= $product->get('id') ?>">
								<input class="btn btn-main" type='submit' value='<?= $langHomeAddButton; ?> €<?php echo $product->get('price'); ?>' name='button'>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<div class="row mt-4 dots-row">
		<form class="col-md-6 " method="post" action="index.php?controller=Basket&action=save" enctype='multipart/form-data'>
			<input class="btn btn-main" type='submit' value='<?= $langHomeSaveButton ?>' name='button'>
		</form>
		<form class="col-md-6" method="post" action="index.php?controller=Basket&action=order" enctype='multipart/form-data'>
			<input class="btn btn-main" type='submit' value='<?= $langHomeOrderButton ?>' name='button'>
		</form>
	</div>
</div>



<?php require_once('incl/footer.php'); ?>