<?php require_once(__DIR__ . '/incl/header.php'); ?>

<div class="container text-center">
  <div class="row justify-content-center dots-row">
    <h1 class="col-md-12 pb-2"><?php echo $langOrderGreeting . ' ' . $_SESSION['user_name']; ?></h1>
    <p class="col-md-12 lead"><?php echo $langOrderInfo ?></p>
  </div>


  <div class="container">
    <table class="container table table-hover">
      <thead>
        <tr class="row pb-2 text-center">
          <th class="col-md-2 text-center"><strong>ID</strong></th>
          <th class="col-md-3 text-center"><strong>Date</strong></th>
          <th class="col-md-3 text-center"><strong>Delivery date</strong></th>
          <th class="col-md-2 text-center"><strong>Payment option</strong></th>
          <th class="col-md-2 text-center"><strong>Status</strong></th>


        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order) : ?>
          <tr class="row pb-2">
            <td class="col-md-2"><?php echo $order->get('id'); ?></td>
            <td class="col-md-3"><?php echo $order->get('date'); ?></td>
            <td class="col-md-3"><?php echo $order->get('delivery_date'); ?></td>
            <td class="col-md-2"><?php echo $order->get('payment_option'); ?></td>
            <td class="col-md-2"><?php echo $order->get('status'); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>


</div>

<?php require_once(__DIR__ . '/incl/footer.php'); ?>