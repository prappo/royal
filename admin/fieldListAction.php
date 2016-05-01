<?php
foreach (glob('class/*.php') as $filename) {
    include_once $filename;
}
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