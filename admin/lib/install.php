<?php

error_reporting(0);

if (file_exists('../class/config/index.php')) {
    header('location: ../login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Installation Wizard | Royal Testimonial</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->
    <link rel="stylesheet" href="../asset/css/materialize.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="../asset/css/style.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Favicon-->
    <link rel="apple-touch-icon" sizes="57x57" href="../asset/images/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../asset/images/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../asset/images/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../asset/images/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../asset/images/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../asset/images/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../asset/images/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../asset/images/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../asset/images/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="../asset/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="../asset/images/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="../asset/images/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="../asset/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="../asset/images/favicons/manifest.json">
    <link rel="mask-icon" href="../asset/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../asset/images/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="../asset/images/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="../asset/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <script src="../asset/js/jquery-2.1.1.min.js"></script>
    <script src="../asset/js/materialize.min.js"></script>
</head>
<body id="installation">
<main class="full-center">
    <div class="row">
        <div class="col s12">
            <div class="valign-wrapper">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img id="brand-logo" src="../asset/images/logo-transparent.png" alt="Logo">
                    </div>

                    <div class="card-content">
                        <form method="post">

                            <div class="input-field col s12">
                                <input type="text" class="validate" id="host" name="host" required>
                                <label for="host">Host Name</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" class="validate" id="db_name" name="db_name" required>
                                <label for="db_name">Database Name</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" class="validate" id="user" name="user" required>
                                <label for="user">Database Username</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="password" class="validate" id="pass" name="pass" required>
                                <label for="pass">Database User Password</label>
                            </div>

                            <div class="input-field col s12">
                                <button type="submit" class="btn-large waves-effect waves-light" name="install">
                                    Install Now
                                </button>
                            </div>

                            <div class="input-field col s12">
                                <?php
                                if (isset($_POST['install'])) {
                                    $host = $_POST['host'];
                                    $username = $_POST['user'];
                                    $password = $_POST['pass'];
                                    $dbname = $_POST['db_name'];
                                    if ($host == '') {
                                        echo '<p class="mdi-alert-error materialize-red-text"> Enter Host Name</p>';
                                    } elseif ($username == '') {
                                        echo '<p class="mdi-alert-error materialize-red-text"> Enter Username</p>';
                                    } elseif ($dbname == '') {
                                        echo '<p class="mdi-alert-error materialize-red-text"> Enter Database Name</p>';
                                    } else {
                                        try {
                                            $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username,
                                                $password);
                                            if ($db) {
                                                $db->query("
                        CREATE TABLE IF NOT EXISTS `data` (
                          `id` int(10) NOT NULL,
                          `value` text NOT NULL,
                          `status` varchar(10) NOT NULL
                        ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

                        CREATE TABLE IF NOT EXISTS `form` (
                          `id` int(5) NOT NULL,
                          `name` varchar(50) NOT NULL,
                          `data` text NOT NULL
                        ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

                        INSERT INTO `form` (`id`, `name`, `data`) VALUES
                        (1, 'Default', '<form style=\"padding: 20px\" class=\"z-depth-1\" id=\"rendered-form\" method=\"post\" action=\"action.php\"><div class=\"form-group\"><label for=\"name\">Name</label> <input name=\"name\" required=\"true\" id=\"name\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"position\">Positiion</label> <input name=\"position\" required=\"false\" id=\"position\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"companyname\">Company Name</label> <input name=\"companyname\" required=\"false\" id=\"companyname\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"companywebsite\">Company Website</label> <input name=\"companywebsite\" required=\"false\" id=\"companywebsite\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"email\">Email</label> <input name=\"email\" required=\"true\" id=\"email\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"rating\">Rating</label><select name=\"rating\" style=\"multiple\" required=\"true\" type=\"select\" id=\"rating\" class=\"form-control\"><option value=\"1\">Bad</option><option value=\"3\">Good</option><option value=\"4\">Better</option><option value=\"5\">Best</option></select></div><div class=\"form-group\"><label for=\"feedback\">Feedback</label><textarea name=\"feedback\" required=\"true\" type=\"rich-text\" id=\"feedback\" class=\"form-control\"></textarea></div><input class=\"btn waves-effect waves-light\" value=\"Submit\" type=\"submit\"></form>'),
                        (2, 'Default (with image)', '<form style=\"padding: 20px\" class=\"z-depth-1\" id=\"rendered-form\" method=\"post\" action=\"action.php\"><div class=\"form-group\"><label for=\"name\">Name</label> <input name=\"name\" required=\"true\" id=\"name\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"position\">Positiion</label> <input name=\"position\" required=\"false\" id=\"position\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"companyname\">Company Name</label> <input name=\"companyname\" required=\"false\" id=\"companyname\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"companywebsite\">Company Website</label> <input name=\"companywebsite\" required=\"false\" id=\"companywebsite\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"email\">Email</label> <input name=\"email\" required=\"true\" id=\"email\" class=\"form-control\" type=\"text\"></div>\n<div class=\"form-group\"><label for=\"image\">Your Image link</label> <input name=\"image\" id=\"image\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"rating\">Rating</label><select name=\"rating\" style=\"multiple\" required=\"true\" type=\"select\" id=\"rating\" class=\"form-control\"><option value=\"1\">Bad</option><option value=\"3\">Good</option><option value=\"4\">Better</option><option value=\"5\">Best</option></select></div><div class=\"form-group\"><label for=\"feedback\">Feedback</label><textarea name=\"feedback\" required=\"true\" type=\"rich-text\" id=\"feedback\" class=\"form-control\"></textarea></div><input class=\"btn waves-effect waves-light\" value=\"Submit\" type=\"submit\"></form>'),
                        (3, 'Basic', '<form style=\"padding: 20px\" class=\"z-depth-1\" id=\"rendered-form\" method=\"post\" action=\"action.php\"><div class=\"form-group\"><label for=\"name\">Name</label> <input name=\"name\" required=\"true\" id=\"name\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"email\">Email</label> <input name=\"email\" required=\"true\" id=\"email\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"feedback\">Feedback</label><textarea name=\"feedback\" required=\"true\" type=\"rich-text\" id=\"feedback\" class=\"form-control\"></textarea></div><input class=\"btn waves-effect waves-light\" value=\"Submit\" type=\"submit\"></form>'),
                        (4, 'Basic (with image)', '<form style=\"padding: 20px\" class=\"z-depth-1\" id=\"rendered-form\" method=\"post\" action=\"action.php\"><div class=\"form-group\"><label for=\"name\">Name</label> <input name=\"name\" required=\"true\" id=\"name\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"email\">Email</label> <input name=\"email\" required=\"true\" id=\"email\" class=\"form-control\" type=\"text\"></div>\n<div class=\"form-group\"><label for=\"image\">Your Image Link</label> <input name=\"image\"  id=\"image\" class=\"form-control\" type=\"text\"></div>\n<div class=\"form-group\"><label for=\"feedback\">Feedback</label><textarea name=\"feedback\" required=\"true\" type=\"rich-text\" id=\"feedback\" class=\"form-control\"></textarea></div><input class=\"btn waves-effect waves-light\" value=\"Submit\" type=\"submit\"></form>'),
                        (12, 'Basic (with rating)', '<form style=\"padding: 20px\" class=\"z-depth-1\" id=\"rendered-form\" method=\"post\" action=\"action.php\"><div class=\"form-group\"><label for=\"name\">Name</label> <input name=\"name\" required=\"true\" id=\"name\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"email\">Email</label> <input name=\"email\" required=\"true\" id=\"email\" class=\"form-control\" type=\"text\"></div><div class=\"form-group\"><label for=\"rating\">Rating</label><select name=\"rating\" style=\"multiple\" required=\"true\" type=\"select\" id=\"rating\" class=\"form-control\"><option value=\"1\">Bad</option><option value=\"3\">Good</option><option value=\"4\">Better</option><option value=\"5\">Best</option></select></div><div class=\"form-group\"><label for=\"feedback\">Feedback</label><textarea name=\"feedback\" required=\"true\" type=\"rich-text\" id=\"feedback\" class=\"form-control\"></textarea></div><input class=\"btn waves-effect waves-light\" value=\"Submit\" type=\"submit\"></form>');

                        CREATE TABLE IF NOT EXISTS `settings` (
                          `id` int(3) NOT NULL,
                          `field` text NOT NULL,
                          `value` text NOT NULL
                        ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

                        INSERT INTO `settings` (`id`, `field`, `value`) VALUES
                        (1, 'form', 'Basic'),
                        (2, 'style', 'Carousel'),
                        (3, 'email', ''),
                        (4, 'domain', ''),
                        (5, 'api', ''),
                        (6, 'mail_notify', 'disable'),
                        (7, 'sEmail', 'disable'),
                        (8, 'sPosition', 'disable'),
                        (9, 'sCompanyName', 'disable'),
                        (10, 'sCompanyWebsite', 'disable'),
                        (11, 'sImage', 'enable');

                        CREATE TABLE IF NOT EXISTS `user` (
                          `id` int(3) NOT NULL,
                          `username` varchar(10) NOT NULL,
                          `password` varchar(50) NOT NULL,
                          `email` varchar(50) NOT NULL,
                          `name` varchar(50) NOT NULL
                        ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


                        INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`) VALUES
                        (1, 'admin', 'admin', 'admin@example.com', 'Super Admin');


                        ALTER TABLE `data`
                          ADD PRIMARY KEY (`id`);

                        ALTER TABLE `form`
                          ADD PRIMARY KEY (`id`);

                        ALTER TABLE `settings`
                          ADD PRIMARY KEY (`id`);

                        ALTER TABLE `user`
                          ADD PRIMARY KEY (`id`);

                        ALTER TABLE `data`
                          MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;

                        ALTER TABLE `form`
                          MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;

                        ALTER TABLE `settings`
                          MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;

                        ALTER TABLE `user`
                          MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
                         ");
                                            } else {
                                                echo '<p class="mdi-alert-error red-text">Couldn\'t connect to the database :(</p>';
                                            }
                                            $config = "<?php
              (!defined('HOST')) ? define('HOST', '" . $host . "') : NULL;
              (!defined('USER')) ? define('USER', '" . $username . "') : NULL;
              (!defined('PASS')) ? define('PASS', '" . $password . "') : NULL;
              (!defined('DB')) ? define('DB', '" . $dbname . "') : NULL;
            ";

                                            $myFile = fopen("../class/config/index.php",
                                                "w") or die("<p class='mdi-alert-error red-text'> Unable to create config file .Permission forbidden. Please make a new index.php file manually with the following code in admin/class/config directory:</p><div class='row'><div class='input-field col s12'><textarea class='materialize-textarea' id='code' rows='7'>$config</textarea><label for='code'>Installation Code</label></div></div>");
                                            $action = fwrite($myFile, $config);
                                            if ($action) {
                                                echo "<script>Materialize.toast('Royal testimonial has been installed successfully :) ', 2000)</script>";
                                                echo '<p class="mdi-action-info green-text"> Please, wait while we\'re redirecting you to the administration panel...</p>';
                                                echo "<meta http-equiv=\"refresh\" content=\"3; url=install.php\" />";
                                            }
                                        } catch (PDOException $e) {
                                            echo "<script>$(document).ready(function() { Materialize.toast('Something went wrong . Make sure you have entered all information correctly!', 4000) });</script>";
                                        }
                                    }
                                }
                                ?>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>