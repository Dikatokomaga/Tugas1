<?php 

$db = mysqli_connect("localhost","root","","phpdasar");

function query($query){
    global $db;
    $result = mysqli_query($db,$query);
    $rows =[];
    while( $row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
    }
    return $rows;
}

function tambah($data){

    global $db;
$nama = htmlspecialchars($data["nama"]);
$nrp = htmlspecialchars( $data["nrp"]);
$email = htmlspecialchars ( $data["email"]);
$jurusan = htmlspecialchars( $data["jurusan"]);

//Upload gambar 
$gambar = upload();
if( !$gambar ){
    return false;
}

$query="INSERT INTO idmahasiswa VALUES('','$nama','$nrp','$email','$jurusan','$gambar')"; 

mysqli_query($db,$query);
return mysqli_affected_rows($db);
}

function upload(){
    
    $namafile = $_FILES['gambar']['name'];
    $size = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    //cek apahkah tidak ada gambar yang diuplod 

    if($error === 4){
        echo "<script>alert('pilih gambar sek');</script>";
        return false;
    }

    //cek apahkah yang diupload adalah gambar
    $ekstensigambarvalid = ['jpg','jpeg','png'];
    $ekstensigambar= explode('.' ,$namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));

    if(!in_array($ekstensigambar,$ekstensigambarvalid)){
        echo "<script>alert('bukan gambar');</script>";
        return false;
    }

    //lolospengecekan ,gambar siap upload 
    //Generate nama gambar baru 
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    $data= move_uploaded_file($tmpname,'img/'. $namafilebaru);
    return $namafilebaru;
}




function hapus($id){
    global $db;
    mysqli_query($db,"DELETE FROM idmahasiswa WHERE id=$id");

    return mysqli_affected_rows($db);
}

function ubah($data){
    global $db;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars( $data["nrp"]);
    $email = htmlspecialchars ( $data["email"]);
    $jurusan = htmlspecialchars( $data["jurusan"]);
    $gambarlama = htmlspecialchars ($data["gambarlama"]);

    //cek apahkah user pilih gambar baru atau tidak 
    if($_FILES ['gambar']['error'] === 4){
        $gambar = $gambarlama;

    }else{
        $gambar = upload();
    }


    
    $query="UPDATE idmahasiswa SET nama='$nama'
    ,nrp='$nrp'
    ,email='$email'
    ,jurusan='$jurusan'
    ,gambar='$gambar'
    WHERE id =$id
     "; 
    
    mysqli_query($db,$query);
    return mysqli_affected_rows($db);
    
}

function cari($keyword){
    $query = "SELECT * FROM idmahasiswa WHERE 
    nama LIKE '%$keyword%'";

    return query($query);
}


function daftar($data){
    global $db;

    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($db,$data["password"]);
    $password2 = mysqli_real_escape_string($db,$data["password2"]);

    //cek username ada atau belum
    $result = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
       echo "<script> alert('sudah digunakan')</script>";
       return false;
    }

//    CEK konfirmasi password
if( $password !== $password2){
    echo "<script> alert('kenapa tuh kira kira') </script>";
    return false;
}

//enkripsi password
$password = password_hash($password,PASSWORD_DEFAULT);

//tambahkan userbaru ke database

mysqli_query($db,"INSERT INTO user VALUES('' , '$username' , '$password')");

return mysqli_affected_rows($db);



}



?>