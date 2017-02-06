<?php
require 'database.php';
require 'header.php';

session_start();
ob_start();
$dbh = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
$sql2 = ("SELECT * FROM activity");
$sth = $dbh->prepare($sql2);
$sth->execute();
$posts1 = $sth->fetchAll(PDO::FETCH_ASSOC);
$sql3 = ("SELECT post_id FROM coments LEFT JOIN activity ON coments.post_id=activity.post_id");

?>

    <h2>List of posts</h2>
<?php


for ($i = 0; $i <= count($posts1); $i++) {
    ?>
    <p><?php
    $sql4 = ("SELECT comments from activity where post_id='$i'");
    $sth = $dbh->prepare($sql4);
    $sth->execute();
    $comments = $sth->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['count'] = count($comments);
    if (!function_exists('comments')) {
        function comments($comments)
        {
            foreach ($comments as $comment) {
                var_dump($comment);
                die();
            }
            ?>
            <div style="margin-left: 20px">
                <div id="<?= $comment['id'] ?>"
            </div>
            <div><?= $comment['comments']; ?></div>
            <a href="#<?= $comment['parent_id'] ?>"></a>

            <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>title</th>
                <th>post</th>
                <th>tag</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <a href="onepost.php?id=<?= $comment['post_id'] ?>&comment=<?= $comment['id'] ?>#answer"><?php print_r($comment['title']) ?></a>
                </td>
                <td>
                    <a href="onepost.php?id=<?= $comment['post_id'] ?>&comment_delete=<?= $comment['id'] ?>"><?php print_r($comment['post']) ?></a>
                </td>
                <td>
                    <a href="onepost.php?id=<?= $comment['post_id'] ?>&edit_comment=<?= $comment['id'] ?>#edit"><?php print_r($comment['tag']) ?></a>
                </td>
            </tr>  <tr>
                <td>
                    <a href="onepost.php?id=<?= $comment['post_id'] ?>&comment=<?= $comment['id'] ?>#answer">Ответить</a>
                </td>
                <td>
                    <a href="onepost.php?id=<?= $comment['post_id'] ?>&comment_delete=<?= $comment['id'] ?>">Удалить</a>
                </td>
                <td>
                    <a href="onepost.php?id=<?= $comment['post_id'] ?>&edit_comment=<?= $comment['id'] ?>#edit">Редактировать</a>
                </td>
            </tr>
            </tbody>
            <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Comments</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><p>
            <tbody>
            <tr>
            <td>

            <form method="get">
                <input type="text" name="childComment">
                <input type="submit" value="answer" name="<?php echo $i ?>">
            </form>
            <?php
        }
    }

    comments($comments);
    ?></p>
    <p></p>

    </td>
</tr>
    </tbody>
    <tr></tr>
    <form method="get">
        <input type="text" class="form-control" name="comment" placeholder="leave your comment here">
        <input type="submit" value="comment" name="<?php echo $i ?>" class="btn btn-primary form-control">
    </form>
    <?php


    $comment = $_GET['comment'];
    $idcomment = $_GET["$i"];

    if (isset($_GET["$i"]) && !empty($_GET["$i"])) {
        $sth->bindParam(':comment', $comment);
        $sth->bindParam(':id', $i);
        $sth->execute(array(
            ':comment' => $comment,
            ':id' => $idcomment

        ));
        $sql = ("INSERT INTO coments (comments,post_id) VALUE ('$comment','$i')");
        $dbh->query($sql);


    }
}
//


ob_end_flush();