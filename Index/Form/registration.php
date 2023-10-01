<?php

include('db_connection.php');

$username = $email = $password = $agree = $login_username = $login_password = "";
$usernameErr = $emailErr = $passwordErr = $agreeErr = $login_usernameErr = $login_passwordErr = $fnameErr = $lnameErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['registerBtn'])) {
    // Registration form processing
    if (empty($_POST["register_username"])) {
      $usernameErr = "Username is required";
    } else {
      $username = $_POST["register_username"];
    }

    // New validation code
    if (empty($_POST["register_fname"])) {
      $fnameErr = "First Name is required";
    } else {
      $first_name = $_POST["register_fname"];
    }

    if (empty($_POST["register_lname"])) {
      $lnameErr = "Last Name is required";
    } else {
      $last_name = $_POST["register_lname"];
    }

    if (empty($_POST["register_email"])) {
      $emailErr = "Email is required";
    } else {
      $email = $_POST["register_email"];
    }

    if (empty($_POST["register_password"])) {
      $passwordErr = "Password is required";
    } else {
      $password = $_POST["register_password"];
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    if (!isset($_POST["register_agree"])) {
      $agreeErr = "You must agree to the terms and conditions";
    } else {
      $agree = "Agreed";
    }

    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($agreeErr) && empty($fnameErr) && empty($lnameErr)) {
      $conn = connectDB();
      $sql = "INSERT INTO users (username, first_name, last_name, email, password, agree) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssssss", $username, $first_name, $last_name, $email, $hashedPassword, $agree);

      if ($stmt->execute()) {
        header("Location: registration_success.php");
        exit();
      } else {
        echo "Error: " . $conn->error;
      }

      $conn->close();
    }
  } elseif (isset($_POST['loginBtn'])) {
    // Login form processing
    if (empty($_POST["login_username"])) {
      $login_usernameErr = "Username is required";
    } else {
      $login_username = $_POST["login_username"];
    }

    if (empty($_POST["login_password"])) {
      $login_passwordErr = "Password is required";
    } else {
      $login_password = $_POST["login_password"];
    }

    if (empty($login_usernameErr) && empty($login_passwordErr)) {
     
      $sql = "SELECT * FROM users WHERE username = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $login_username);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($login_password, $row['password'])) {
          session_start();
          $_SESSION['username'] = $row['username'];
          header("Location: logged_in.php");
          exit();
        } else {
          $login_passwordErr = "Incorrect password";
        }
      } else {
        $login_usernameErr = "Username not found";
      }

      $conn->close();
    }
  }
}

