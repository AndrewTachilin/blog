<?php

require ('../signup.php');
require ('../login.php.php');
require ('../index.php');
require ('../function.php');

$servername = "localhost";
$username = "root";
$password = "";

try {
    $dbh = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    $sth = $dbh->prepare($_POST['query']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}