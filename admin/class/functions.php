<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;

function auth()
{
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login.php');
    }
}

function sendMail($from, $to, $subject, $text)
{
    $fd = new Feedback();
    $api = $fd->settings("api");
    $meamil = $fd->settings("email");
    $mdomain = $fd->settings("domain");
    $mg = new Mailgun($api);
    $domain = $mdomain;

    # Now, compose and send your message.
    $mg->sendMessage($domain, array(
        'from' => $from,
        'to' => $to,
        'subject' => $subject,
        'html' => $text,
    ));
}

function getUrl()
{
    return $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}