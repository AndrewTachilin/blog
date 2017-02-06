<?php
session_start();
ob_start();
require "header.php";
require "database.php";


?>

    <a href="<?php echo '/?sort=asc'  ?>">ASC</a>
    <a href="<?php echo '/?sort=desc'?>">Desc</a>


    <form action=""  method="post">
    <input  name="text"  type="text">
    <input type="submit" value="search" name="search">
    </form>
<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=blog', 'root','');

    if(($_GET['sort']=='asc')){

             foreach ($dbh->query('select * from activity ORDER BY post_id ASC') as $asc) {

            ?>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>post_id</th>
                    <th>titile</th>
                    <th>post</th>
                    <th>tag</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <a href="<?php echo '/?id='.$asc['post_id']  ?>"><?php echo $asc['post_id']?></a>

                    </td>
                    <td>
                        <p><?php echo $asc['title'] ?></p>
                    </td>
                    <td>
                        <p><?php echo $asc['post'] ?></p>
                    </td>
                    <td>
                        <p><?php echo $asc['tag'] ?></p>
                    </td>

                </tr>
                </tbody>
            </table>
        <?php }
    }
    elseif($_GET['sort']='desc') {

        foreach ($dbh->query('select * from activity ORDER BY post_id DESC') as $desc) {

            ?>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>titile</th>
                    <th>post</th>
                    <th>tag</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <a href="<?php echo '/?id='.$desc['post_id']  ?>"><?php echo $desc['post_id']?></a>

                    </td>
                    <td>
                        <p><?php echo $desc['title'] ?></p>
                    </td>
                    <td>
                        <p><?php echo $desc['post'] ?></p>
                    </td>
                    <td>
                        <p><?php echo $desc['tag'] ?></p>
                    </td>

                </tr>
                </tbody>
            </table>

        <?php }

    }

    if($_GET['id']!=0){
        $sth = $dbh->prepare("select * from activity WHERE id='$get'");
        $get = $_GET['id'];

        $sth->execute(array(
            ':id' => $_GET['id']
        ));
        foreach ($dbh->query("select * from activity WHERE id='$get'") as $id) {

            ?>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>titile</th>
                    <th>post</th>
                    <th>tag</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <p><?php echo $id['id']?> </p>
                    </td>
                    <td>
                        <a href="<?php print_r($id['title']) ?>"><?php print_r($id['title']) ?></a>
                    </td>
                    <td>
                        <a href="<?php echo $id['post'] ?>"><?php echo $id['post'] ?></a>
                    </td>
                    <td>
                        <a href="<?php echo $id['tag'] ?>"><?php echo $id['tag'] ?></a>
                    </td>

                </tr>
                </tbody>
                <form method="post">
                    <input type="text" name="comment">
                    <input type="submit" name="submitcomment">
                </form>
            </table>
            <?php
            if(isset($_POST['submitcomment'])){
                $comment = $_POST['comment'];
                $post_id = $id['id'];
                $dbh->query("INSERT INTO activ (comment,id_post) values('$comment','$post_id')");
                foreach ($dbh->query("select comment from activ WHERE id_post='$post_id'") as $comments) {
                    foreach ($comments as $comm){
                        echo $comm.'<br\>';
                    }
                }
            }


        }

    }
if(isset($_GET['id'])){

        $_SESSION['one'] = $_GET['id'];
    header('Location: onepost.php');


}

    if (isset($_POST['search']) && isset($_POST['text'])) {

        $search= "%" . $_POST['text'] . "%";
        $sth = $dbh->query("SELECT * FROM activity WHERE title LIKE'$search'");
        $title_text = $sth->fetchAll(PDO::FETCH_ASSOC);
        $sth = $dbh->query("SELECT * FROM activity WHERE post LIKE '$search'");
        $post_text = $sth->fetchAll(PDO::FETCH_ASSOC);
        $sth = $dbh->query("SELECT * FROM tag WHERE text LIKE '$search'");
        $tag_text = $sth->fetchAll(PDO::FETCH_ASSOC);


        ?>


        <p>title</p>
        <?php for ($i = 0; $i < count($title_text); $i++){
            echo $title_text[$i]['post_id'].' ';
            echo $title_text[$i]['title'].' ';

        } ?>
    <p>post</p>
            <?php for ($i = 0; $i < count($post_text); $i++){
            echo $post_text[$i]['post_id'].' ';
            echo $post_text[$i]['post'].' ';
        } ?>
            <p>tags</p>
            <?php for ($i = 0; $i < count($tag_text); $i++){
            echo $tag_text[$i]['text'].' ';
            echo $tag_text[$i]['id_tag'].' ';
        }?>

            <a href="../index.php">Back</button></a>

<?php

    }
}catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
}



ob_end_flush();

