<?php 
  $path2root = ".";
  $today = date("F j, Y, g:i a");

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
  <nav>
    <div>
      <a href="#">Bookings</a>
    </div>
    <div>
      <a href="#">Map</a>
    </div>
    <div>
      <a href="#">My Trips</a>
    </div>
    <div>
      <a href="#">My Photos</a>
    </div>
    <div>
      <a href="#">My Network</a>
    </div>
    <div>
      <a href="#">Countries</a>
    </div>
    <div>
      <a href="#">Traveler's Cafe</a>
    </div>
    <div>
      <a href="#">Charities</a>
    </div>
  </nav>
</div>

<div id="wrapper">

    <?php if (isset($_SESSION['authenticated'])) { ?>
  
    <div class="container-fluid">

      <div class="btn-toolbar">
        <div id="filters" class="btn-group">
          <a class="btn btn-primary disabled" href="#">Filter:</a>
          <a class="btn" href="#" data-filter="*">Show All</a>
          <a class="btn" href="#" data-filter=".question">Questions</a>
          <a class="btn" href="#" data-filter=".tip">Tips</a>
          <a class="btn" href="#" data-filter=".check-in">Check-ins</a>
          <a class="btn" href="#" data-filter=".review">Reviews</a>
        </div>
        <div id="sort-by" class="btn-group">
          <a class="btn btn-primary disabled" href="#">Sort:</a>
          <a class="btn" href="#title">Title</a>
          <a class="btn" href="#date">Date</a>
          <a class="btn" href="#distance">Distance</a>
          <a class="btn" href="#views">Views</a>
        </div>
      </div>

      <div id="isotope" class="row-fluid">
        <div class="item question">
          <h3 class="title"><a href="#">What is a Biindle</a></h3>
          <span class="label date"><?php echo $today; ?></span>
          <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et lacus mauris, eu luctus nisl. Vestibulum ornare tellus eget nibh porta condimentum. Morbi tincidunt, nunc sed scelerisque dignissim, mauris lacus viverra enim, at consectetur tellus lacus euismod odio.</p>
          <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object" data-src="http://placehold.it/350x150" src="http://placehold.it/32x32">
            </a>
            <div class="media-body">
              <h4 class="media-heading">Media heading</h4>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
           
              <!-- Nested media object -->
              <div class="media">
                ...
              </div>
            </div>
          </div><!-- .media -->
        </div><!-- .item -->
        <div class="item tip">
          <h3 class="title"><a href="#">How do you Biindle?</a></h3>
          <span class="label date"><?php echo $today; ?></span>
          <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et lacus mauris, eu luctus nisl. Vestibulum ornare tellus eget nibh porta condimentum. Morbi tincidunt, nunc sed scelerisque dignissim, mauris lacus viverra enim, at consectetur tellus lacus euismod odio.</p>
        </div><!-- .item -->
        <div class="item check-in">
          <h3 class="title"><a href="#">Why do you Biindle?</a></h3>
          <span class="label date"><?php echo $today; ?></span>
          <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et lacus mauris, eu luctus nisl. Vestibulum ornare tellus eget nibh porta condimentum. Morbi tincidunt, nunc sed scelerisque dignissim, mauris lacus viverra enim, at consectetur tellus lacus euismod odio.</p>
        </div><!-- .item -->
        <div class="item review">
          <h3 class="title"><a href="#">I pitty 'da fool</a></h3>
          <span class="label date"><?php echo $today; ?></span>
          <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et lacus mauris, eu luctus nisl. Vestibulum ornare tellus eget nibh porta condimentum. Morbi tincidunt, nunc sed scelerisque dignissim, mauris lacus viverra enim, at consectetur tellus lacus euismod odio.</p>
        </div><!-- .item -->
        <div class="item question">
          <h3 class="title"><a href="#">Some great thing</a></h3>
          <span class="label date"><?php echo $today; ?></span>
          <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et lacus mauris, eu luctus nisl. Vestibulum ornare tellus eget nibh porta condimentum. Morbi tincidunt, nunc sed scelerisque dignissim, mauris lacus viverra enim, at consectetur tellus lacus euismod odio.</p>
        </div><!-- .item -->
        <div class="item tip">
          <h3 class="title"><a href="#">Awesome stuff</a></h3>
          <span class="label date"><?php echo $today; ?></span>
          <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et lacus mauris, eu luctus nisl. Vestibulum ornare tellus eget nibh porta condimentum. Morbi tincidunt, nunc sed scelerisque dignissim, mauris lacus viverra enim, at consectetur tellus lacus euismod odio.</p>
        </div><!-- .item -->
        <div class="item check-in">
          <h3 class="title"><a href="#">Help me!</a></h3>
          <span class="label date"><?php echo $today; ?></span>
          <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et lacus mauris, eu luctus nisl. Vestibulum ornare tellus eget nibh porta condimentum. Morbi tincidunt, nunc sed scelerisque dignissim, mauris lacus viverra enim, at consectetur tellus lacus euismod odio.</p>
        </div><!-- .item -->
        <div class="item review">
          <h3 class="title"><a href="#">What the?</a></h3>
          <span class="label date"><?php echo $today; ?></span>
          <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et lacus mauris, eu luctus nisl. Vestibulum ornare tellus eget nibh porta condimentum. Morbi tincidunt, nunc sed scelerisque dignissim, mauris lacus viverra enim, at consectetur tellus lacus euismod odio.</p>
        </div><!-- .item -->
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
      // Handle Menu Drawer
      var menuStatus;

      $('#drawer-toggle').on('click', function() {
        var self = this;
        if(!menuStatus) {
          $("#wrapper").animate({marginLeft: "200px"}, 300, "easeInOutCubic", function(){
            menuStatus = true
            $('#drawer-toggle').addClass('btn-danger');
            $('#drawer-toggle').find('i').removeClass('icon-th-list').addClass('icon-remove icon-white');
          });
          $('#menu-drawer nav').animate({opacity:1});
          return false;
        } else {
          $("#wrapper").animate({marginLeft: "0px"}, 300, "easeInOutCubic", function(){
            menuStatus = false
            $('#drawer-toggle').removeClass('btn-danger');
            $('#drawer-toggle').find('i').removeClass('icon-remove icon-white').addClass('icon-th-list');
          });
          $('#menu-drawer nav').animate({opacity:0});
          return false;
        }
      });

      ////////// Isotope functionality //////////

      var $container = $('#isotope');

      // Set-up
      $container.isotope({
        // options
        itemSelector : '.item',
        layoutMode : 'fitRows',
        // Collect sorting data
        getSortData : {
          title : function ( $elem ) {
            return $elem.find('.title').text();
          },
          date : function ( $elem ) {
            return $elem.find('.date').text();
          }
        }
      });

      $('#filters a').click(function(){
        var selector = $(this).attr('data-filter');
        $container.isotope({ filter: selector });
        return false;
      });

      $('#sort-by a').click(function(){
        // get href attribute, minus the '#'
        var sortName = $(this).attr('href').slice(1);
        $container.isotope({ sortBy : sortName });
        return false;
      });


      ////////// End Isotope //////////
      
      // Trigger Photographers Corner Carousel
      $('.carousel').carousel({
        //interval: 2000
      });

      // Show login modal
      $('.login-trigger').on('click', function() {
        $('#login-modal').modal('show');
      });

      // CUstom Scroll Bar
      $('#menu-drawer').jScrollPane({ verticalGutter  : -10 });

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