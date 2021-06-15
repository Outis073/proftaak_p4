<?php require_once ('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
	<div class="container">
		<h1 class="display-3"><?= $langSearchTitle; ?></h1>
		<p class="lead"><?= $langSearchContent; ?></p>
		<p></p>
		<p><?= $langSearchLabel ?> <strong><?php echo !$search ? $langSearchEmpty : $search; ?></strong></p>
	</div>


	<?php if(!empty($searchResults)): ?></p>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th><?= $langSearchTableHeaderName ?></th>
				<th><?= $langSearchTableHeaderDescription ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($searchResults as $result) : ?>
				<tr>
					<td><?php echo $result['id']; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><?php echo $result['description']; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php else: echo $langSearchNoResult ?>
	<?php endif; ?>
</div>

<?php require_once ('incl/footer.php'); ?>


