<?php require_once (__DIR__ . '/incl/header.php'); ?>

<h1><?php echo $langOrderGreeting .' '. $_SESSION['user_name']; ?></h1>

<br>
<br>
<p><?php echo $langOrderInfo?></p>
<br>
<br>


<table>
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


<?php require_once (__DIR__ . '/incl/footer.php'); ?>