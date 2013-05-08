<meta charset="utf-8">

<!-- Use the .htaccess and remove these lines to avoid edge case issues.
     More info: h5bp.com/i/378 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

<title>Biindle<?php if (isset($title)) {echo " | {$title}";} ?></title>
<meta name="description" content="Biindle | More eyes to see the world">

<!-- Fonts -->
<link rel="stylesheet" href="/assets/fonts/TradeGothic/stylesheet.css">
<link rel="stylesheet" href="/assets/fonts/Swiss/stylesheet.css">
<link rel="stylesheet" href="/assets/fonts/Opaficio/stylesheet.css">

<!-- Styles & Frameworks -->
<?php
if ($handle = opendir("$path2root/assets/css")) {

    // loop over the directory
    while (false !== ($entry = readdir($handle))) {
    	// Omit any files that do not have a .css extension
        if (($entry != "." && $entry != "..") && strpos($entry, ".css")) {
            echo "<link rel=\"stylesheet\" href=\"/assets/css/".$entry."\">\n";
        }
    }

    closedir($handle);
}
?>

<script src="/assets/js/libs/modernizr-2.5.3.min.js"></script>
<script src="/assets/js/libs/jquery.min.js"></script>