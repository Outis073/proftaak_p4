<?php require_once (__DIR__ . '/incl/header.php'); ?>

<h1><?php echo "welkom " . $user; ?></h1>


<?php echo $title; ?>
<?php echo $content; ?>


<br>
<br>
<table id="customers">
  <thead>
    <tr>
      <td>id</td>
      <td>date</td>
      <td>delivery_date</td>
      <td>payment_option</td>
      <td>status</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($orders as $order) : ?>
      <tr>
        <td><?php echo $order->get('id'); ?></td>
        <td><?php echo $order->get('date'); ?></td>
        <td><?php echo $order->get('delivery_date'); ?></td>
        <td><?php echo $order->get('payment_option'); ?></td>
        <td><?php echo $order->get('status'); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<form action="order.php?controller=order&action=test" method="post">
  <label for="descrpition">taak</label>
  <input type="text" name="description"class="fom-control" id="">
<input type="submit" value="function">
</form>

<?php require_once (__DIR__ . '/incl/footer.php'); ?>