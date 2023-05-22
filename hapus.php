<?php 

require 'functions.php';

$id = $_GET["id"];

if (hapus($id)>0) {
    echo "<script>
    alert('berhasil rek');
    document.location.href= 'index.php';
    </script>";
} else{
    echo "<script>
    alert('gagal hapus');
    document.location.href= 'index.php';
    </script>";
}
?>