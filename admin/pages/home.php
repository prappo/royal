<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard| Royal Testimonial</title>

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

    <script src="asset/js/jquery-2.1.1.min.js"></script>
    <script src="asset/js/materialize.min.js"></script>
    <script src="asset/js/royal.js"></script>
</head>
<body id="dashboard">

<header>
    <nav class="top-nav">
        <div class="container">
            <div class="nav-wrapper">
                <a class="page-title">Dashboard</a>
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
            <a href="">
                <h1>ROYAL</h1>
            </a>
        </li>

         <li class="bold active">
            <a href="home.php">Dashboard</a>
        </li>
        <li class="bold">
            <a href="build.php">Builder</a>
        </li>

        <li class="bold">
            <a href="settings.php">Settings</a>
        </li>
        <li class="bold">
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
        <div class="row">
            <div class="col s12 m6 l6">
                <div class="card white">
                    <div class="card-content grey-text text-darken-4 center-align">
                        <div class="card-title"><i class="material-icons medium materialize-red-text">description</i>
                        </div>
                        <span class="card-title">Total Forms</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="settings.php">View All Forms</a>
                        <a href="settings">
                            <div class="chip orange accent-2 grey-text text-darken-4"><?php $feedback = new Feedback();
                                $feedback->countAll('form') ?></div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col s12 m6 l6">
                <div class="card white">
                    <div class="card-content grey-text text-darken-4 center-align">
                        <div class="card-title"><i class="material-icons medium teal-text">textsms</i></div>
                        <span class="card-title">Total Testimonials</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="testimonials.php">View All Testimonials</a>
                        <a href="testimonials.php">
                            <div
                                class="chip orange accent-2 grey-text text-darken-4"><?php $feedback->countAll('data') ?></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m6 l6">
                <div class="card white">
                    <div class="card-content grey-text text-darken-4 center-align">
                        <div class="card-title"><i class="material-icons medium blue-grey-text">error_outline</i></div>
                        <span class="card-title">Pending Testimonials</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="testimonials.php">View Pending Testimonials</a>
                        <a href="testimonials.php">
                            <div class="chip orange accent-2 grey-text text-darken-4"><?php $feedback->count('data',
                                    'status', 'pending') ?></div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col s12 m6 l6">
                <div class="card white">
                    <div class="card-content grey-text text-darken-4 center-align">
                        <div class="card-title"><i class="material-icons medium orange-text">verified_user</i></div>
                        <span class="card-title">Approved Testimonials</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="testimonials.php">View Approved Testimonials</a>
                        <a href="testimonials.php">
                            <div class="chip orange accent-2 grey-text text-darken-4"><?php $feedback->count('data',
                                    'status', 'approved') ?></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>