<?php error_reporting(0);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Royal Testimonial</title>
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


    <link rel="stylesheet" href="asset/css/materialize.min.css" media="screen,projection">
    <link rel="stylesheet" href="asset/css/style.css" media="screen,projection">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="dashboard">

<header>
    <nav class="top-nav">
        <div class="container">
            <div class="nav-wrapper">
                <a class="page-title">Profile</a>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="profile.php">Hi, <?php echo $_SESSION['username']; ?> </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="cotainer">
        <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only">
            <i class="mdi-navigation-menu"></i>
        </a>
    </div>

    <ul id="nav-mobile" class="side-nav fixed">
        <li class="logo">
            <a href="">
                <h1>Royal</h1>
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
        <li class="bold">
            <a href="testimonials">Testimonials</a>
        </li>

        <li class="active bold">
            <a href="profile.php">Profile</a>
        </li>

        <li class="bold">
            <a href="logout.php">Logout</a>
        </li>


    </ul>
</header>

<main>
    <div class="container">

        <?php
        $feedback= new Feedback();
        $feedback->select("user");
        foreach ($feedback->table as $data) {
            $user = $data['username'];
            $pass = $data['password'];
            $email = $data['email'];
            $name = $data['name'];
        }
        ?>
        <br>
        <div class="col s12 m2">
            <form method="post" style="padding:20px" class="z-depth-1">
                <h5>Update Your information</h5><br>
                <label>Name</label><br>
                <input type="text" name="name" value="<?php echo $name ?>"><br>
                <label>Username</label><br>
                <input type="text" name="user" value="<?php echo $user ?>"><br>
                <label>Email</label><br>
                <input type="text" name="email" value="<?php echo $email ?>"><br>
                <label>Password</label><br>
                <input type="password" name="pass" value="<?php echo $pass ?>"><br>
                <input class="btn waves-effect waves-light" type="submit" name="updateUser" value="Submit">
            </form>
            <br><br>

            <?php
            if (isset($_POST['updateUser'])) {
                $f_name = $_POST['name'];
                $f_user = $_POST['user'];
                $f_email = $_POST['email'];
                $f_pass = $_POST['pass'];
                if (empty($f_name)) {
                    echo "Name field can't be empty<br>";
                } elseif (empty($f_user)) {
                    echo "Username field can't be empty<br>";
                } elseif (empty($f_pass)) {
                    echo "Password field can't be empty<br>";
                } elseif (empty($f_email)) {
                    echo "Email field can't be empty<br>";
                } else {
                    try {
                        $feedback->update("user", "name", $f_name, "username", $_SESSION['username']);
                        $feedback->update("user", "username", $f_user, "username", $_SESSION['username']);
                        $feedback->update("user", "password", $f_pass, "username", $_SESSION['username']);
                        $feedback->update("user", "email", $f_email, "username", $_SESSION['username']);
                        echo "<script>done('User information updated');</script>";
                        echo "<META http-equiv=\"refresh\" content=\"1;URL=profile.php\"> ";
                    } catch (PDOException $e) {
                        echo "Something went wrong";
                    }
                }

            }

            ?>


        </div>

        <br><br>

    </div>
</main>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="asset/js/materialize.min.js"></script>
<script src="asset/js/royal.js"></script>
</body>
</html>