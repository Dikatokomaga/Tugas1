 <?php 
 session_start();



if(!isset($_SESSION["login"])){
    header("Location: login.php");
}


 require'functions.php';

//pagination
//konfigurasi
$perhalaman = 3;
$jumlahdata = count(query("SELECT * FROM idmahasiswa"));
$jumlahhalaman = ceil($jumlahdata / $perhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
//? bersungsi sebagai if yang akan menjalankan yang bernilai true sedangkan : yang akan menjalakan false 
$awaldata=($perhalaman * $halamanaktif) - $perhalaman;
//perhalaman(3) X halamanaktif(3)-halamanaktif(3)=6



 $mahasiswa = query("SELECT * FROM idmahasiswa LIMIT $awaldata,$perhalaman ");

//ketika tombol cari ditekan 
if (isset($_POST["cari"])){
   $mahasiswa = cari($_POST["keyword"]); 
}

 ?>
 
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
 </head>
 <body>
    <a href="logout.php">Logout</a>


    <h2> Daftar mahasiswa</h2>

    <a href="tambah.php">Tambah data </a>
    <br></br>

    <form action="" method="post">
        <input type="text" name="keyword" autofocus placeholder="Cari" autocomplate="off">

        <button type="submit" name="cari">Cari</button>
    </form>
    <br>


    <!-- navigasi -->
    <?php if($halamanaktif > 1) : ?>
        <a href="?halaman= <?php echo $halamanaktif - 1; ?>"><</a>
    <?php endif; ?>




    <?php for($i= 1; $i  <= $jumlahhalaman; $i++) :?>
        <?php if($i == $halamanaktif) : ?>
        <a href="?halaman=<?php echo $i; ?>"style="font-weight : bold; color: red;" ><?php echo $i; ?></a>
         <?php else :?>
            <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
         <?php endif; ?>  

    <?php endfor; ?>

  
    
    
    <?php if($halamanaktif < $jumlahhalaman) : ?>
        <a href="?halaman= <?php echo $halamanaktif + 1; ?>">></a>
    <?php endif; ?>







<br>

    <table border ="1" cellpadding="10" cellspacing="0" >
        <tr>
            <th>No.</th>
            <th>aksi </th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>nrp</th>
            <th>email</th>
            <th>jurusan</th>
        </tr>
        <?php $i=1 + $awaldata; ?>
<?php foreach($mahasiswa as $row) : ?>
        <tr>
            <td> <?php echo $i; ?></td>
            <td>
                <a href="ubah.php?id=<?php echo $row["id"];?>">ubah</a>
                <a href="hapus.php?id=<?php echo $row["id"];?>" onclick="return confirm ('yakin dek?');" >hapus</a>
            </td>
            <td><img src="img/<?php echo $row['gambar']; ?>" width="50px"></td>

            <td> <?php echo $row["nama"]; ?></td>

            <td> <?php echo $row["nrp"]; ?></td>

            <td><?php echo $row["email"]; ?></td>

            <td><?php echo $row["jurusan"]; ?></td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>

    </table>
 </body>
 </html>