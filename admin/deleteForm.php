<?php
foreach (glob('class/*.php') as $filename) {
    include_once $filename;
}

if (isset($_POST['formName'])) {
        $data = $_POST['formName'];

        $feedback = new Feedback();

        $feedback->delete("form", "name", $data);
        echo "Deleted";
    }