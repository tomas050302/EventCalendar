<?php require('../lib/auth.inc.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/eventsInput.css">
  <title>Manage Events</title>
</head>

<body>
  <h1>Manage Event</h1>
  <form action="../php/handleUpdate.php" method="POST">
    <?php
    if (isset($_GET['id'])) {
      $idEvent = $_GET['id'];

      require('../../php/lib/functions.lib.php');

      $command = 'SELECT * FROM events WHERE idEvent=' . $idEvent . ';';
      $result = query($command);

      foreach ($result as $key => $line) {
        echo ('
          <input type="hidden" name="idEvent" value="' . $_GET['id'] . '"></input>
          <input type="text" name="name" value="' . $line['name'] . '"></input>
          <input type="text" name="details" value="' . $line['details'] . '"></input>
          <input class="dateInput" name="date" type="date" value="' . $line['date'] . '"></input><br>
          <input class="submitBtn" type="submit" value="Save">
      ');
      }
    } else {
      echo ("You're not authorized in this page!");
    }
    ?>
  </form>
</body>

</html>
