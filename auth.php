<?php
session_start();
require 'db.php';

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function login($username, $password) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

function signup($username, $email, $password) {
    global $conn;
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hash);
    return $stmt->execute();
}

function logout() {
    session_destroy();
}
?>
