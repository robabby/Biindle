<?php 
  $path2root = "../../..";
  require_once("$path2root/assets/inc/session_timeout.inc.php");
  require_once("$path2root/assets/inc/user_funcs.inc.php");

  if (isset($_SESSION['username']) && isset($_SESSION['authenticated'])) {

    // Set up flag and Session tracking
    $loggedin = true;
    $username = $_SESSION['username'];
    $user_id = queryUserId($username);

    // Prepare $user variable
    $user = $_SESSION['user'];

    // Retrieve User Information
    $conn = dbConnect('read');
    $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    $row = $result->fetch_assoc(); 
    
    try {
    
    include("$path2root/assets/inc/title.inc.php"); 
?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/views/partials/head.inc.php"); ?>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCFtiZPliypwop5Kdc5M2ZI6q35qOpqBjg&sensor=true"></script>
  <script type="text/javascript">
    var positionopts;
    positionopts = {
      enableHighAccuracy: true,
      timeout: 10000} ;
    var headerref;
    var geocoder;
    function init() {
     
     headerref = document.getElementById("header");
     geocoder = new google.maps.Geocoder();
     if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(handler, problemhandler, positionopts);
     }
    else {
      if (document.getElementById("place")) {
        document.getElementById("place").innerHTML = "I'm sorry but geolocation services are not supported by your browser";
        document.getElementById("place").style.color = "#FF0000";
      }
     }
    }
    var listener;
    var map;
    var blatlng;
    var myOptions;
    function handler(position) {
      var mylat = position.coords.latitude;
      var mylong = position.coords.longitude;
      var result;
      makemap(mylat,mylong);
      document.coutput.lat.value = mylat;
      document.coutput.lon.value = mylong;
      document.coutput.acc.value = position.coords.accuracy;
        reversegeo(blatlng);
    }
    function reversegeo(latlng) {
         geocoder.geocode({'latLng': latlng}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
               document.msg.subject.value = results[0].formatted_address;
            } else {
              alert("No results found in reverse geocoding.");
            }
            }
          else {
            alert("Geocoder failed due to: " + status);
          }
        });
    }
    function problemhandler(prob) {
      switch(prob.code) {
      case 1:
       document.getElementById("place").innerHTML = "User declined to share the location information.";
       break;
      case 2:
       document.getElementById("place").innerHTML = "Errors in getting base location.";
       break;
      case 3:
       document.getElementById("place").innerHTML = "Timeout in getting base location.";
      }
      document.getElementById("header").innerHTML = "Base location needs to be set!";
    }
    var xmarker = "../img/6.png";
    function makemap(mylat,mylong) {
      var marker;
        blatlng = new google.maps.LatLng(mylat,mylong);
        myOptions = {
        zoom: 14,
          center: blatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById("place"), myOptions);
        marker = new google.maps.Marker({
                       position: blatlng,
                       title: "Your Location",
                       icon: xmarker,
                       map: map });
      listener = google.maps.event.addListener(map, 'click', function(event) {
          checkit(event.latLng);
          });

    }
    function checkit(clatlng) {
      var distance = dist(clatlng,blatlng);
      var result;
      distance = Math.floor((distance+.005)*100)/100;
      var distanceString = String(distance)+" km. away.";
      var newcoords = String(clatlng.lat())+" lat. "+String(clatlng.lng())+" lng.";
      distanceString = newcoords+" "+distanceString;
      //default teardrop marker
      marker = new google.maps.Marker({
                       position: clatlng,
                       title: distanceString,
                       map: map });
      document.msg.body.value = document.msg.body.value + " However, I really am at "+distanceString;
    }
     function dist(point1, point2) {
        //spherical law of cosines
        var R = 6371; // km
        //var R =  3959; // miles
        var lat1 = point1.lat()*Math.PI/180;
        var lat2 = point2.lat()*Math.PI/180 ;
        var lon1 = point1.lng()*Math.PI/180;
        var lon2 = point2.lng()*Math.PI/180;

    var d = Math.acos(Math.sin(lat1)*Math.sin(lat2) +
                      Math.cos(lat1)*Math.cos(lat2) *
                      Math.cos(lon2-lon1)) * R;
        return d;
    }
  </script>
  <style>
  #place {
    display: block;
    position: relative;
    width:100%;
    height: 350px;
    opacity: 1;
  }
  </style>
