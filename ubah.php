<?php 

session_start();



if(!isset($_SESSION["login"])){
    header("Location: login.php");
}

// koneksi ke dbms
require 'functions.php';

//ambil data di url
$id= $_GET["id"];

//query data mahasiswaa berdasarkan id 
$mhs = query("SELECT * FROM idmahasiswa WHERE id=$id")[0];

// ambil data dari tiap elemen data form
if(isset($_POST["submit"])){



// query insert data 


//Cek apahkah tombol submit sudah di tekan 

// cek apahkah data berhasil ditambahkan 
if(ubah($_POST)> 0){
    echo "<script>
    alert('berhasil ubah rek');
    document.location.href= 'index.php';
    </script>";
}else{
    echo "<script>
    alert('gagal ubah bjir');
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
    
<H1>ubah data </H1>

<form action="" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>" >

    <input type="hidden" name="gambarlama" value="<?php echo $mhs["gambar"]; ?>" >

    <ul>
    <li>
            <label for="nama">nama</label>
            <input type="text" name="nama" id="nama"required value="<?php echo $mhs["nama"]; ?>" >
        </li>
<br></br>
        <li>
            <label for="nrp">NRP</label>
            <input type="text" name="nrp" id="nrp" value="<?php echo $mhs["nrp"]; ?>" >
        </li>

        <br></br>

        <li>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php echo $mhs["email"]; ?>" >
        </li>

        <br></br>

        <li>
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" value="<?php echo $mhs["jurusan"]; ?>" >
        </li>

        <br></br>
        <li>
            <label for="gambar">gambar</label>
            <input type="file" name="gambar" id="gambar">
            <img src="img/<?php echo $mhs['gambar'] ?>" width="300px" >
        </li>

        <li>
            <button type="submit" name="submit" >ubah</button>
        </li>
        

    </ul>


 </form>

</body>
</html>