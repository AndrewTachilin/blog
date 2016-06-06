<?php
    require "header.php";
    require "functions.php";
error_reporting( E_ERROR );
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
                        <input type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Picture (optional)</label>
                        <input type="file" class="form-control" name="file" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit2" class="btn btn-primary form-control" />

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<?php



    require "footer.php";

?>