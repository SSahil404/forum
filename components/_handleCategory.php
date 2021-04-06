<?php
$showError = "false";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "_dbConnect.php";
    $catTitle = $_POST["catTitle"];
    $catDesc = $_POST["catDesc"];
    $userid = $_POST["userid"];
    //Checking the existance
    $existSql = "SELECT * FROM `categories` WHERE cat_name='$catTitle'";
    $existResult = mysqli_query($conn, $existSql);
    // echo $result;
    $numRows = mysqli_num_rows($existResult);
    if ($numRows > 0) {
        $showError = "Category Already Exists!";
    } else {
        $sql = "INSERT INTO `categories` (`cat_name`, `cat_desc`, `created`, `created_by`) VALUES('$catTitle', '$catDesc', current_timestamp(), '$userid')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
            header("Location: /forum/index.php");
            exit();
        }
    }
    header("Location: /forum/index.php?error=$showError");
}

?>