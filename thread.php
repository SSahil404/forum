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
    $id = $_GET["threadid"];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $threadTitle = $row["thread_title"];
        $threadDesc = $row["thread_desc"];
    }
    ?>

    <!-- categpry container -->

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo "$threadTitle"; ?></h1>
            <p class="lead"><?php echo "$threadDesc"; ?></p>
            <hr class="my-4">
            <b>
                <p>Posted By: <span>SSahil</span></p>
            </b>
        </div>
    </div>
    <div class="container questions">
        <h1 class="py-2">Dicussions</h1>
        <!-- <?php
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
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
            <p class="display-4">There is no threads.</p>
            <hr class="my-2">
            <p class="lead">
            <b>Be the first person to start the thread!</b>
            </p>
            </div>
            </div>';
        }
        ?> -->
    </div>

    <?php include "./components/_footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>

</html>