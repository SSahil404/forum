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

    <!-- slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x600/?coding,coder" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x600/?coding,php" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x600/?programming,computer" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- categpry container -->

    <div class="container my-4 categories">
        <h2 class="text-center"> iDiscuss - Browse Categories </h2>
        <div class="row">

            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                // echo $row["cat_id"];
                // echo $row["cat_name"];
                echo '<div class="col-md-4 d-flex justify-content-center">
                        <div class="card my-4" style="width: 18rem;">
                            <img src="https://source.unsplash.com/500x300/?coding,' .
                    $row["cat_name"] .
                    '" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="threadsList.php?catid=' .
                    $row["cat_id"] .
                    '">' .
                    $row["cat_name"] .
                    '               </a>
                                </h5>
                                <p class="card-text">' .
                    substr($row["cat_desc"], 0, 150) .
                    '.....</p>
                                <a href="threadsList.php?catid=' .
                    $row["cat_id"] .
                    '" class="btn btn-success">View Threads</a>
                            </div>
                        </div>
                    </div>';
            }
            ?>

        </div>
    </div>

    <?php include "./components/_footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>

</html>