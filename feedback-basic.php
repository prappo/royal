<?php
error_reporting(0);
include_once 'admin/class/config.class.php';
include_once 'admin/class/feedback.class.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Testimonial Basic Style | Royal Testimonial</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->
    <link rel="stylesheet" href="admin/asset/css/materialize.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="admin/asset/css/style.css">

    <!--Feedback CSS-->
    <link rel="stylesheet" href="admin/asset/css/feedback.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Favicon-->
    <link rel="apple-touch-icon" sizes="57x57" href="admin/asset/images/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="admin/asset/images/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="admin/asset/images/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="admin/asset/images/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="admin/asset/images/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="admin/asset/images/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="admin/asset/images/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="admin/asset/images/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="admin/asset/images/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="admin/asset/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="admin/asset/images/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="admin/asset/images/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="admin/asset/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="admin/asset/images/favicons/manifest.json">
    <link rel="mask-icon" href="admin/asset/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="admin/asset/images/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="admin/asset/images/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="admin/asset/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
</head>
<body id="feedback-basic">

<nav>
    <div class="container">
        <div class="nav-wrapper">
            <a href="feedback-basic.php" class="brand-logo"><img src="admin/asset/images/logo-transparent.png"
                                                                 alt="Royal Testimonial"></a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li class="active"><a href="feedback-basic.php">View Testimonials</a></li>
                <li><a href="submit-basic.php">Submit Testimonial</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li class="active"><a href="feedback-basic.php">View Testimonials</a></li>
                <li><a href="submit-basic.php">Submit Testimonials</a></li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <?php
                $show = new Feedback();
                $data = $show->settings('form');
                $show->getBasicStyle('admin/asset/images/');
                ?>
            </div>
        </div>
    </div>
</main>

<script src="admin/asset/js/jquery-2.1.1.min.js"></script>
<script src="admin/asset/js/materialize.min.js"></script>
<script src="admin/asset/js/royal.js"></script>

</body>
</html>