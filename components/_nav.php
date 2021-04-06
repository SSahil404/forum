<?php
session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">iDiscuss</a>
        <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>';
// <li class="nav-item">
// <a class="nav-link" href="about.php">About</a>
// </li>
echo '
                <li class="nav-item dropdown">
                <a 
                    class="nav-link dropdown-toggle" 
                    href="#" 
                    id="navbarDropdown" 
                    role="button" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false"
                >
                    Top Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

$sql = "SELECT cat_name, cat_id FROM `categories`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $catName = $row["cat_name"];
    $catId = $row["cat_id"];
    echo '
        <li><a class="dropdown-item" href="/forum/threadsList.php?catid=' .
        $catId .
        '">' .
        $catName .
        "</a></li>";
}
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "true") {
    echo '
        <li><hr class="dropdown-divider"></li>
        <li><button
            class="btn btn-outline-success mx-2"
            data-bs-toggle="modal"
            data-bs-target="#categoryModal"
        >
            Add a new category
        </button></li>
                ';
} else {
    echo '
        <li><hr class="dropdown-divider"></li>
        <li class="px-2">Login to add new category</li>
    ';
}
echo '
            </ul>
        </li>
    </ul>';
// echo '<li class="nav-item">
//             <a class="nav-link " href="contact.php">Contact</a>
//         </li>
//     </ul>';

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    // $user = str_split($_SESSION["userEmail"], 5);
    echo '<form class="d-flex" action="/forum/search.php" method="GET">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
            <p class="text-light username w-100">Welcome ' .
        $_SESSION["userName"] .
        "   </p> 
        </form>";
    echo '<div>
            <a href="components/_logout.php">
                <button class="btn btn-outline-success m-2">Logout</button>
            </a>        
        </div>';
} else {
    echo '<div class="row">
            <div class="mx-2 my-2">
                <button
                class="btn btn-outline-success mx-2"
                data-bs-toggle="modal"
                data-bs-target="#loginModal"
                >
                    Login
                </button>
                <button
                class="btn btn-outline-success"
                data-bs-toggle="modal"
                data-bs-target="#signupModal"
                >
                    Sigup
                </button>
            </div>
        </div>
        </form>"';
}
echo '</div>
        </div>
    </nav>';

include "./components/_loginModal.php";
include "./components/_signupModal.php";
include "./components/_categoryModal.php";

if (isset($_GET["signupsuccess"]) && $_GET["signupsuccess"] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You can now log in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
if (isset($_GET["error"])) {
    $showError = $_GET["error"];
    echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> ' .
        $showError .
        '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>