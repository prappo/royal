<?php

session_start();

error_reporting(0);

if (!file_exists('class/config/index.php')) {
    header('Location:lib/install.php');
}
if (isset($_SESSION['username'])) {
    header('location:home');
}

include 'class/config/index.php';

try {
    $databaseConnection = new PDO('mysql:host=' . HOST . ';dbname=' . DB . ';charset=utf8', USER, PASS);
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $status = "<script>$(document).ready(function() { $('#errorModal').openModal(); });</script>";
}

if (isset($_POST['submit'])) {
    $errMsg = '';

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == '') {
        $errMsg .= 'You must enter your Username<br>';
    }

    if ($password == '') {
        $errMsg .= 'You must enter your Password<br>';
    }


    if ($errMsg == '') {
        $records = $databaseConnection->prepare('SELECT * FROM user WHERE username = :username');
        $records->bindParam(':username', $username);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        if (count($results) > 0 && $password == $results['password'] && $username == $results['username']) {
            $_SESSION['username'] = $results['username'];
            header('location:home.php');
            exit;
        } else {
            $errMsg .= 'Invalid login credentials';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login| Royal Testimonial</title>

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

    <?= isset($status) ? $status : '' ?>

</head>
<body id="login">
<main class="full-center">
    <div class="row">
        <div class="col s12">
            <div class="valign-wrapper">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img id="brand-logo" src="asset/images/logo-transparent.png" alt="Logo">
                    </div>

                    <div class="card-content">
                        <form method="post">

                            <div class="input-field col s12">
                                <input type="text" class="validate" id="username" name="username" required>
                                <label for="username">Username</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="password" class="validate" id="password" name="password" required>
                                <label for="password">Password</label>
                            </div>

                            <div class="input-field col s12">
                                <button type="submit" class="btn-large waves-effect waves-light" name="submit">Login
                                </button>
                            </div>

                            <div class="input-field col s12">
                                <?= isset($errMsg) ? '<p class="mdi-alert-error materialize-red-text"> ' . $errMsg . '</p>' : false ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Error Modal-->
    <div id="errorModal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Error</h4>
            <p>Something went wrong. Please, ensure you've setup your database credentials correctly.</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>
</main>

</body>
</html>
