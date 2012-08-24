<?php
  function is_teatime(array $date_array, $global_teatime = false) {
    $weekday = $date_array['weekday'];
    $hours = $date_array['hours'];
    $minutes = $date_array['minutes'];
    if ($global_teatime) {
      $weekNumber = strftime($date_array[0]);
      return $weekday === 'Thursday' && $hours >= 10 && $hours <= 12 && $weekNumber % 2;
    } else {
      return $weekday === 'Friday' && $hours >= 16 && $minutes >= 30 && $hours <= 18;
    }
  }

function remaining(array $date_array) {
  $weekday = $date_array['wday'];
  $hour = $date_array['hours'];
  $minute = $date_array['minutes'];
  $second = $date_array['seconds'];

  $daysLeft = 5 - $weekday;
  if ($hour >= 16 && $minutes >= 30) {
    $daysLeft -= 1;
  }
  if ($daysLeft < 0) {
    $daysLeft += 7;
  }
  $hoursLeft = 16 - $hour;
  if ($hoursLeft < 0) {
    $hoursLeft += 24;
  }
  $minutesLeft = 29 - $minute;
  if ($minutesLeft < 0) {
    $minutesLeft += 60;
  }
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
