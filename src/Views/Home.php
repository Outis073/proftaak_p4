<?php require_once('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
	<div class="container">
		<h1 class="display-3"><?= $langHomeTitle; ?></h1>
		<p class="lead"><?= $langHomeContent; ?></p>

		<?php foreach ($models as $product) : ?>
			<section class="section mb-4">
				<div class="container">
					<div class="row mb-4">
						<div class="col-md-6 text-center mb-5 mb-md-0">
							<img src="src/images/<?php echo $product->get('image'); ?>" alt="No image available">
						</div>
						<div class="col-md-6 align-self-center text-center text-md-left">
							<div class="block">
								<h2 class="font-weight-bold mb-4 font-size-60"><?php echo $product->get('name'); ?></h2>
								<p class="mb-4"><?php echo $product->get('description'); ?></p>
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

		<div class="row mt-4">
			<form class="col-md-6" method="post" action="index.php?controller=Basket&action=save" enctype='multipart/form-data'>
				<input class="btn btn-main" type='submit' value='<?= $langHomeSaveButton ?>' name='button'>
			</form>
			<form class="col-md-6" method="post" action="index.php?controller=Basket&action=order" enctype='multipart/form-data'>
				<input class="btn btn-main" type='submit' value='<?= $langHomeOrderButton ?>' name='button'>
			</form>
		</div>
	</div>
</div>


<?php require_once('incl/footer.php'); ?>