<?php

foreach (glob('class/*.php') as $filename) {
    include_once $filename;
}
auth();
include('pages/build.php');