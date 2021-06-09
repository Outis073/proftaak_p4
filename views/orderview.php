<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #customers td,
    #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #customers tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    #customers tr:hover {
      background-color: #ddd;
    }

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }
  </style>
</head>

<body>

  <h1><?php echo $user; ?></h1>

  <ul class="list-group">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Morbi leo risus</li>
    <li class="list-group-item">Porta ac consectetur ac</li>
    <li class="list-group-item">Vestibulum at eros</li>

    <?php echo $title; ?>
    <?php echo $content; ?>

    <br>
    <br>
    <br>

  </ul>
  <br>
  <br>
  <table id="customers">
    <thead>
      <tr>
        <td>id</td>
        <td>name</td>
        <td>price</td>
        <td>image</td>
        <td>active</td>
        <td>description</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($order as $order) : ?>
        <tr>
          <td><?php echo $order->get('id'); ?></td>
          <td><?php echo $order->get('name'); ?></td>
          <td><?php echo $order->get('price'); ?></td>
          <td><?php echo $order->get('image'); ?></td>
          <td><?php echo $order->get('active'); ?></td>
          <td><?php echo $order->get('description'); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>


  <form action="order.php?controller=order&action=test" method="post">
    <label for="descrpition">taak</label>
    <input type="text" name="description"class="fom-control" id="">
  <input type="submit" value="function">
  </form>

</body>

</html>