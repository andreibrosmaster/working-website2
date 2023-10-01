<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['registerBtn'])) {
        // Registration code
        $username = $_POST['register_username'];
        $f_name = $_POST['register_fname'];
        $l_name = $_POST['register_lname'];
        $email = $_POST['register_email'];
        $password = $_POST['register_password'];
        $agree = isset($_POST['register_agree']) ? 1 : 0; // Checkbox value

        // Establish Connection
        $db_host = "localhost"; // Change this to your database host
        $db_user = "root";      // Change this to your database username
        $db_pass = "";          // Change this to your database password
        $db_name = "register";  // Change this to your database name

        // Create a connection to the database
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        // Check the connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect!";
            exit();
        } else {
            // Hash the password before storing it in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database
            $sql = "INSERT INTO `users` (username, first_name, last_name, email, password, agree) VALUES ('$username', '$f_name', '$l_name', '$email', '$hashed_password', $agree)";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "Registration Successful";
            } else {
                die(mysqli_error($conn));
            }
        }
    } elseif (isset($_POST['loginBtn'])) {
        // Login code
        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];

        // Establish Connection
        $db_host = "localhost"; // Change this to your database host
        $db_user = "root";      // Change this to your database username
        $db_pass = "";          // Change this to your database password
        $db_name = "register";  // Change this to your database name

        // Create a connection to the database
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        // Check the connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect!";
            exit();
        } else {
            // Query the database to check if the user exists
            $sql = "SELECT * FROM `users` WHERE username='$login_username' LIMIT 1";
            $login_result = mysqli_query($conn, $sql);

            if ($login_result && mysqli_num_rows($login_result) == 1) {
                // User found, now check the password
                $user_data = mysqli_fetch_assoc($login_result);
                $stored_password = $user_data['password'];

                if (password_verify($login_password, $stored_password)) {
                    // Successful login
                    echo "Login Successful";
                } else {
                    echo "Invalid password";
                }
            } else {
                echo "Invalid username";
            }
        }
    }
}
?>

<!-- Your HTML form code for registration and login here -->
