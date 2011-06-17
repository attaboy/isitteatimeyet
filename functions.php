<?php
function is_teatime($date_array) {
  return $date_array['weekday'] == 'Friday' && $date_array['hours'] >= '16' && $date_array['hours'] <= '18';
}

function remaining($date_array) {
  $weekday = $date_array['wday'];
  $hour = $date_array['hours'];
  $minute = $date_array['minutes'];
  $second = $date_array['seconds'];

  $daysLeft = 5 - $weekday;
  if ($hour >= 16) {
    $daysLeft -= 1;
  }
  if ($daysLeft < 0) {
    $daysLeft += 7;
  }
  $hoursLeft = 15 - $hour;
  if ($hoursLeft < 0) {
    $hoursLeft += 24;
  }
  $minutesLeft = 59 - $minute;
  $secondsLeft = 59 - $second;

  return array(
    'days' => $daysLeft,
    'hours' => $hoursLeft,
    'minutes' => $minutesLeft,
    'seconds' => $secondsLeft
  );
}

function isValidJSONPCallback($callback) {
  return preg_match('/^[a-z$_][a-z0-9_$]*$/', $callback);
}