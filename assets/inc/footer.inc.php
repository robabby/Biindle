  

  <script src="/assets/js/bootstrap.js"></script>
  <script src="/assets/js/jquery.easing.js"></script>
  <script>
    $('#drawer ul li a').tooltip('show');
    $("#toggle").click(function () {
      $("#drawer").slideToggle(1000, 'easeInOutCubic', function() {
        // Animation complete.
      });
    });
  </script>
  <script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
  