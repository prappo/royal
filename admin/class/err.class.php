<?php
register_shutdown_function('shutDownFunction');
function shutDownFunction()
{
    $error = error_get_last();
    // fatal error, E_ERROR === 1
    if ($error['type'] === E_ERROR) {

        header('Location:404');
    }
}


