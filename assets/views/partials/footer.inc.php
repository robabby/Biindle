<?php
// Collect all of the scripts and render them on the page
if ($handle = opendir("$path2root/assets/js")) {

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        if (($entry != "." && $entry != ".." && $entry != "modernizr.custom.48780.js") && strpos($entry, ".js")) {
            echo "<script src=\"/assets/js/".$entry."\"></script>\n";
        }
    }

    closedir($handle);
}
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-39673729-1', 'biindle.com');
  ga('send', 'pageview');
</script>
