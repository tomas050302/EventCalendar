<?php
function printLine($array)
{
  foreach ($array as $key => $line) {
    echo '<pre>';
    print_r($line);
    echo '</pre>';
  }
}

function query($command)
{
  require('settings.inc.php');
  require($dir_site . '/php/lib/connection.lib.php');

  $result = $connection->query($command);

  return $result;
}

function numRows($query)
{
  return mysqli_num_rows($query);
}

function displayEvent($title, $date, $details)
{
  $formatedDate = date_format(date_create($date), "d/m/Y");

  echo '<div class="eventDetails">';
  echo '<h1 class="eventName">Event Name: ' . $title . '</h1>';
  echo '<span class="dateOfEvent">Date: ' . $formatedDate . '</span><br>';
  echo '<span>Description: ' . $details . '</span>';
  echo '</div>';
}
