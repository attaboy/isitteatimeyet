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
  include('../functions.php');
  $isGlobal = $_REQUEST['global'] === 'true';
  $now = getdate();
  $teatime = is_teatime($now, $isGlobal);

  if ($teatime) {
?>
    <div class="answer yes">Yes!</div>
<?
  } else {
?>
    <div class="answer no">NO</div>
    <div id="left"></div>
    <script>
      var data = {remaining: {}};
      var daysLeft;
      var hoursLeft;
      var minutesLeft;
      var secondsLeft;

      function update() {
        var updateString = [];
        if (daysLeft) {
          updateString.push(daysLeft + (daysLeft === 1 ? ' day' : ' days'));
        }
        if (hoursLeft) {
          updateString.push(hoursLeft + (hoursLeft === 1 ? ' hour' : ' hours'));
        }
        if (minutesLeft) {
          updateString.push(minutesLeft + (minutesLeft === 1 ? ' minute' : ' minutes'));
        }
        if (secondsLeft) {
          updateString.push(secondsLeft + (secondsLeft === 1 ? ' second' : ' seconds'));
        }
        if (updateString.length === 0) {
          window.location.reload();
        }
        $('#left').html('You need to wait ' + updateString.join(', ') + '.');

        --secondsLeft;
        if (secondsLeft < 0) {
          secondsLeft = 59;
          --minutesLeft;
          if (minutesLeft < 0) {
            minutesLeft = 59;
            --hoursLeft;
            if (hoursLeft < 0) {
              hoursLeft = 23;
              --daysLeft;
              if (daysLeft < 0) {
                window.location.reload();
              }
            }
          }
        }
        window.setTimeout(update, 1e3);
      }

      function fetchData() {
        $.getJSON('../api/1/teatime.json', function (apiData) {
          daysLeft = apiData.remaining.days;
          hoursLeft = apiData.remaining.hours;
          minutesLeft = apiData.remaining.minutes;
          secondsLeft = apiData.remaining.seconds;
          update();
        });
      }

      fetchData();
    </script>
<?
  }
?>
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
