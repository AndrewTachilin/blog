<?php
session_start();
ob_start();
require "header.php";
require "database.php";





     ?>

        <div class="container">

            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Sign up</h2>


                    </div>
                    <div class="panel-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input name="firstName" type="text" class="form-control"/>
                            </div>
                           <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submitSign" class="btn btn-primary form-control"/>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
<?php

if(isset($_POST['submitSign'])){
    $indexphp = 'index.php';
    $_SESSION['email']= $_POST['email'];
    $_SESSION['name']= $_POST['firstName'];

    header('Location:'.' index.php');
    exit();

}
ob_end_flush();
?>

