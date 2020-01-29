<?php
require_once 'lib/functions.lib.php';

$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$month = isset($_GET['month']) ? $_GET['month'] : date('n');
$day = isset($_GET['day']) ? $_GET['day'] : 0;

$date = $year . '-' . $month . '-' . $day;

$command = "SELECT name, date, details FROM events WHERE date='$date';";

$query = query($command);

$initialDate = $year . '-' . $month . '-1';
$endingDate = $year . '-' . $month . '-' . $nDaysOfMonth;

$command = 'SELECT * FROM events WHERE date >= "' . $initialDate . '" AND date <= "' . $endingDate . '";';
$res = query($command);

$nEvents = numRows($res);

$events = array();

foreach ($query as $key => $value) {
  $events[] = $value;
}

if ($day != 0) {
  echo '<h1 class="title">Events of day ' . $day . '</h1>';
  foreach ($events as $key => $line) {
    displayEvent($line['name'], $line['date'], $line['details']);
  }
} elseif ($nEvents > 0) {
  $nDaysOfMonth = date('t', mktime(0, 0, 0, $month, 1, $year));

  $string = 'SELECT * FROM events WHERE date >= "' . $initialDate . '" AND date <= "' . $endingDate . '" ORDER BY date;';
  $result = query($string);

  echo '<h1 class="title">Events of ' . date('F', mktime(0, 0, 0, $month, 1, $year)) . '</h1>';
  foreach ($result as $key => $line) {
    displayEvent($line['name'], $line['date'], $line['details']);
  }
} else {
  echo '<h1 class="title">No events this month!</h1>';
}
