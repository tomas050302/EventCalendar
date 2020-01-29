<?php
if (isset($_GET['id'])) {
  $idEvent = $_GET['id'];

  require_once '../../php/lib/settings.inc.php';

  $command = 'DELETE FROM events WHERE idEvent = ' . $idEvent . ';';
  query($command);

  echo 'Successfully deleted the event with the id of ' . $idEvent;

  header("Refresh:1; url=../pages/manageEvents.html");
}
