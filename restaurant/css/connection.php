<?php

$user = 'root';
$pass='';
$db = "marcelo";

$db =new mysqli('localhost', $user,$pass,$db) or die("Unable to connect");

echo "Hello";
?>
