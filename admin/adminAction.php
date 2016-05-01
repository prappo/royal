<?php
foreach (glob('class/*.php') as $filename) {
    include_once $filename;
}
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