<?php
$idEvent = $_POST['idEvent'];
$name = $_POST['name'];
$details = $_POST['details'];
$date = $_POST['date'];

$command = 'UPDATE events SET idEvent=' . $idEvent . ', name="' . $name . '", details="' . $details . '", date="' . $date . '" WHERE idEvent=' . $idEvent . ';';

require('../../php/lib/functions.lib.php');

if (query($command)) {
  header("Refresh:.5; url=../pages/manageEvents.html");
  echo ('Event Updated successfully');
}
