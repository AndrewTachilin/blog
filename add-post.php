<?php
ob_start();
session_start();
require_once "header.php";
require "database.php";
require "index.php";

if(isset($_POST['submitpost'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tag = $_POST['tag'];
    $user_id = 'select id from user WHERE email="$l"';

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=blog', $username,$password);
        $sth = $dbh->prepare('INSERT INTO activity  (User_id,title, post, tag)  
    VALUES(:user_id,:title,:content,:tag)');
        $sth->execute(array(
            ':user_id' => $idnumber,
            ':title' => $title,
            ':content' => $content,
            ':tag' => $tag
        ));

    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
    }
    header('Location:'.' index.php');
}

?>

<div class="container">

    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Add Post</h2>
            </div>
            <div class="panel-body">
                <form method="POST">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="content" rows="5"></textarea>
                    </div><div class="form-group">
                        <label>tag</label>
                        <textarea class="form-control" name ="tag" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submitpost" class="btn btn-primary form-control" />

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<?php
ob_end_flush();
?>