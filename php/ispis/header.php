<?php
    include_once("connection.php");
    include_once("functions.php");

    if(isset($_COOKIE['sid'])) {
        session_id($_COOKIE['sid']);
    }
    session_start();

    $current_session_id = session_id();
    $expiration = time()+6*30*24*3600;
    setcookie("sid",$current_session_id,$expiration);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
</head>