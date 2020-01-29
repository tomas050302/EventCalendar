<?php
require_once '../../php/lib/settings.inc.php';

# Script to use FontAwsome Icons
echo ('<script src="https://kit.fontawesome.com/729ca500a9.js" crossorigin="anonymous"></script>');

$orderBy = isset($_GET['order']) ? $_GET['order'] : 'idEvent';

$command = 'SELECT * FROM events ORDER BY ' . $orderBy . ';';
$result = query($command);

foreach ($result as $key => $line) {
  $formatedDate = date_format(date_create($line['date']), "d/m/Y");

  echo ('
    <tr>
      <td class="centered"><span>' . $line['idEvent'] . '</span></td>
      <td><span>' . $line['name'] . '</span></td>
      <td><span>' . $line['details'] . '</span></td>
      <td class="centered"><span>' . $formatedDate . '</span></td>
      <td class="centered"><a href="manageEvents.php?id=' . $line['idEvent'] . '" class="delete"><i class="fas fa-edit"></i></a></td>
      <td class="centered"><a href="../php/deleteEvent.php?id=' . $line['idEvent'] . '" onclick="return confirm(\'Are you sure you want to delete this record?\');"><i class="fas fa-trash"></i></a></td>
    </tr>
  ');
}
