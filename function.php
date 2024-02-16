<?php
date_default_timezone_set("Asia/Jakarta");
session_start();

//database connection
$conn =mysqli_connect("localhost", "root", "", "newkasir");

//insert barang
if (isset($_POST['insertbarang'])) {
    $id_barang =$_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $tambahbarang = mysqli_query($conn, "INSERT INTO barang (id_barang, nama_barang, harga, stok) VALUES ('$id_barang', '$nama_barang', '$harga', '$stok')");
    if ($tambahbarang) {
        header('location:index.php');
    } else {
        echo "gagal";
        header('location:index.php');
    }
}

//update barang
if (isset($_POST['updatebarang'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    

    $updatebarang = mysqli_query($conn, "UPDATE barang SET id_barang='$id_barang', nama_barang='$nama_barang', harga='$harga', stok='$stok' WHERE barang. id_barang='$id_barang' ");
    if ($updatebarang) {
        header('location:index.php');
    } else {
        echo "gagal";
        header('location:index.php');
    }
}

//hapus barang
if (isset($_POST['delete_barang'])) {
    $id_barang = $_POST['id_barang'];

    $delete_barang = mysqli_query($conn, "DELETE FROM barang WHERE id_barang='$id_barang' ");
    if ($delete_barang) {
        header('location:index.php');
    } else {
        echo "gagal";
        header('location:index.php');
    }
}

//hapus transaksi
if (isset($_POST['delete_transaksi'])) {
    $id_transaksi = $_POST['id_transaksi'];

    $delete_transaksi = mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi' ");
    if ($delete_transaksi) {
        header('location:transaksi.php');
    } else {
        echo "gagal";
        header('location:transaksi.php');
    }
}


//insert detailtransaksi
// if (isset($_POST['savedtltransaksi'])) {
//     $id_dtltransaksi =$_POST['id_dtltransaksi'];
//     $id_barang = $_POST['id_barang'];
//     $tanggal = $_POST['tanggal'];
//     $harga = $_POST['harga'];
//     $jumlah = $_POST['jumlah'];
//     $total = $_POST['total'];

//     $tambahdtltransaksi = mysqli_query($conn, "INSERT INTO dtl_transaksi (id_dtltransaksi, id_barang, tanggal, harga, jumlah, total) VALUES ('$id_dtltransaksi', '$id_barang', '$tanggal', $harga', '$jumlah', '$total')");
//     if ($tambahdtltransaksi) {
//         header('location:dtltransaksi.php');
//     } else {
//         echo "gagal";
//         header('location:dtltransaksi.php');
//     }
// }

// if (isset($_POST['savedtltransaksi'])) {
// 	// $id_dtltransaksi =$_POST['id_dtltransaksi'];
//     $barang = explode('_', $_POST['barang']);
//     $tanggal = $_POST['tanggal'];
//     // $harga = $_POST['harga'];
//     $jumlah = $_POST['jumlah'];
//     $total = $_POST['total'];
// 	 //[0]=>3, [1]=>1200

// 	$lihatstock = mysqli_query($conn, "SELECT * from barang where id_barang='$barang[0]'");
// 	$stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
// 	$stockskrg = $stocknya['stok'];

// 	if ($jumlah <= $stockskrg) {
// 		$stockupdate = $stockskrg - $jumlah;
// 		$updatestock = mysqli_query($conn, "UPDATE barang set stok='$stockupdate' where id_barang='$barang[0]'");
// 		$tambahdtltransaksi = mysqli_query($conn, "INSERT into dtl_transaksi (id_barang, tanggal, jumlah, total) values ('$barang[0]', '$tanggal', '$jumlah', '$total')");
//         //$tambahtransaksi = mysqli_query($conn, "INSERT into transaksi (id_transaksi, tanggal, total) values ('$id_transaksi', '$tanggal', '$total')");
// 		header('location:dtltransaksi.php');
// 	} else {
// 		echo "gagal";
// 		header('location:dtltransaksi.php');
// 	}
// }

//insert tambah_transaksi
if (isset($_POST['tmbhtransaksi'])) {
	$id_tmbh =$_POST['id_tmbh'];
    $barang = explode('_', $_POST['barang']);
    $jumlah = $_POST['jumlah'];
    // $total = $_POST['total'];

	$lihatstock = mysqli_query($conn, "SELECT * from barang where id_barang='$barang[0]'");
	$stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
	$stockskrg = $stocknya['stok'];

	if ($jumlah <= $stockskrg) {
        if(isset($_POST['id_transaksi'])){
            $id_transaksi = $_POST['id_transaksi'];
            $stockupdate = $stockskrg - $jumlah;
            $tanggal = date("Y-m-d");
            $total = $barang[1]*$jumlah;
            $updatestock = mysqli_query($conn, "UPDATE barang set stok='$stockupdate' where id_barang='$barang[0]'");
            $tmbhtransaksi = mysqli_query($conn, "INSERT into dtl_transaksi (id_barang, id_transaksi, harga, jumlah, tanggal, total) values ('$barang[0]','$id_transaksi', '$barang[1]', '$jumlah', '$tanggal','$total')");
            //$tambahtransaksi = mysqli_query($conn, "INSERT into transaksi (id_transaksi, tanggal, total) values ('$id_transaksi', '$tanggal', '$total')");
            header('location:tambah_transaksi.php');
        }
        else{
            $stockupdate = $stockskrg - $jumlah;
            $tanggal = date("Y-m-d");
            $total = $barang[1]*$jumlah;
            $updatestock = mysqli_query($conn, "UPDATE barang set stok='$stockupdate' where id_barang='$barang[0]'");
            $tmbhtransaksi = mysqli_query($conn, "INSERT into dtl_transaksi (id_barang, harga, jumlah, tanggal, total) values ('$barang[0]', '$barang[1]', '$jumlah', '$tanggal','$total')");
            //$tambahtransaksi = mysqli_query($conn, "INSERT into transaksi (id_transaksi, tanggal, total) values ('$id_transaksi', '$tanggal', '$total')");
            header('location:tambah_transaksi.php');
        }
		
	} else {
		echo "gagal";
		header('location:tambah_transaksi.php');
	}
}

//simpan tambah transaksi
if (isset($_GET['simpantransaksi'])) {
    $tanggal = date("Y-m-d");
    $total = $_GET['total'];
    $id_transaksi = random_int(0,9999);
    $simpantransaksi = mysqli_query($conn, "INSERT INTO transaksi (id_transaksi, tanggal, total) VALUES ('$id_transaksi', '$tanggal', '$total')");
    if ($simpantransaksi) {
        $simpantransaksi = mysqli_query($conn, "UPDATE dtl_transaksi SET `id_transaksi` = $id_transaksi WHERE `id_transaksi` is null");
        header('location:transaksi.php');
    } else {
        echo "gagal";
        header('location:transaksi.php');
    }
}
if (isset($_GET['updatetransaksi'])) {
	$idtmbh =$_GET['id'];
    $idbrg =$_GET['barang'];
    $jumlah = $_GET['jumlah'];
	$lihatstock = mysqli_query($conn, "SELECT * from barang where id_barang='$idbrg'");
	$stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
	$stockskrg = $stocknya['stok'];
    $harga = $stocknya['harga'];

	if ($jumlah <= $stockskrg) {
		$stockupdate = $stockskrg - $jumlah;
        $tanggal = date("Y-m-d");
        $total = $barang[1]*$jumlah;
		$updatestock = mysqli_query($conn, "UPDATE barang set stok='$stockupdate' where id_barang='$idbrg'");
		$tmbhtransaksi = mysqli_query($conn, "UPDATE dtl_transaksi set jumlah = jumlah+$jumlah, total = total+($harga*$jumlah) where id = $idtmbh");
        //$tambahtransaksi = mysqli_query($conn, "INSERT into transaksi (id_transaksi, tanggal, total) values ('$id_transaksi', '$tanggal', '$total')");
		header('location:tambah_transaksi.php');
	} else {
		echo "gagal";
		header('location:tambah_transaksi.php');
	}
}
if (isset($_POST['jumlahproduk'])) {
	$idtmbh =$_GET['id'];
    $idbrg =$_GET['barang'];
    $lihatstock2 = mysqli_query($conn, "SELECT * from dtl_transaksi where id='$idtmbh'");
    $stocknya2 = mysqli_fetch_array($lihatstock2);
    $jumlahbarang = $stocknya2['jumlah'];
    $jumlah = $_POST['jumlahproduk'];
	$lihatstock = mysqli_query($conn, "SELECT * from barang where id_barang='$idbrg'");
	$stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
	$stockskrg = $stocknya['stok'];
    $harga = $stocknya['harga'];

	if ($jumlah <= $stockskrg) {
		$stockupdate = $stockskrg - ($jumlah-$jumlahbarang);
        $tanggal = date("Y-m-d");
        $total = $barang[1]*$jumlah;
		$updatestock = mysqli_query($conn, "UPDATE barang set stok='$stockupdate' where id_barang='$idbrg'");
		$tmbhtransaksi = mysqli_query($conn, "UPDATE dtl_transaksi set jumlah = $jumlah, total = $harga*$jumlah where id = $idtmbh");
        //$tambahtransaksi = mysqli_query($conn, "INSERT into transaksi (id_transaksi, tanggal, total) values ('$id_transaksi', '$tanggal', '$total')");
		header('location:tambah_transaksi.php');
	} else {
		echo "gagal";
		header('location:tambah_transaksi.php');
	}
}