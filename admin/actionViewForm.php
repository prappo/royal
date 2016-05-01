<?php
foreach (glob('class/*.php') as $filename) {
    include_once $filename;
}
if (isset($_POST['formName'])) {
        $feedback = new Feedback();
        echo $feedback->showForm($_POST['formName']);
    }