<?php
  function is_teatime(array $date_array, $global_teatime = false) {
    $weekday = $date_array['weekday'];
    $hours = $date_array['hours'];
    if ($global_teatime) {
      return $weekday === 'Thursday' && $hours >= 10 && $hours <= 12;
    } else {
      return $weekday === 'Friday' && $hours >= 16 && $hours <= 18;
    }
  }

function remaining(array $date_array) {
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
  return strlen($callback) > 0 && preg_match('/^[a-z$_][a-z0-9_$]*$/i', $callback);
}
