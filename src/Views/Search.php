<?php require_once ('incl/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">
	<div class="container">
		<h1 class="display-3"><?= $title; ?></h1>
		<p class="lead"><?= $content; ?></p>
		<p></p>
		<p>U heeft gezocht op: <strong><?= $search; ?></strong></p>
	</div>



	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
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
</div>

<?php require_once ('incl/footer.php'); ?>


