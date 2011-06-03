<!DOCTYPE html>
<html>
<head>
	<title>Is It Tea Time Yet?</title>
	<style>
	  body {
	    font-family: 'Helvetica Neue', Arial, Helvetica, sans-serif;
	    font-weight: 100;
	    margin-top: 150px;
	  }
	  div {
	    margin: 50px auto;
	    font-size: 150px;
	    text-align: center;
	    width: 3em;
	    letter-spacing: .05em;
	  }
	  div.link {
	    position: fixed;
	    bottom: 0;
	    left: 0;
	    right: 0;
	    font-size: 16px;
	    width: auto;
	    font-weight: 200;
	    margin-bottom: 30px;
	  }
	  a {
	    text-decoration: none;
	    color: #CCC;
	  }

	  a:hover {
	    color: red;
	  }
	</style>
</head>
<div>
<body>
<?
date_default_timezone_set('America/Los_Angeles');
$now = getdate();
if ($now['weekday'] == 'Friday' && $now['hours'] >= '16' && $now['hours'] <= '18'): ?>
YES</div>";
<? else: ?>
NO</div><div class="link"><a href="timer/">how long?</a></div>
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
