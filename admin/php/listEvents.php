<?php
require_once '../../php/lib/settings.inc.php';

$command = 'SELECT * FROM events ORDER BY date;';
$result = query($command);

foreach ($result as $key => $line) {
  displayEvent($line['name'], $line['date'], $line['details']);
}
