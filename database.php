<?php
ob_start();
session_start();


$_SESSION['name']= $_POST['firstName'];


$l = $email;
$username = "root";
$password = "";

if(isset($_POST['submitSign'])){

    $name = $_POST['firstName'];
    $email = $_POST['email'];
    $pass= $_POST['password'];
    $_SESSION['email'] = $_POST['email'];
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=blog', $username,$password);
        $sth = $dbh->prepare('INSERT INTO USER (firstname, email, password)  
    VALUES(:name,:email,:pass)');
        $sth->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':pass' => $pass
        ));
        $dbh->query('INSERT INTO USER (firstname, email, password)  
    VALUES(:name,:email,:pass)');
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
    }
}
ob_end_flush();

