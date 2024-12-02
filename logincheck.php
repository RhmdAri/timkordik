<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../");
    exit();
}

if (isset($_SESSION['level'])) {
    if ($_SESSION['level'] === 'admin') {
        if (strpos($_SERVER['REQUEST_URI'], 'admin') === false) {
            header("Location: ../admin/?page=dashboard");
            exit();
        }
    } elseif ($_SESSION['level'] === 'user') {
        if (strpos($_SERVER['REQUEST_URI'], 'user') === false) {
            header("Location: ../user/?page=dashboard");
            exit();
        }
    }
} else {
    header("Location: ../");
    exit();
}
?>