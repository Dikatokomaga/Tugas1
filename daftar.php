<?php 
 require 'functions.php';

 if(isset($_POST["daftar"])){
    if(daftar($_POST)>0){
        echo "<script> alert('user baru berhasil ditambahkan') </script>";
    }else{
        echo mysqli_error($db);
    }
 }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        label{
            display: block;
        }
    </style>

</head>
<body>
    <h1>
        Daftar
    </h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                 <label for="password">password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                 <label for="password2">konfirmasi password</label>
                <input type="password2" name="password2" id="password2">
            </li>
            <li>
                <button type="submit" name="daftar" >daftar
                    
                </button>

            </li>
        </ul>
    </form>
</body>
</html>