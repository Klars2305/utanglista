<?php
session_start();

include("../config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE admin_email = '$email'";
    $result = mysqli_query($connection, $query);
    $row_count = mysqli_num_rows($result);

    if ($row_count === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['admin_password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['admin_name'];
            $_SESSION['admin_email'] = $user['admin_email'];
            $_SESSION['admin_role'] = $user['admin_role'];

            header("Location: ../views/dashboard.php");
        } else {
            echo "wrong_password";
        }
    } else {
        echo "not_found";
    }

    mysqli_close($connection);
} else {
    echo "invalid_request";
}
?>
