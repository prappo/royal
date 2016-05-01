<?php
error_reporting(0);

$feedback = new Feedback();

// Select a form
if (isset($_POST['changeTable'])) {
    if (isset($_POST['formName'])) {
        $form = $_POST['formName'];
    } else {
        $status = "<script>$(document).ready(function() { Materialize.toast('Please, select a form change.', 4000) });</script>";
    }

    try {
        $feedback->update("settings", "value", $form, "field", "form");

        $status = "<script>$(document).ready(function() { Materialize.toast('Your form has been changed successfully.', 4000) });</script>";

    } catch (PDOException $d) {
        $status = "<script>$(document).ready(function() { Materialize.toast('Something is wrong. Please, try again later!', 4000) });</script>";
    }
}

// Select a form style
if ($_POST['style'] == 'Basic') {
    $basic = 'selected';
} elseif ($_POST['style'] == 'Grid') {
    $grid = 'selected';
} elseif ($_POST['style'] == 'Carousel') {
    $carousel = 'selected';
} elseif ($feedback->settings('style') == 'Basic') {
    $basic = 'selected';
} elseif ($feedback->settings('style') == 'Grid') {
    $grid = "selected";
} elseif ($feedback->settings('style') == 'Carousel') {
    $carousel = 'selected';
} else {
    $basic = '';
    $grid = '';
    $carousel = '';
}

if (isset($_POST['updateStyle'])) {
    try {
        $feedback->update('settings', 'value', $_POST['style'], 'field', 'style');

        $status = "<script>$(document).ready(function() { Materialize.toast('Your form style has been changed successfully.', 4000) });</script>";

    } catch (PDOException $e) {
        $status = "<script>$(document).ready(function() { Materialize.toast('Something is wrong. Please, try again later!', 4000) });</script>";
    }
}

