<?php
session_start();
//unset($_SESSION["id"]);
//unset($_SESSION["name"]);

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
unset($_SESSION['logged_in']);
unset($_SESSION['user']);
session_destroy();
header("Cache-Control", "no-cache, no-store, must-revalidate");
header("location:login.html");
?>