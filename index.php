<?php 
  $path2root = ".";
  session_start();
  ob_start();
  
  if (isset($_POST['login'])) {
    session_start();
    include("$path2root/assets/inc/authenticate.inc.php");
  }

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
  <script src="/assets/js/jquery.isotope.min.js"></script>
  <style>

  </style>
</head>
<body id="home">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>

<div id="menu-drawer">

</div>

<div id="wrapper">

    <?php if (isset($_SESSION['authenticated'])) { ?>
  
    <div class="container-fluid">

      <div id="isotope" class="row-fluid">
        <div class="well">
          <br>
        </div>
      </div><!-- .row-fluid -->

    </div><!-- .container-fluid -->

    <?php } else { ?>

    <div class="container">
      <div class="row-fluid">
        <div class="hero-unit">
          <h1>More eyes to see the world</h1>
          <!--<a class="btn btn-large btn-primary" href="sign_up.php" title="#">Sign Up Now</a>-->
        </div><!-- .hero-unit -->
      </div><!-- .row-fluid -->
      <div class="row-fluid">
        <div class="span6">
          <div class="well">
            <h2>Welcome to Biindle</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <a class="btn btn-mini btn-success pull-right" href="#">Learn More</a>
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
    
    <div id="login-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Welcome to Biindle!</h3>
      </div>
      <div class="modal-body">
        <form id="form1" method="post" action="">
          <p>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="">
          </p>
          <p>
            <label for="pwd">Password:</label>
            <input type="password" name="pwd" id="pwd">
          </p>
          <p>
            <input class="btn btn-large" name="login" type="submit" id="login" value="Log in">
          </p>
        </form>
      </div>
    </div><!-- #login-modal -->

    <?php } ?>
</div><!-- #wrapper -->

<?php include("$path2root/assets/inc/footer.inc.php"); ?>
<script type="text/javascript">
  (function($) {
    $(document).ready(function() {
      var menuStatus;

      $('#drawer-toggle').on('click', function() {
        if(!menuStatus) {
          $("#wrapper").animate({
            marginLeft: "165px",
          }, 300, function(){menuStatus = true});
          return false;
          } else {
            $("#wrapper").animate({
            marginLeft: "0px",
          }, 300, function(){menuStatus = false});
            return false;
        }
      });

      $('.carousel').carousel({
        //interval: 2000
      });

      $('.login-trigger').on('click', function() {
        $('#login-modal').modal('show');
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