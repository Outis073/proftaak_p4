<?php require_once('incl/header.php'); ?>

<div class="container text-center">
	<div class="row justify-content-center dots-row">
		<h1 class="col-md-12 pb-2"><?= $title; ?></h1>
		<p class="col-md-12 lead"><?= $content; ?></p>
	</div>


	<div class="container">
		<table class="container table table-hover">
			<thead>
				<tr class="row">
					<th class="col-md-4">Date</th>
					<th class="col-md-4">Name</th>
					<th class="col-md-4"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($searchFailures as $failure) : ?>
					<tr>
						<td class="col-md-4"><?php echo $failure->get('date'); ?></td>
						<td class="col-md-4"><?php echo $failure->get('term'); ?></td>
						<td class="col-md-4">
							<form method="post" action="index.php?controller=search&action=removeSearch" enctype='multipart/form-data'>
								<input type="hidden" name="id" value="<?= $failure->get('id') ?>">
								<input type='submit' value='Verwijder zoekopdracht' name='remove_search'>
							</form>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?php require_once('incl/footer.php'); ?>