</head>
<body id="user" onLoad="init()">
<div id="wrapper">
  <?php include("$path2root/assets/views/partials/nav.inc.php"); ?>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span3">
        <?php include("$path2root/assets/views/partials/user_menu.inc.php"); ?>
      </div>
      <div class="span9">
        <div class="well">
          <a class="btn btn-large question" href="#" title="#">Ask a Question</a>
          <br />
          
          <h1 id="stats" rel="popover" data-original-title="User Stats" data-content="This can be an area to produce statisics like questions asked, vantage points acquired, or badges earned." class="firstLast"><?php echo $user['first_name'] . " " . $user['last_name'];?></h1>
          <br />
          
          <h4>My Website</a>
            <br />
          <a target="_blank" href="<?php echo $row['website']; ?>" title="<?php echo $row['first_name']; ?>'s Website">
            <?php echo $row['website']; ?>
          </a>
          <br />
          <br />
          
          <h4>My Email</a>
            <br />
            <a href="mailto:<?php echo $row['email']; ?>" title="<?php echo $row['first_name']; ?>'s Email">
            <?php echo $row['email']; ?>
          </a>
          <br />
          <br />
          
          <h4>About Me</h4>
          
          <p><?php echo $row['about']; ?></p>
          <br />
        </div><!-- .well -->
        <div class="well">
          <div id="place"></div>
        </div><!-- .well -->
        <div class="well">
          <br>
          <br>
          <br>
        </div><!-- .well -->
        <div class="well">
          <br>
          <br>
          <br>
        </div><!-- .well -->
        <div class="well">
          <br>
          <br>
          <br>
        </div><!-- .well -->
        <div class="well">
          <br>
          <br>
          <br>
        </div><!-- .well -->
        <div class="well">
          <br>
          <br>
          <br>
        </div><!-- .well -->
        <div class="well">
          <br>
          <br>
          <br>
        </div><!-- .well -->
        <div class="well">
          <br>
          <br>
          <br>
        </div><!-- .well -->
      </div><!-- .span9 -->
    </div><!-- row -->
  </div><!-- .container -->
</div><!-- #wrapper -->

<!-- Question Modal -->
<div id="ask-question" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Have a Question?</h3>
  </div>
  <div class="modal-body">
    <p>Ask the Biindle community.</p>
    <form action="" method="">
      <p>
        <label for="topic">What Subject:</label>
        <select name="topic">
          <option>Make a Selection</option>
          <option value="#">Topic 1</option>
          <option value="#">Topic 2</option>
          <option value="#">Topic 3</option>
        </select>
      </p>
      <p>
        <label for="title">What's on your mind?</label>
        <input type="text" name="title" id="title" placeholder="Title your question" />
      </p>
      <p>
        <textarea class="span4" name="body" id="body" placeholder="Please elaborate..." rows="5"></textarea>
      </p>
      <p>
        <div class="input-prepend">
          <a href="#" class="btn"><i class="icon-plus-sign"></i></a>
          <input type="text" class="span4" placeholder="Tag your friends">
        </div>
      </p>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-primary">Submit</button>
  </div>
</div>

<?php include("$path2root/assets/inc/footer.inc.php"); ?>
<script>
(function($) {
  // Popover on name click
  $('#stats').popover({
    animation: true,
    placement: 'bottom'
  });

  // Question Modal
  $('.question').on('click', function() {
    $('#ask-question').modal('show');
  });
})(jQuery);
</script>
</body>
</html>
<?php
  } catch (exception $e) {
    ob_end_clean();
    header("Location: $path2root/error.php");
  }
  ob_end_flush();

} else {
  header('Location: /');
}
?>