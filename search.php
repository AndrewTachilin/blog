<?php
session_start();
require_once 'header.php';
require_once 'database.php';
$search_form = "%" . $_POST['search'] . "%";
if (isset($_POST['search']) && isset($_POST['text'])) {


         $search_post_title = $dbh->query("SELECT * FROM activity WHERE title LIKE'{$search_form}'");
        $res_search = $search_post_title->fetchAll(PDO::FETCH_ASSOC);
        $search_post_text = $dbh->query("SELECT * FROM post WHERE post LIKE '{$search_form}'");
        $res_search_text = $search_post_text->fetchAll(PDO::FETCH_ASSOC);
        $search_tag = $dbh->query("SELECT * FROM tag WHERE title LIKE '{$search_form}'");
        $res_search_tag = $search_tag->fetchAll(PDO::FETCH_ASSOC);



}

?>

<div class="content clearfix">
    <div class="left_search">
        <h2>Результаты поиска:</h2>
        <h4>По названию:</h4>
        <?php for ($i = 0; $i < count($res_search); $i++): ?>
            <a href="view.php?id=<?= $res_search[$i]['post_id'] ?>">
                <h4 style="font-style: italic;"><?= $res_search[$i]['post_title'] ?></h4></a>
        <?php endfor; ?>
        <h4>По тексту:</h4>
        <?php for ($i = 0; $i < count($res_search_text); $i++): ?>
            <a href="view.php?id=<?= $res_search_text[$i]['post_id'] ?>">
                <h5><?= $res_search[$i]['post_text'] ?></h5></a>
        <?php endfor; ?>
        <h4>По тегам:</h4>
        <?php for ($i = 0; $i < count($res_search_tag); $i++): ?>
            <a href="post_tag.php?tag=<?= $res_search_tag[$i]['title']; ?>">
                <h5><?= $res_search_tag[$i]['title']; ?></h5></a>
        <?php endfor; ?>
        <a href="../index.php"><button  class="btn btn-success ago">Назад</button></a>
    </div>