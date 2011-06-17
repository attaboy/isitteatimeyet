<?php
date_default_timezone_set('America/Los_Angeles');
include('../functions.php');
$format = $_GET['format'] ? $_GET['format'] : 'json';
$now = getdate();
$teatime = is_teatime($now);

switch($format) {
  case 'json':
    header('Content-type: application/json');
    $rsp = json_encode(array('teatime' => $teatime, 'remaining' => remaining($now)));
    if ($_GET['callback'] && isValidJSONPCallback($_GET['callback'])) {
      $rsp = $_GET['callback'] . "($rsp);";
    }
    echo $rsp;
    break;
  case 'xml':
    header('Content-type: text/xml');
    $xml_teatime = $teatime ? 'true' : 'false';
    $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<teatime>
  <$xml_teatime />
</teatime>
XML;
    echo $xml;
    break;
  default:
    header("HTTP/1.0 406 Not Acceptable");
    echo "Invalid format";
    die();
}