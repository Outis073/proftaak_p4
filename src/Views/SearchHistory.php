<?php require_once ('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
	<div class="container">
		<h1 class="display-3"><?= $title; ?></h1>
		<p class="lead"><?= $content; ?></p>
	</div>



	<table>
		<thead>
			<tr>
				<th>Date</th>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($searchFailures as $failure) : ?>
				<tr>
					<td><?php echo $failure->get('date'); ?></td>
					<td><?php echo $failure->get('term'); ?></td>
					<td>
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

<?php require_once ('incl/footer.php'); ?>