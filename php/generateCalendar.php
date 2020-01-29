<?php
require('lib/settings.inc.php');

$month = isset($_GET['month']) ? $_GET['month'] : date('n');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$today = date('j');

$monthStartDay = date('N', mktime(0, 0, 0, $month, 1, $year));
$nDaysOfMonth = date('t', mktime(0, 0, 0, $month, 1, $year));

$monthsName = array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$daysOfWeek = array('S', 'T', 'Q', 'Q', 'S', 'S', 'D');

$events = getEventsOfMonth($month, $year, $nDaysOfMonth);
buildTableHeading($monthsName, $month, $year);
buildHeadingDaysOfWeek($daysOfWeek);
buildDaysOfMonth($month, $monthStartDay, $nDaysOfMonth, $today, $events, $year);

function getEventsOfMonth($month, $year, $nDaysOfMonth)
{
  $initialDate = $year . '-' . $month . '-1';
  $endingDate = $year . '-' . $month . '-' . $nDaysOfMonth;

  $string = 'SELECT DISTINCT date FROM events WHERE date >= "' . $initialDate . '" AND date <= "' . $endingDate . '";';

  return query($string);
}

function getDayOfEvents($events)
{
  $dates = array();
  foreach ($events as $key => $line) {
    $date = $line['date'];
    $day = str_split($date, 2)[4]; //? Split string in pieces of 2 characters and get the last element (the days in format YYYY-mm-dd)
    $dates[] = $day;
  }

  return $dates;
}

function buildTableHeading($monthsName, $month, $year)
{
  $nextMonth = $month + 1;
  $prevMonth = $month - 1;
  $prevYear = $nextYear = $year;

  if ($prevMonth < 1) {
    $prevYear--;
    $prevMonth = 12;
  } elseif ($nextMonth > 12) {
    $nextYear++;
    $nextMonth = 1;
  }

  echo '
  <tr class="heading">
  <td><a href="?year=' . $prevYear . '&month=' . $prevMonth . '"><</a></td>
  <td colspan="5">' . $monthsName[$month] . ' ' . $year . '</td>
  <td><a href="?year=' . $nextYear . '&month=' . $nextMonth . '">></a></td>
  </tr>
  ';
}

function buildHeadingDaysOfWeek($daysOfWeek)
{
  echo '<tr class="heading">';

  foreach ($daysOfWeek as $key => $day) {
    echo '<td>' . $day . '</td>';
  }

  echo '</tr>';
}

function buildDaysOfMonth($month, $monthStartDay, $nDaysOfMonth, $today, $events, $year)
{
  $eventDays = getDayOfEvents($events);

  echo '<tr>';
  $rows = 1;

  if ($monthStartDay == 1) {
    $rows = 0;
  }

  for ($i = 1; $i < $monthStartDay; $i++) {
    echo '<td class="empty"></td>';
  }

  for ($i = 1; $i <= $nDaysOfMonth; $i++) {
    $hasSpecialStyle = false;

    if (($i + $monthStartDay - 2) % 7 == 0) {
      echo '</tr><tr>';
      $rows++;
    }

    foreach ($eventDays as $key => $eventDay) {
      if ($i == $eventDay) {
        if ($i == $today && $month == date('n')) {
          echo '<td class="today event"><a href="?year=' . $year . '&month=' . $month . '&day=' . $i . '">';
        } else {
          echo '<td class="event"><a href="?year=' . $year . '&month=' . $month . '&day=' . $i . '">';
        }
        $hasSpecialStyle = true;
      }
    }

    if (!$hasSpecialStyle) {
      if ($i == $today && $month == date('n')) {
        echo '<td class="today"><a>';
        $hasSpecialStyle = true;
      }
    }

    if ($hasSpecialStyle) {
      echo $i . '</a></td>';
    } else {
      echo '<td>' . $i . '</td>';
    }
  }

  for ($j = $i - 2 + $monthStartDay; $j < ($rows * 7); $j++) {
    echo '<td class="empty"></td>';
  }

  echo '</tr>';
}