// MailGun Settings
if (isset($_POST['mail'])) {
    $email = $_POST['email'];
    $domain = $_POST['domain'];
    $api = $_POST['secretApiKey'];

    if (empty($email)) {
        $status = "<script>$(document).ready(function() { Materialize.toast('Please, enter your from Email.', 4000) });</script>";

    } elseif (empty($domain)) {
        $status = "<script>$(document).ready(function() { Materialize.toast('Please, enter your MailGun Domain.', 4000) });</script>";

    } elseif (empty($api)) {
        $status = "<script>$(document).ready(function() { Materialize.toast('Please, enter your MailGun API Key.', 4000) });</script>";

    } else {
        try {
            $feedback->update('settings', 'value', $email, 'field', 'email');
            $feedback->update('settings', 'value', $domain, 'field', 'domain');
            $feedback->update('settings', 'value', $api, 'field', 'api');

            $status = "<script>$(document).ready(function() { Materialize.toast('MailGun service has been enabled successfully.', 4000) });</script>";
        } catch (PDOException $e) {
            $status = "<script>$(document).ready(function() { Materialize.toast('MailGun service could not be enabled.', 4000) });</script>";

        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Settings | Royal Testimonial</title>

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
<body id="settings">

<header>
    <nav class="top-nav">
        <div class="container">
            <div class="nav-wrapper">
                <a class="page-title">Settings</a>
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
        <li class="bold">
            <a href="build.php">Builder</a>
        </li>

        <li class="bold active">
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

            <!--Select a form-->
            <form id="changeForm" class="col s12" method="post">
                <div class="progress">
                    <div class="indeterminate"></div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <h5 class="card-title grey-text text-darken-4">Select a Form Style</h5>

                        <select name="formName" id="formName">
                            <?php
                            $feedback->select('form');
                            $data = $feedback->table;
                            $selected = '';

                            foreach ($data as $item) {
                                if ($item['name'] == $feedback->settings('form')) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }

                                echo '<option value="' . $item['name'] . '" ' . $selected . '>' . $item['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="many-buttons">
                    <button type="submit" class="waves-effect waves-light btn" name="changeTable">Change</button>
                    <button type="button" id="viewForm" class="waves-effect waves-light btn blue">View</button>
                    <button type="button" id="delete" class="waves-effect waves-light btn red">Delete</button>
                    <button type="button" id="getFormCode" class="waves-effect waves-light btn orange">Get Code</button>
                </div>
            </form>
        </div>

        <!--View select a form modal-->
        <div id="formModal" class="modal modal-fixed-footer">
            <div class="modal-content"></div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>

        <!--Get select a form code modal-->
        <div id="formCodeModal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <input type="hidden" id="formUrl"
                           value="<?= str_replace("admin/settings", "form.php", getUrl()); ?>">
                    <div class="input-field col s4">
                        <input type="text" id="formWidth" placeholder="iFrame width in pixel or percentage">
                        <label for="width">Width</label>
                    </div>
                    <div class="input-field col s4">
                        <input type="text" id="formHeight" placeholder="iFrame height in pixel">
                        <label for="height">Height</label>
                    </div>
                    <div class="input-field col s4">
                        <button type="button" id="formCodeDone" class="waves-effect waves-light btn">Change</button>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="iFrame" id="formCode" class="materialize-textarea" cols="30"
                                  rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>

        <!--Select testimonial style-->
        <div class="row">
            <form id="changeFormStyle" class="col s12" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <h5 class="card-title grey-text text-darken-4">Select a Testimonial Style</h5>

                        <select name="style" id="style">
                            <option value="Basic" <?= $basic ?>>Basic</option>
                            <option value="Grid" <?= $grid ?>>Grid</option>
                            <option value="Carousel" <?= $carousel ?>>Carousel</option>
                        </select>
                    </div>
                </div>
                <div class="many-buttons">
                    <button type="submit" class="waves-effect waves-light btn" name="updateStyle">Save</button>
                    <a href="../testimonial.php" target="_blank" class="waves-effect waves-light btn blue">View</a>
                    <button type="button" id="getCode" class="waves-effect waves-light btn red">Get Code</button>
                </div>
            </form>
        </div>

        <!--Get Code Modal-->
        <div id="codeModal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <input type="hidden" id="testimonialURL"
                           value="<?= str_replace("admin/settings", "testimonial.php", getUrl()); ?>">
                    <div class="input-field col s4">
                        <input type="text" id="width" placeholder="iFrame width in pixel or percentage">
                        <label for="width">Width</label>
                    </div>
                    <div class="input-field col s4">
                        <input type="text" id="height" placeholder="iFrame height in pixel">
                        <label for="height">Height</label>
                    </div>
                    <div class="input-field col s4">
                        <button type="button" id="codeDone" class="waves-effect waves-light btn">Change</button>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="iFrame" id="code" class="materialize-textarea" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>

        <div class="row">
            <div class="col s12 switch">
                <h5 class="card-title grey-text text-darken-4">Image Field</h5>
                <label>
                    Off
                    <input type="checkbox"
                           id="isImage" <?php if ($feedback->settings('sImage') == 'enable') echo 'checked' ?>>
                    <span class="lever"></span>
                    On
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 switch">
                <h5 class="card-title grey-text text-darken-4">Email Field</h5>
                <label>
                    Off
                    <input type="checkbox"
                           id="isEmail" <?php if ($feedback->settings('sEmail') == 'enable') echo 'checked' ?>>
                    <span class="lever"></span>
                    On
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 switch">
                <h5 class="card-title grey-text text-darken-4">Position Field</h5>
                <label>
                    Off
                    <input type="checkbox"
                           id="isPosition" <?php if ($feedback->settings('sPosition') == 'enable') echo 'checked' ?>>
                    <span class="lever"></span>
                    On
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 switch">
                <h5 class="card-title grey-text text-darken-4">Company Field</h5>
                <label>
                    Off
                    <input type="checkbox"
                           id="isCompany" <?php if ($feedback->settings('sCompanyName') == 'enable') echo 'checked' ?>>
                    <span class="lever"></span>
                    On
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 switch">
                <h5 class="card-title grey-text text-darken-4">Website Field</h5>
                <label>
                    Off
                    <input type="checkbox"
                           id="isWebsite" <?php if ($feedback->settings('sCompanyWebsite') == 'enable') echo 'checked' ?>>
                    <span class="lever"></span>
                    On
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 switch">
                <h5 class="card-title grey-text text-darken-4">MailGun Service</h5>
                <label>
                    Off
                    <input type="checkbox"
                           id="mailNotify" <?php if ($feedback->settings('mail_notify') == 'enable') echo 'checked' ?>>
                    <span class="lever"></span>
                    On
                </label>
            </div>
        </div>

        <div class="row">
            <form id="MailGun" class="col s12" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <h5 class="card-title grey-text text-darken-4">MailGun Settings</h5>
                    </div>
                    <div class="input-field col s12">
                        <input type="email" id="email" name="email"
                               value="<?= count($feedback->settings('email')) ? $feedback->settings('email') : ''; ?>">
                        <label for="email">Email Address</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" id="domain" name="domain"
                               value="<?= count($feedback->settings('domain')) ? $feedback->settings('domain') : ''; ?>">
                        <label for="domain">MailGun Domain</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" id="secretApiKey" name="secretApiKey"
                               value="<?= count($feedback->settings('api')) ? $feedback->settings('api') : ''; ?>">
                        <label for="secretApiKey">Secret API Key</label>
                    </div>

                    <div class="input-field col s12">
                        <button type="submit" class="waves-effect waves-light btn"
                                name="mail" <?= ($feedback->settings('mail_notify') == 'enable') ? '' : 'disabled'; ?>>
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="asset/js/jquery-2.1.1.min.js"></script>
<script src="asset/js/materialize.min.js"></script>
<script src="asset/js/royal.js"></script>
<?= isset($status) ? $status : '' ?>
</body>
</html>

