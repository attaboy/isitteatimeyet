<?php
date_default_timezone_set('America/Los_Angeles');
include('../functions.php');
echo json_encode(array('teatime' => is_teatime(getdate())));