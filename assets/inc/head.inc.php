<?php
  require_once("$path2root/assets/inc/mobile-detect/Mobile_Detect.php");
  $detect = new Mobile_Detect(); 
?>
<meta charset="utf-8">

<!-- Use the .htaccess and remove these lines to avoid edge case issues.
     More info: h5bp.com/i/378 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

<title>Biindle | <?php if (isset($title)) {echo "{$title}";} ?></title>
<meta name="description" content="Biindle | More eyes to see the world">

<!-- Fonts -->
<link rel="stylesheet" href="/assets/fonts/TradeGothic/stylesheet.css">
<link rel="stylesheet" href="/assets/fonts/Swiss/stylesheet.css">
<link rel="stylesheet" href="/assets/fonts/Quicksand/stylesheet.css">
<link rel="stylesheet" href="/assets/fonts/Sansation/stylesheet.css">
<link rel="stylesheet" href="/assets/fonts/Delicious/stylesheet.css">
<link rel="stylesheet" href="/assets/fonts/Opaficio/stylesheet.css">

<!-- Styles & Frameworks -->
<link rel="stylesheet" href="/assets/css/reset.css">
<link rel="stylesheet" href="/assets/css/bootstrap.css">
<link rel="stylesheet" href="/assets/css/bootstrap-responsive.css">
<link rel="stylesheet" href="/assets/css/animate.css">
<link rel="stylesheet" href="/assets/css/style.css">

<script src="/assets/js/libs/modernizr-2.5.3.min.js"></script>
<script src="/assets/js/libs/jquery-1.7.1.min.js"></script>