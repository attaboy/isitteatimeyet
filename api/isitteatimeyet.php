<?php
  date_default_timezone_set('America/Los_Angeles');
  include('../functions.php');
  $format = array_key_exists('format', $_GET) ? $_GET['format'] : 'json';
  $now = getdate();
  $remaining = secondsUntilTeatime();
  $teatime = $remaining === 0;

  $header = 'HTTP/1.0 406 Not Acceptable';
  $response = 'Invalid format';
  if ($format === 'json') {
    $header = 'Content-type: application/json';
    $response = json_encode(array('teatime' => $teatime, 'remaining' => remaining($remaining), 'interval' => $remaining));
    $callback = array_key_exists('callback', $_GET) ? $_GET['callback'] : null;
    if (isValidJSONPCallback($callback)) {
      $response = $callback . '(' . $response . ');';
    }
  } else if ($format === 'xml') {
    $header = 'Content-type: text/xml';
    $xml_teatime = $teatime ? 'true' : 'false';
    $response = <<<XML
      <?xml version="1.0" encoding="UTF-8"?>
      <teatime>
        <{$xml_teatime} />
      </teatime>
XML;
  }
  header($header);
  echo $response;
