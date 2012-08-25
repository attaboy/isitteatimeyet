<?php

function calculateTeatimes() {
  $globalTeatime = new DateTime('2012-09-06 10:00');
  $fridayTeatime = new DateTime('2012-09-21 16:30');

  $fourWeeks = new DateInterval('P28D');
  $globalTeatimes = array($globalTeatime->getTimestamp());
  for ($i = 1; $i < 120; $i++) {
    $globalTeatime->add($fourWeeks);
    $globalTeatimes[$i] = $globalTeatime->getTimestamp();
  }
  $fridayTeatimes = array($fridayTeatime->getTimestamp());
  for ($i = 1; $i < 120; $i++) {
    $fridayTeatime->add($fourWeeks);
    $fridayTeatimes[$i] = $fridayTeatime->getTimestamp();
  }

  $teatimes = $globalTeatimes + $fridayTeatimes;
  sort($teatimes);
  return $teatimes;
}

function secondsUntilTeatime() {
  $now = new DateTime();
  $now = $now->getTimestamp();
  $teatimes = calculateTeatimes();
  $remaining = 0;
  $ninetyMinutesInSeconds = 60 * 90;

  foreach ($teatimes as &$teatime) {
    if ($now < $teatime) {
      // time remaining until next teatime
      $remaining = $teatime - $now;
      break;
    } else if ($now >= $teatime && $now <= $teatime + $ninetyMinutesInSeconds) {
      // it's teatime
      break;
    } else {
      // forward to the next teatime
      continue;
    }
  }

  return $remaining;
}

function remaining($seconds) {
  $days = floor($seconds / 86400);
  $seconds -= $days * 86400;

  $hours = floor($seconds / 3600);
  $seconds -= $hours * 3600;

  $minutes = floor($seconds / 60);
  $seconds -= $minutes * 60;

  return array(
    'days' => $days,
    'hours' => $hours,
    'minutes' => $minutes,
    'seconds' => $seconds
  );
}

function isValidJSONPCallback($callback) {
  return strlen($callback) > 0 && preg_match('/^[a-z$_][a-z0-9_$]*$/i', $callback);
}
