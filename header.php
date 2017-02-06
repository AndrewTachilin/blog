<?php
ob_start();
session_start();

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" href="css/bootstrap.min.css" />-->
    <script type="text/javascript" src="js/jquery-2.2.2.min.js" ></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="tags.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-simplex.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Blog</title>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--<li class="active"><a href="#">Posts <span class="sr-only">(current)</span></a></li>-->
                <!--<li><a href="#">Photos</a></li>-->
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <?php if(isset($_SESSION['login']) || isset($_SESSION['email'])) { ?>


                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php echo 'Дратуте '.  $_SESSION['name']; ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="add-post.php">Add post</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php } else { ?>

                    <li><a href="login.php">Log in</a></li>
                    <li><a href="signup.php">Sign up</a></li>

                <?php }

                ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php
ob_end_flush();