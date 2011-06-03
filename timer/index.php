<!DOCTYPE html>
<html>
<head>
  <title>Is It Tea Time Yet?</title>
  <style>
    body {
      font-family: 'Helvetica Neue', Arial, Helvetica, sans-serif;
      font-weight: 100;
      margin-top: 200px;
    }
    div {
      margin: 50px auto 0;
      font-size: 150px;
      text-align: center;
      width: 3em;
      letter-spacing: .05em;
    }

    #left {
      font-size: 30px;
      width: 30em;
    }
  </style>
  <script src="../jquery-1.5.1.min.js" type="text/javascript" language="javascript" charset="utf-8"></script>
</head>
<body>

<?

date_default_timezone_set('America/Los_Angeles');
$now = getdate();

if ($now['weekday'] == 'Friday' && $now['hours'] >= '16' && $now['hours'] <= '18'): ?>
  <div id="answer">YES!</div> <?

else: ?>
  <div id="answer">NO</div> <?

  $weekday = $now['wday'];
  $hour = $now['hours'];
  $minute = $now['minutes'];
  $second = $now['seconds'];

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
  ?>
  <script>
  var daysLeft = <?=$daysLeft?>;
  var hoursLeft = <?=$hoursLeft?>;
  var minutesLeft = <?=$minutesLeft?>;
  var secondsLeft = <?=$secondsLeft?>;
  </script>
  <div id="left"></div>
  <script>
    var $left = $('#left');

    function update() {
      var updateString = '';
      if (daysLeft) {
        updateString += daysLeft + (daysLeft === 1 ? ' day' : ' days');
      }
      if (hoursLeft) {
        updateString += (updateString ? ', ' : '') + hoursLeft + (hoursLeft === 1 ? ' hour' : ' hours');
      }
      if (minutesLeft) {
        updateString += (updateString ? ', ' : '') + minutesLeft + (minutesLeft === 1 ? ' minute' : ' minutes');
      }
      if (secondsLeft) {
        updateString += (updateString ? ', ' : '') + secondsLeft + (secondsLeft === 1 ? ' second' : ' seconds');
      }
      if (!updateString) {
        window.location.reload();
      }
      $left.html('You need to wait ' + updateString + '.');

      secondsLeft--;
      if (secondsLeft < 0) {
        secondsLeft = 59;
        minutesLeft--;
        if (minutesLeft < 0) {
          minutesLeft = 59;
          hoursLeft--;
          if (hoursLeft < 0) {
            hoursLeft = 23;
            daysLeft--;
            if (daysLeft < 0) {
              window.location.reload();
            }
          }
        }
      }
      window.setTimeout(update, 1000);
    }

    update();
  </script><?
endif; ?>
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
