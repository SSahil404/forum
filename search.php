<?php include "./components/_dbConnect.php"; ?>

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





    <!-- Search results -->
    <div class="container search my-3">
        <h1>Search result for <em>"<?php echo $_GET["search"]; ?>"</em></h1>

        <?php
        $search = $_GET["search"];

        $sql = "SELECT * FROM `threads` WHERE match (`thread_title`, `thread_desc`) against ('$search')";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $threadTitle = $row["thread_title"];
            $threadDesc = $row["thread_desc"];
            $threadid = $row["thread_id"];

            echo '
            <div class="result my-3">
                <h3>
                    <a href="/forum/thread.php?threadid=' .
                $threadid .
                '   ">' .
                $threadTitle .
                '   </a>
                </h3>
                <p>' .
                $threadDesc .
                '</p>
            </div>
            ';
        }
        if ($noResult) {
            echo '<div class="container my-4">
                    <div class="jumbotron">
                        <h1 class="display-4">No Results Found</h1>
                        <p class="lead">Suggestions:
                        <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                            <li>Try fewer keywords.</li>
                        </ul>    
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