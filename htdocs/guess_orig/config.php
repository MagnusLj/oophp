<?php
/**
 * Set the error reporting.
 */



if (session_status() !== PHP_SESSION_ACTIVE) {
     // $name = preg_replace("/[^a-z\d]/i", "", __DIR__);
     session_name("malm18");
     session_start();
     $_SESSION['name'] = "Magnus";
}



error_reporting(-1);              // Report all type of errors
ini_set("display_errors", 1);     // Display all errors

/**
 * Default exception handler.
 */
set_exception_handler(function ($e) {
    echo "<p>Anax: Uncaught exception:</p><p>Line "
        . $e->getLine()
        . " in file "
        . $e->getFile()
        . "</p><p><code>"
        . get_class($e)
        . "</code></p><p>"
        . $e->getMessage()
        . "</p><p>Code: "
        . $e->getCode()
        . "</p><pre>"
        . $e->getTraceAsString()
        . "</pre>";
});
