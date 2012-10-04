<?php 
  $path2root = ".";
  ob_start();
  try {
  include("$path2root/assets/inc/title.inc.php"); 
  require_once("$path2root/assets/inc/connection.inc.php");
?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
  <style>
  input[type="radio"], input[type="checkbox"] {
    margin: -4px 0 0;
    margin-top: 1px 9;
    line-height: normal;
    cursor: pointer;
  }
  </style>
</head>
<body id="blank">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>

<div class="container">
  <div class="well">
    <div class="row-fluid">
      <form method="post" action="">
        <p>
          <label for="howOften"><b>1) How often do you travel for leisure?</b></label>
          <input type="radio" name="howOften" value="I have never traveled before"> I have never traveled before<br>
          <input type="radio" name="howOften" value="Once every few years"> Once every few years<br>
          <input type="radio" name="howOften" value="Once or twice a year"> Once or twice a year<br>
          <input type="radio" name="howOften" value="Several times per year"> Several times per year<br>
          <input type="radio" name="howOften" value="I live on an airplane!"> I live on an airplane!<br>
          <input type="radio" name="howOften" value="other"> Other<br><br>
          If <i>Other</i> please specify:<br>
          <input type="text" name="howOften">
        </p>
        <p>
          <label for="domestic_or_international"><b>2) Do you primarily travel domestically or internationally? What are the main differences between your domestic and international trips?</b></label>
          <textarea name="domestic_or_international" rows="8" class="span12"></textarea>
        </p>
        <p>
          <label for="resources"><b>3) What resources do you use prior to/during your travels?</b></label>
          <input type="checkbox" name="resources" value="Lonely Planet"> Lonely Planet<br>
          <input type="checkbox" name="resources" value="Kayak"> Kayak<br>
          <input type="checkbox" name="resources" value="TripAdvisor"> TripAdvisor<br>
          <input type="checkbox" name="resources" value="AirBNB"> AirBNB<br>
          <input type="checkbox" name="resources" value="Hostelworld/Hostels.co"> Hostelworld/Hostels.com<br>
          <input type="checkbox" name="resources" value="other"> Other<br><br>
          If <i>Other</i> please specify:<br>
          <input type="text" name="resources">
        </p>
        <p>
          <label><b>4) What are the reasons behind your preferred travel resources? What do they offer? Please be as specific as possible. (Ex: Friend recommendation, discounts, reliability, etc.)</b></label>
          <textarea name="domestic_or_international" rows="8" class="span12"></textarea>
      </form>
    </div>
  </div>
</div><!-- .container -->

<?php include("$path2root/assets/inc/footer.inc.php"); ?>
</body>
</html>
<?php
  } catch (exception $e) {
    ob_end_clean();
    header("Location: $path2root/error.php");
  }
  ob_end_flush();
?>