<?php
$idEvent = $_POST['idEvent'];
$name = $_POST['name'];
$details = $_POST['details'];
$date = $_POST['date'];

$command = 'UPDATE events SET idEvent=' . $idEvent . ', name="' . $name . '", details="' . $details . '", date="' . $date . '" WHERE idEvent=' . $idEvent . ';';

require_once '../../php/lib/settings.inc.php';

if (query($command)) {
  echo ('<h1>Event Updated successfully</h1>');
  header("Refresh:.5; url=../pages/manageEvents.html");
}
