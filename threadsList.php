<?php
include "./components/_dbConnect.php"; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Welcome to iDiscuss - coding forums</title>
</head>

<body>
    <?php include "./components/_nav.php"; ?>
    <?php
    $id = $_GET["catid"];
    $sql = "SELECT * FROM `categories` WHERE cat_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catName = $row["cat_name"];
        $catDesc = $row["cat_desc"];
    }
    ?>

    <!-- categpry container -->

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo "$catName"; ?> Forums</h1>
            <p class="lead"><?php echo "$catDesc"; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum</p>
            <p>Mantain Some Rules - </p>
            <ul>
                <li> No Spam / Advertising / Self-promote in the forums.</li>
                <li>Do not post copyright-infringing material.</li>
                <li>Do not post “offensive” posts, links or images..</li>
                <li>Do not cross post questions.</li>
                <li>Remain respectful of other members at all times.</li>
            </ul>
            <a class="btn btn-success btn-lg" href="#" role="button">Browse Topics</a>
        </div>
    </div>
    <div class="container">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        $id = $_GET["catid"];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $threadTitle = $row["thread_id"];
            $threadTitle = $row["thread_title"];
            $threadDesc = $row["thread_desc"];

            echo '<div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="https://www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png" width="65px"
                            alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3 my-3">
                        <h5 class="mt-0">
                            <a href="thread.php">' .
                $threadTitle .
                '           </a>
                        </h5>
                        ' .
                $threadDesc .
                '   </div>
                </div>';
        }
        ?>
    </div>

    <?php include "./components/_footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>

</html>