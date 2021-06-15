<?php require_once('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
	<div class="container">
		<h1 class="display-3"><?= $langHomeTitle; ?></h1>
		<p class="lead"><?= $langHomeContent; ?></p>

		<?php foreach ($models as $product) : ?>
			<section class="section">
				<div class="container">
					<div class="row">
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


		<form method="post" action="index.php?controller=Basket&action=save" enctype='multipart/form-data'>
			<input type='submit' value='<?= $langHomeSaveButton ?>' name='button'>
		</form>
		<form method="post" action="index.php?controller=Basket&action=order" enctype='multipart/form-data'>
			<input type='submit' value='<?= $langHomeOrderButton ?>' name='button'>
		</form>
	</div>
</div>

<?php require_once('incl/footer.php'); ?>