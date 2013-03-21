<?php 
  $path2root = ".";
  session_start();
  ob_start();
  if (isset($_SESSION['authenticated'])) {
    include("$path2root/assets/inc/user_funcs.inc.php");
    $username = $_SESSION['username'];
    // create database connection
    require_once("$path2root/assets/inc/connection.inc.php");
    $conn = dbConnect('read');
    $sql = "SELECT * FROM users WHERE username = '".$username."'";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    $row = $result->fetch_assoc(); 
    $user_id = $row['user_id'];
  } 
  try {
?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="home">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="hero-unit">
      <h1>More eyes to see the world</h1>
      <br />
      <br />
      <a class="btn btn-large btn-primary" href="sign_up.php" title="#">Sign Up Now</a>
    </div><!-- .hero-unit -->
  </div><!-- .row-fluid -->
  <div class="row-fluid">
    <div class="span6">
      <div class="well">
        <h2>Welcome to Biindle</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
      </div>
    </div><!-- .span6 -->
    <div class="span6">
      <div class="well carousel-wrapper">
        <div id="photography" class="carousel slide">
        <!-- Carousel items -->
        <div class="carousel-inner">
          <div class="active item">
            <img src="http://placekitten.com/1024/480" />
            <div class="carousel-caption">
              <h4>Photographers corner</h4>
              <p>Hey, check out this super cute photo of a kitten!  Isn't that excellent photography!?</p>
            </div>
          </div>
          <div class="item">
            <img src="http://placekitten.com/1024/480" />
            <div class="carousel-caption">
              <h4>Photographers corner</h4>
              <p>Oh my gosh, another one?  This guy is good!</p>
            </div>
          </div>
          <div class="item">
            <img src="http://placekitten.com/1024/480" />
            <div class="carousel-caption">
              <h4>Photographers corner</h4>
              <p>Well I'll be damned, another kitten...</p>
            </div>
          </div>
        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#photography" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#photography" data-slide="next">&rsaquo;</a>
      </div>
      </div>
    </div><!-- .span6 -->
  </div><!-- .row-fluid -->
</div><!-- .container -->

<?php include("$path2root/assets/inc/footer.inc.php"); ?>
<script type="text/javascript">
  (function($) {
    $(document).ready(function() {
      $('.carousel').carousel({
        //interval: 2000
      });
    }) // document.ready
  })(jQuery)
</script>
</body>
</html>
<?php
  } catch (exception $e) {
    ob_end_clean();
    header("Location: $path2root/error.php");
  }
  ob_end_flush();
?>