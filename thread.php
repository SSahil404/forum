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
        $threadComment = $row["thread_desc"];
        $threadUserId = $row["thread_user_id"];

        $sql2 = "SELECT user_name FROM `users` WHERE user_id='$threadUserId'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $user = $row2["user_name"];
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER["REQUEST_METHOD"];
    if ($method == "POST") {
        //inserting threads into database
        $comment = $_POST["comment"];
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);
        $userid = $_POST["userid"];

        $sql = "INSERT INTO `comments` (`comm_content`, `comm_thread_id`, `comm_by`, `comm_time`) 
        VALUES ('$comment', '$id', '$userid', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your comment has been added!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>

    <!-- categpry container -->

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo "$threadTitle"; ?></h1>
            <p class="lead"><?php echo "$threadComment"; ?></p>
            <hr class="my-4">
            <p>
                Posted By:
                <span>
                    <b>
                        <em><?php echo $user; ?></em>
                    </b>
                </span>
            </p>
        </div>
    </div>



    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "true") {
        echo '
        <div class="container mb-3">
            <h1 class="py-2">Post a comment</h1>
            <form action="' .
            $_SERVER["REQUEST_URI"] .
            '" method="POST">
                <div class="form-group">
                    <label for="comment">Type your Comment</label>
                    <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
                    <input type="hidden" name="userid" value="' .
            $_SESSION["userid"] .
            '       ">
                </div>
                <button type="submit" class="btn btn-success my-2">Post Comment</button>
            </form>
        </div>';
    } else {
        echo '
    <div class="container">
        <h1 class="py-2">Post a comment</h1>
        <h4>You are not Logged In, please login to post!</h4>
    </div>';
    } ?>

    <div class="container questions mb-5">
        <h1 class="py-2">Dicussions</h1>

        <?php
        $sql = "SELECT * FROM `comments` WHERE comm_thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $comment = $row["comm_content"];
            $commentTime = $row["comm_time"];
            $threadUserId = $row["comm_by"];
            $sql2 = "SELECT user_name FROM `users` WHERE user_id='$threadUserId'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $user = $row2["user_name"];

            echo '<div class="d-flex align-items-center mb-2">
                    <div class="flex-shrink-0">
                        <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/v_collection_png/512x512/shadow/user_generic_green.png" 
                        width="60px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3 my-3">   
                    <p class="my-0"><b>' .
                $user .
                " at " .
                $commentTime .
                '   </b></p>                    
                ' .
                $comment .
                '   </div>
                </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
            <p class="display-4">There is no comments.</p>
            <hr class="my-2">
            <p class="lead">
            <b>Be the first person to comment!</b>
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