<?php
error_reporting(0);

if (isset($_POST['htmlSubmit'])) {
    if ($_POST['name'] == "") {
        $error = 'Please, enter a form name';
    } else {
        $htmlData = $_POST['hidden'];
        $insert = new Feedback();

        if ($insert->formInsert($_POST['name'], $htmlData)) {
            $status = "<script>Materialize.toast('Your form has been created successfully.', 4000);</script>";
        } else {
            $status = "<script>Materialize.toast('Something went wrong. Please, try again later.', 4000);</script>";
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Builder | Royal Testimonial</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->
    <link rel="stylesheet" href="asset/css/materialize.min.css">

    <!--Builder Style-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css">
    <link rel="stylesheet" href="asset/css/form-builder.css">
    <link rel="stylesheet" href="asset/css/form-render.css">

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

<body id="builder">

<header>
    <nav class="top-nav">
        <div class="container">
            <div class="nav-wrapper">
                <a class="page-title">Form Builder</a>
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

        <li class="bold">
            <a href="home.php">Dashboard</a>
        </li>
        <li class="bold active">
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
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s12 buildArea">
                        <textarea name="form-builder-template" id="form-builder-template" cols="30"
                                  rows="10"></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <form class="col s12" id="rendered-form" method="post" action="action.php">
                <p class="cta">Add some fields to the Form Builder above to render here.</p>
            </form>
        </div>

        <div class="row">
            <form id="fdata" class="col s12" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="hidden" name="hidden" id="htmlData">

                        <input type="text" id="name" name="name">
                        <label for="name">Form Name</label>
                    </div>
                    <div class="input-field col s12">
                        <button type="submit" class="btn save-btn-wrap" name="htmlSubmit">Save Form</button>
                    </div>

                    <div class="input-field col s12">
                        <?= isset($error) ? '<p class="mdi-alert-error materialize-red-text"> ' . $error . ' </p>' : '' ?>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <button id="render-form-button" class="btn waves-effect waves-light">Render form</button>
        </div>
    </div>
</main>

<script src="asset/js/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="asset/js/form-builder.min.js"></script>
<script src="asset/js/form-render.min.js"></script>
<script src="asset/js/materialize.min.js"></script>
<script src="asset/js/royal.js"></script>
<script>
    jQuery(document).ready(function () {
        $('#fdata').hide();
        'use strict';
        var template = document.getElementById('form-builder-template'),
            formContainer = document.getElementById('rendered-form'),
            renderBtn = document.getElementById('render-form-button');
        $(template).formBuilder();

        $(renderBtn).click(function (e) {
            e.preventDefault();
            $(template).formRender({
                container: $(formContainer)
            });

            formContainer.innerHTML += "<button type='submit' class='btn waves-effect waves-light'>Submit</button>";
            $('#htmlData').val(formContainer.outerHTML);
            if ($('#htmlData').val().length != 176) {

                $('#fdata').show();
            }
        });
    });
</script>
<?= isset($status) ? $status : ''; ?>
</body>
</html>