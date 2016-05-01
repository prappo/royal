<?php
error_reporting(0);

$feedback = new Feedback();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Testimonial | Royal Testimonial</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->
    <link rel="stylesheet" href="asset/css/materialize.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="asset/css/style.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Favicon-->
    <link rel="apple-touch-icon" sizes="57x57" href="asset/images/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="asset/images/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="asset/images/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="asset/images/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="asset/images/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="asset/images/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="asset/images/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="asset/images/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="asset/images/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="asset/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="asset/images/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="asset/images/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="asset/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="asset/images/favicons/manifest.json">
    <link rel="mask-icon" href="asset/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="asset/images/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="asset/images/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="asset/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
</head>
<body id="testimonial">

<header>
    <nav class="top-nav">
        <div class="container">
            <div class="nav-wrapper">
                <a class="page-title">Testimonials</a>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="profile.php">Hi, <?php echo $_SESSION['username']; ?> </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only">
            <i class="mdi-navigation-menu"></i>
        </a>
    </div>

    <ul id="nav-mobile" class="side-nav fixed">
        <li class="logo">
            <a href="/dashboard">
                <h1>ROYAL</h1>
            </a>
        </li>

       <li class="bold">
            <a href="home.php">Dashboard</a>
        </li>
        <li class="bold">
            <a href="build.php">Builder</a>
        </li>

        <li class="bold">
            <a href="settings.php">Settings</a>
        </li>
        <li class="bold active">
            <a href="testimonials.php">Testimonials</a>
        </li>

        <li class="bold">
            <a href="profile.php">Profile</a>
        </li>

        <li class="bold">
            <a href="logout.php">Logout</a>
        </li>


    </ul>
</header>

<main>
    <div class="container">
        <div class="row counter">
            <div class="col s12 m4 l4">
                <div class="chip">
                    Total Testimonials: <?= $feedback->countAll('data') ?>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="chip">
                    Pending Testimonials: <?= $feedback->count('data', 'status', 'pending') ?>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="chip">
                    Approved Testimonials: <?= $feedback->count('data', 'status', 'approved') ?>
                </div>
            </div>
        </div>

        <?php $feedback->dataList('asset/images/'); ?>
    </div>
</main>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="asset/js/materialize.min.js"></script>
<script src="asset/js/royal.js"></script>
</body>
</html>