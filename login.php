<?php 
session_start();
require 'functions.php';

//cek cookie 
if(isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    
    //ambil username berdasarkan id 
    $result = mysqli_query($db,"SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username 
    if($key === hash('sha256',$row['username'])){
        $_SESSION['login'] = true;
    }

}


if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}


if(isset ($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($db,"SELECT * FROM user WHERE username='$username'");

    //cek username 
    if(mysqli_num_rows($result) === 1 ){

        //cekpassword
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password,$row["password"])){
            //set session 
        $_SESSION["login"] = true;

        //cek remember 
        if( isset($_POST['remember'])){
            //buat cookie

            setcookie('id',$row['id'],time()+120);
            setcookie('key',hash('sha256',$row['username']),time()+120);
        }


         header("Location: index.php");
            exit;
        }
        
    }

    $error = true;

}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1> halaman login </h1>

    <?php if (isset($error)): ?>
        <h4 >salah dek </h4>
        <?php endif; ?>


    <form action="" method="post">

    <ul>
        <li>
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </li>

        <li>
        <label for="password">password</label>
            <input type="password" name="password" id="password">
        </li>

        <li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">remember <meta name="keywords" content=""></label>
        </li>

        <li>
            <button type="submit" name="login">login</button>
        </li>



    </ul>
    </form>
 



</body>
</html>