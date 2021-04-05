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
    <?php
    $showAlert = false;
    $method = $_SERVER["REQUEST_METHOD"];
    if ($method == "POST") {
        //inserting threads into database
        $threadTitle = $_POST["threadTitle"];
        $threadTitle = str_replace("<", "&lt;", $threadTitle);
        $threadTitle = str_replace(">", "&gt;", $threadTitle);

        $threadDesc = $_POST["threadDesc"];
        $threadDesc = str_replace("<", "&lt;", $threadDesc);
        $threadDesc = str_replace(">", "&gt;", $threadDesc);

        $userid = $_POST["userid"];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) 
        VALUES ('$threadTitle', '$threadDesc', '$id', '$userid', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your thread has been added, please wait for community to respond.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
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
            <!-- <a class="btn btn-success btn-lg" href="#" role="button">Browse Topics</a> -->
        </div>
    </div>

    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "true") {
        echo '
    <div class="container mb-3">
        <h1 class="py-2">Start a Thread</h1>
        <form action="' .
            $_SERVER["REQUEST_URI"] .
            '" method="POST">
    <div class="mb-3">
        <label for="threadTitle" class="form-label">Problem Title</label>
        <input type="text" class="form-control" id="threadTitle" name="threadTitle" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">keep your title as short and crisp as possible.</div>
    </div>
    <div class="form-group">
        <label for="threadDesc">Elaborate your problem</label>
        <textarea name="threadDesc" class="form-control" id="threadDesc" rows="3"></textarea>
        <input type="hidden" name="userid" value="' .
            $_SESSION["userid"] .
            '       ">
    </div>
    <button type="submit" class="btn btn-success my-2">Submit</button>
    </form>
    </div>';
    } else {
        echo '
        <div class="container">
        <h1 class="py-2">Start a Thread</h1>
            <h4>You are not Logged In, please login to post!</h4>
        </div>';
    } ?>

    <div class="container questions mb-5">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        $id = $_GET["catid"];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        // $threadID = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            // $threadID++;
            $threadID = $row["thread_id"];
            $threadTitle = $row["thread_title"];
            $threadDesc = $row["thread_desc"];
            $threadTime = $row["timestamp"];
            $threadUserId = $row["thread_user_id"];

            $sql2 = "SELECT user_name FROM `users` WHERE user_id='$threadUserId'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $user = $row2["user_name"];

            echo '<div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/v_collection_png/512x512/shadow/user_generic_green.png"
                        width="65px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3 my-3">
                        <h5 class="mt-0 my-0">
                            <a href="thread.php?threadid=' .
                $threadID .
                '            ">' .
                $threadTitle .
                '           </a>
                        </h5>
                        ' .
                $threadDesc .
                '       
                   </div>
                   <p class="my-0">Asked By: <b>' .
                $user .
                " at " .
                $threadTime .
                '       </b></p> 
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
        ?>
    </div>



    <?php include "./components/_footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>

</html>