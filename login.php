<?php
ob_start();
session_start();

require_once 'header.php';

require 'database.php';
$username = "root";
$password = "";
$email = $_POST['email'];
$pass = $_POST['password'];
$_SESSION['email']=$email;
if(isset($_POST['submitlogin'])) {
    if (isset($email) && isset($pass) && $email != "" && $pass != "") {
        try {
            $sql = "select email, firstname,password from user";
            $dbh = new PDO('mysql:host=localhost;dbname=blog', $username, $password);
            $sth = $dbh->prepare($sql);
            $sth->execute(array(
                ':pass' => $pass,
                ':email' => $email
            ));
            $sth = $dbh->query($sql);
            $rows = $sth->fetchAll();
            foreach ($rows as $row) {
                $userlogin = $row[0];
                $userfirstname = $row[1];
                $userpassword = $row[2];
                if (($email == $userlogin) and ($pass == $userpassword)) {
                    $indexphp = 'index.php';
                    $_SESSION['login'] = true;
                    $_SESSION['email'] = $userlogin;
                    $_SESSION['name'] = $userfirstname;

                    header('Location:'.$indexphp);

                } else $error_login = "Поля не могут быть пустыми";

            }


        } catch
        (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    } else {
        echo "введите пароль или логин";
    }
}


?>

<div class="container">

    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Log in</h2>
            </div>
            <div class="panel-body">
                <form method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submitlogin" class="btn btn-primary form-control" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php
ob_end_flush();

