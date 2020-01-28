<?php
$name = $_POST['name'];
$description = $_POST['description'];
$date = $_POST['date'];

require('../../php/lib/functions.lib.php');

$command = 'INSERT INTO events (name, details, date) VALUES ("' . $name . '", "' . $description . '", "' . $date . '");';

if (query($command)) {
  echo ("<h1>Event added with success</h1>");
  header("Refresh:1; url=../admin.html");
}
