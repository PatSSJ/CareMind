<?php

session_start();

if (isset($_GET["page"]) && $_GET["page"] == "logout") {
    session_unset();
    session_destroy();
    header("Location: index.php?page=login");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    if ($email != "" && $password != "") {
        $_SESSION["usuario"] = $email;
        header("Location: index.php?page=admin");
        exit;
    } else {
        $error = "Faltan datos";
        require_once("views/login_view.php");
        exit;
    }
}

?>