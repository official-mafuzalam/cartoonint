<?php
session_start();

if (!isset($_SESSION['w_type'])) {
    header("Location: ../login.php");
}

// $pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $stmt = $pdo->prepare('SELECT account_type FROM users WHERE username = :username');
// $stmt->bindParam(':username', $_SESSION['username']);
// $stmt->execute();

// $user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SESSION['w_type'] == 1) {

    header("Location: ../users/administration.php");

} elseif ($_SESSION['w_type'] == 3) {

    header("Location: ../users/teacher.php");

} elseif ($_SESSION['w_type'] == 4) {

    header("Location: ../users/accountants.php");

} else {
    header("Location: ../logout.php");
}
?>