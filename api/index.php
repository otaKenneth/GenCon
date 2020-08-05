<?php
include 'config/Database.php';

include 'models/Users.php';
include 'models/Contacts.php';

$database = new Database;
$db = $database->connect();

$contacts = new Contacts($db);
?>