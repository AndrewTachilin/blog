<?php
session_start();

require_once('database.php');
require_once('header.php');

$id = $_SESSION['one'];

$dbh = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
$sql = "SELECT post_id,post,title,tag from activity WHERE `post_id`='$id'";
$sth = $dbh->prepare($sql);

$row = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach ($dbh->query($sql) as $post) {
?>
<table class="table table-bordered table-striped">
    <thead>


    <a href="onepost.php<?php echo '?editpost=' . $post['post_id'] ?>">edit post</a>
    <br/>
    <a href="onepost.php<?php echo '?edittag=' . $post['post_id'] ?>">edit tag</a>
    <tr>
        <th>id</th>
        <th>titile <a href="?edit=title"></a></th>
        <th>post <a href="?edit=post"></a></th>
        <th>tag</th>

    </tr>
    j
    </thead>
    <tbody>
    <tr>
        <td>
            <p><?php echo $post['post_id']; ?></p>
        </td>
        <td>
            <p><?php echo $post['title'] ?></p>
        </td>
        <td>
            <p><?php if (isset($_GET['editpost'])){
                ?>
            <form method="get">
                <input type="text" value="<?php echo $post['post'] ?>" name="editpost">
                <input type="submit" value="edit" name="submitedit">
            </form>
            <?php
            if (!empty($_GET['editpost']) && isset($_GET['submitedit'])) {

                if (!empty($_GET['editpost']) && isset($_GET['submitedit'])) {
                    $post = $_GET['editpost'];
                    $sql = "UPDATE activity SET `post`='$post' where post_id='$id'";
                    $sth = $dbh->prepare($sql);
                    $dbh->query($sql);
                    $sth->execute();
                }
            }
            } else {
                echo $post['post'];
            } ?>

        </td>
        <td>
            <?php if (isset($_GET['edittag'])) {
                $sql = "SELECT text from tag LEFT JOIN post_to_tag on id_tag=tag_id where post_id=3";
                $dbh->prepare($sql);
                $sth = $dbh->query($sql);
                $tags['text'] = $sth->fetchAll(PDO::FETCH_ASSOC);

                foreach ($dbh->query($sql) as $t) {


                }

                ?>
                <form method="get">
                    <input type="text" value="" name="edittag">
                    <input type="submit" value="edit" name="submittag">
                </form>

                <?php
//                if (!empty($_GET['edittag']) && isset($_GET['submittag'])) {
//                    $editexp = explode(' ', $_GET['edittag']);
//
//                    foreach ($editexp as $tagsedit) {
//
//                        $dbh->query("select text from tag where text = '$tagsedit'");
//                        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
//                        if (isset($result)) {
//                            print_r($result);
//                            $inserttag = $result[0]['id'];
//                            $select_id = $dbh->query("SELECT * FROM post_to_tag WHERE tag_id='$inserttag' and post_id = '$id'");
//                            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
//                            $inserttags = $dbh->query("INSERT INTO post_to_tag SET post_to_tag.post_id = '$id', post_to_tag.tag_id = '$inserttag'");
//
//                        } else {
//                            $inserttags = $dbh->query("INSERT INTO tag SET title ='$tagsedit'");
//                            $edit = $dbh->lastInsertId();
//                            $insert_edit = $dbh->query("INSERT INTO post_to_tag SET post_id ='{$id}',tag_id='{$edit}'");
//                        }
//                        if (!$insert_edit_tag) {
//                            echo "PDO::errorInfo():";
//                            print_r($dbh->errorInfo());
//                            echo("<body><div><h3>Please enter the correct data!</div></body>");
//                        }
//                    }
//                }




















//
//                        $t = $_GET['edittag'];
//                        $sql="select text from tag where text = '$t'";
//                        $dbh->prepare($sql);
//                        $sth = $dbh->query($sql);
//                        $d = $sth->fetchAll(PDO::FETCH_ASSOC);
//                        $gettag = $_GET['edittag'];
//
//                       $exploade = explode(' ',$gettag);
//
//
//
//
//
//                        foreach ($tags['text'] as $tag['text']){
//                         foreach ($tag['text'] as $text){
//                         }
//                           foreach ($exploade as $equal) {
//                               if ($equal==$text) {
//                                   echo 'ok';
////                                   $sql ="INSERT INTO tag (text) values ()";
//                                   break;
//
//                               }else{
////                                   $sql = "INSERT INTO tag (text) values ()";
//                                   echo '+okd+' ;
//                               }
//                           }
//                        }
//
//                        if (!empty($_GET['editpost']) && isset($_GET['submitedit'])) {
//                            $post = $_GET['editpost'];
//                            $sql = "UPDATE activity SET `post`='$post' where post_id='$id'";
//                            $sth = $dbh->prepare($sql);
//                            $dbh->query($sql);
//                            $sth->execute();
//                        }
//                    }
//                } else {
//
                } ?>
            </td>
        </tr>
        </td>
        </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-striped">
        <tr>
            <th>comments</th>
        </tr>
    </table>
    <?php
}
$sql = "SELECT id,text,parent_id from comments WHERE `post_id`='$id'";
$sth = $dbh->prepare($sql);
$row = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach ($dbh->query($sql) as $row){

 ?>
    <table class="table table-bordered table-striped">
        <tr>
            <th>text</th>
        </tr>
        <tbody>
        <tr>
           <td>
               <a href="<?php  echo '?edit='.$row['id'] ?>">Edit</a>
               <a href="<?php  echo '?del='.$row['id'] ?>">Del</a>
                <p><?php echo $row['text'] ?></p>

               <a href="<?php  echo '?answer='.$row['id'] ; echo 'id=".$parent_id."' ?>">answer</a>
               <a id="<?php  echo  $row['parent_id']?>"></a>

               <a href="#<?php echo $row['parent_id']?>">anhor</a>
            </td>
        </tr>
        </td>

        </tr>
        </tbody>
    </table>

<?php
}
if(isset($_GET['del'])){

    $get_delete = $_GET['del'];
    $sth->bindParam(':delete',$_GET['del']);
    $del =$_GET['del'];
 $sql = "DELETE FROM comments WHERE id=$del";
 $sth = $dbh->prepare($sql);
$dbh->query($sql);
$sth->execute();

}
if(isset($_GET['answer'])) {
    $_SESSION['answer'] = $_GET['answer'];
}
    if(isset($_GET['comment']) && isset($_GET['submit'])){
        $text = $_GET['comment'];
        $id = $_SESSION['one'];

        $parent_id =  $_SESSION['answer'];
        $sth->execute(array(
            ':text'=>$text,
            ':post_id'=>$id,
            ':parent_id'=>$parent_id
        ));
        $sql=("INSERT INTO comments (text,post_id,parent_id) values ('$text','$id','$parent_id')");
        $sth = $dbh->prepare($sql);
        $dbh->query($sql);

$_SESSION['answer']=null;
}

if(isset($_GET['edit'])){
        $editId = $_GET['edit'];
        $sql = ("SELECT text from comments where id =$editId");

    foreach ($dbh->query($sql) as $row){
        }

?>



    <?php

    if(isset($_POST['editcomment']) && isset($_POST['submitedit'])){
        $newtext = $_POST['editcomment'];
        $sqlupdate = "UPDATE comments SET `text`='$newtext' where id='$editId'";
        $sth = $dbh->prepare($sqlupdate);
        $dbh->query($sqlupdate);
        $sth->execute();
    }
    ?>
    <form method="post">
        <input type="hidden" value="">
        <input type="text" class="form-control" value="<?php echo $row['text']?>" name="editcomment">
        <input type="submit" value="send" name="submitedit" class="btn btn-primary form-control">
    </form>
    <?php


}else{
    ?>
    <form method="get">
        <input type="hidden" value="">
        <input type="text" class="form-control" name="comment" placeholder="<?php echo 'answer on comment:'. $_GET['answer']  ?>">
        <input type="submit" value="send" name="submit" class="btn btn-primary form-control">
    </form>


    <?php
}


?>

