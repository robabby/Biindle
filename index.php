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
  <?php include("$path2root/assets/views/partials/head.inc.php"); ?>
  <script src="/assets/js/jquery.isotope.min.js"></script>
  <style>

  </style>
</head>
<body id="home">

<?php include("$path2root/assets/views/partials/nav.inc.php"); ?>

<?php include("$path2root/assets/views/partials/menu-drawer.inc.php"); ?>

<div id="wrapper">

    <?php 
    if (isset($_SESSION['authenticated'])) { 
  
      include("$path2root/assets/views/partials/index-authenticated.inc.php");

    } else {

      include("$path2root/assets/views/partials/index-default.inc.php");

    } 
    ?>
</div><!-- #wrapper -->

<?php include("$path2root/assets/views/partials/footer.inc.php"); ?>
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