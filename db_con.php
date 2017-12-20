<?php
session_start();
$DB_HOST = 'amalieovergaard.dk.mysql';
$DB_USER = 'amalieovergaard_dk_kraglund';
$DB_PASS = 'kraglund22';
$DB_NAME = 'amalieovergaard_dk_kraglund';
// $DB_PORT = '8889';
$link = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
//$link = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
if ($link->connect_error) { 
   die('Connect Error ('.$link->connect_errno.') '.$link->connect_error);
}
$link->set_charset('utf8'); 
?>