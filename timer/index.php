<!DOCTYPE html>
<html>
<head>
  <title>Is It Tea Time Yet?</title>
  <link href="../default.css" rel="stylesheet" type="text/css" media="all" charset="utf-8" />
  <style>
    body {
      margin-top: 200px;
    }
    div {
      margin-bottom: 0;
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
include("../functions.php");
$now = getdate();
$teatime = is_teatime($now);

if ($teatime): ?>
  <div class="answer yes">Yes!</div> <?

else: ?>
  <div class="answer no">NO</div> <?

  $remaining = remaining($now);
  ?>
  <div id="left"></div>
  <script>
    var data = { remaining: {}};
    var daysLeft;
    var hoursLeft;
    var minutesLeft;
    var secondsLeft;
    var $left = $('#left');

    function fetchData() {
      $.getJSON("../api/1/teatime.json", function(apiData) {
        data = apiData;
        daysLeft = data.remaining.days;
        hoursLeft = data.remaining.hours;
        minutesLeft = data.remaining.minutes;
        secondsLeft = data.remaining.seconds;
        update();
      });
    }

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

    fetchData();
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
