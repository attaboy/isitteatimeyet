<!DOCTYPE html>
<html>
<head>
	<title>Is It Tea Time Yet?</title>
	<link href="default.css" rel="stylesheet" type="text/css" media="all" charset="utf-8" />
</head>
<body>
<?
date_default_timezone_set('America/Los_Angeles');
include('functions.php');
$teatime = is_teatime(getdate(), $_REQUEST['global'] == 'true');
if ($teatime): ?>
<div class="answer yes">Yes!</div>
<? else: ?>
<div class="answer no">NO</div><div class="link"><a href="timer/">how long?</a></div>
<? endif; ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22001838-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
