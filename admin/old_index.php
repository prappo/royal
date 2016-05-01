<?php

error_reporting(0);

foreach (glob('class/*.php') as $filename) {
    include_once $filename;
}

$page = new Route();

/*
 * Home pages . added multi route
 * index.php and home
 */
$page->add('/', 'home');
$page->add('/home', 'home');

$page->add('/login', function () { // Login page
    include 'login.php';
});

$page->add('/logout', function () { // Logout page
    session_start();
    session_destroy();
    header("location:login");
    exit;
});

// Change form
$page->add("/actionViewForm", function () {
    if (isset($_POST['formName'])) {
        $feedback = new Feedback();
        echo $feedback->showForm($_POST['formName']);
    }
});

$page->add("/settings", function () { // Settings page
    auth();
    include 'pages/settings.php';
});

$page->add("/build", function () { // Form building page
    auth();
    include 'pages/build.php';
});

$page->add('/404', function () { // 404 page
    include 'pages/404.php';
});

/*
 *
 * Testimonial page where you can check all testimonials those are submitted
 * and can approve/disapprove/delete
 * whatever you want
 *
 * */
$page->add('/testimonials', function () {
    auth();
    include 'pages/testimonials.php';
});

$page->add('/action', function () { // Testimonials configuration
    $fd = new Feedback();

    if (isset($_POST['approve'])) {
        try {
            $fd->update("data", "status", "approved", "id", $_POST['approve']);
            echo "Approved";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    } elseif (isset($_POST['disapprove'])) {
        try {
            $fd->update("data", "status", "pending", "id", $_POST['disapprove']);
            echo "Disapproved";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } elseif (isset($_POST['delete'])) {
        try {
            $fd->delete("data", "id", $_POST['delete']);
            echo "Testimonial Deleted";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


});

$page->add('/actionMailNotify', function () { // Email notification settings
    $feedback = new Feedback();

    if (isset($_POST['mailNotify'])) {
        if ($_POST['mailNotify'] == 'enable') {
            try {
                $feedback->update('settings', 'value', 'enable', 'field', 'mail_notify');

                echo 'Email notification enabled';
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        } elseif ($_POST['mailNotify']) {
            try {
                $feedback->update('settings', 'value', 'disable', 'field', 'mail_notify');

                echo 'Email notification Disabled';
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }
    }
});

// Delete form route
$page->add('/deleteForm', function () {
    if (isset($_POST['formName'])) {
        $data = $_POST['formName'];

        $feedback = new Feedback();

        $feedback->delete("form", "name", $data);
        echo "Deleted";
    }
});

$page->add('/profile', function () {
    auth();
    include 'pages/profile.php';
});

$page->add("/fieldListAction", function () {
    $feedback = new Feedback();

    if (isset($_POST['isEmail'])) {
        $feedback->update('settings', 'value', $_POST['isEmail'], 'field', 'sEmail');

        echo 'Email ' . $_POST['isEmail'];
    } elseif (isset($_POST['isPosition'])) {
        $feedback->update('settings', 'value', $_POST['isPosition'], 'field', "sPosition");

        echo 'Position ' . $_POST['sPosition'];
    } elseif (isset($_POST['isCompany'])) {
        $feedback->update('settings', 'value', $_POST['isCompany'], 'field', 'sCompanyName');

        echo 'Company ' . $_POST['isCompany'];
    } elseif (isset($_POST['isWebsite'])) {
        $feedback->update('settings', 'value', $_POST['isWebsite'], 'field', "sCompanyWebsite");

        echo 'Website ' . $_POST['sCompanyWebsite'];
    } elseif (isset($_POST['isImage'])) {
        $feedback->update('settings', 'value', $_POST['isImage'], 'field', 'sImage');

        echo 'Image ' . $_POST['isImage'];
    }
});
$page->e(); // execute all pages

/* Page Functions */
function home()
{
    auth();
    include 'pages/home.php';
}
