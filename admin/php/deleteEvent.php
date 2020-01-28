<?php
if (isset($_GET['id'])) {
  $idEvent = $_GET['id'];

  require('../../php/lib/functions.lib.php');

  $command = 'DELETE FROM events WHERE idEvent = ' . $idEvent . ';';
  query($command);

  echo 'Successfully deleted the event with the id of ' . $idEvent;

  header("Refresh:1; url=../pages/manageEvents.html");
}
