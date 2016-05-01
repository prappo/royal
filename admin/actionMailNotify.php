<?php
foreach (glob('class/*.php') as $filename) {
    include_once $filename;
}
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