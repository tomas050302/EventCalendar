<?php
require('/opt/lampp/htdocs/calendario/php/lib/settings.inc.php');
require($dir_site . 'php/lib/functions.lib.php');

$command = 'SELECT * FROM events ORDER BY date;';
$result = query($command);

foreach ($result as $key => $line) {
  displayEvent($line['name'], $line['date'], $line['details']);
}
