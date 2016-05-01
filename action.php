<?php
error_reporting(0);

foreach (glob('admin/class/*.php') as $class) {
    include_once $class;
}

$feedback = new Feedback();

$i = 1;
$myData = '';
$count = 0;
$comma;

foreach ($_POST as $f => $d) {
    $count++;
}

foreach ($_POST as $field => $data) {
    if ($count > $i) {
        $comma = ',';
    } else {
        $comma = ' ';
    }
    $myData .= '"' . $field . '"' . ":" . '"' . $data . '"' . $comma;

    $i++;

    if ($field == 'email') {
        if ($feedback->settings('mail_notify') == 'enable') {

            try {
                $feedback->select('user');

                foreach ($feedback->table as $d) {
                    $name = $d['name'];
                }

                $url_raw = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $url = str_replace("action.php", "admin/testimonials", $url_raw);
                $msg = "Hi " . $name . ",<br>" . "Please review the testimonial to <a href='http://" . $url . "'>approve</a> or <a href='http://" . $url . "'>remove</a> .";
                sendMail($data, $feedback->settings("email"), "You have received a new testimonial ", $msg);

            } catch (\Guzzle\Http\Exception\BadResponseException $e) {

                echo "Something went wrong <br>";
                echo $e->getMessage();
            }
        }

    }
}
$finalData = "{" . $myData . "}";

$query = "INSERT INTO data(value, status)VALUES(:finalData, 'pending')";
try{
$q = $feedback->con->prepare($query);
$q->execute(array(':finalData'=> $finalData));

echo 'success';
}catch(PDOException $e){
   echo 'false';
}
