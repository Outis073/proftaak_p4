<?php require_once('incl/header.php'); ?>

<div class="container text-center">
	<div class="row justify-content-center dots-row">
		<h1 class="col-md-12 pb-2"><?= $langSearchTitle; ?></h1>
		<p class="col-md-12 lead"><?= $langSearchContent; ?></p>
	</div>
	<h3 class="col-md-12 pt-4 pb-4"><?= $langSearchLabel ?> <strong><?php echo !$search ? $langSearchEmpty : $search; ?></strong></h3>
</div>

<div class="container">
	<?php if (!empty($searchResults)) : ?></p>
		<table class="container table table-hover">
			<thead>
				<tr class="row pb-2">
					<th class="col-md-2">ID</th>
					<th class="col-md-2"><?= $langSearchTableHeaderName ?></th>
					<th class="col-md-8"><?= $langSearchTableHeaderDescription ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($searchResults as $result) : ?>
					<tr class="row">
						<td class="col-md-2"><?php echo $result['id']; ?></td>
						<td class="col-md-2"><?php echo $result['name']; ?></td>
						<td class="col-md-8"><?php echo $result['description']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : echo $langSearchNoResult ?>
	<?php endif; ?>
</div>


<?php require_once('incl/footer.php'); ?>