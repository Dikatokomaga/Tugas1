<?php 
// koneksi ke dbms
require 'functions.php';

if(isset($_POST["submit"])){
// ambil data dari tiap elemen data form



// query insert data 


//Cek apahkah tombol submit sudah di tekan 

// cek apahkah data berhasil ditambahkan 
if(tambah($_POST)> 0){
    echo "<script>
    alert('berhasil rek');
    document.location.href= 'index.php';
    </script>";
}else{
    echo "<script>
    alert('gagal bjir');
    document.location.href= 'index.php';
    </script>";
}
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
    
<H1>tambah data </H1>

<form action="" method="post" enctype="multipart/form-data" >
    <ul>
    <li>
            <label for="nama">nama</label>
            <input type="text" name="nama" id="nama"required>
        </li>
<br></br>
        <li>
            <label for="nrp">NRP</label>
            <input type="text" name="nrp" id="nrp">
        </li>

        <br></br>

        <li>
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </li>

        <br></br>

        <li>
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan">
        </li>

        <br></br>
        <li>
            <label for="gambar">Gambar</label>
            <input type="text" name="gambar" id="gambar">
            <input type="file" name="gambar" id="gambar">
        </li>

        <li>
            <button type="submit" name="submit" >Tambah</button>
        </li>
        

    </ul>


 </form>

</body>
</html>