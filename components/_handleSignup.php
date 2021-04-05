<?php
$showError = "false";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "_dbConnect.php";
    $user_name = $_POST["userName"];
    $user_email = $_POST["userEmail"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    //Checking the existance
    $existSql = "SELECT * FROM users WHERE user_email='$user_email'";
    $existResult = mysqli_query($conn, $existSql);
    // echo $result;
    $numRows = mysqli_num_rows($existResult);
    if ($numRows > 0) {
        $showError = "Email already in use";
    } else {
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (`user_name`, `user_email`, `user_pass`, `timestamp`) VALUES ('$user_name', '$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            // echo $result;
            if ($result) {
                $showAlert = true;
                echo $result;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        } else {
            $showError = "Passwords do not match";
        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=$showError");
}

?>