<?php
require 'function.php';
date_default_timezone_set("Asia/Jakarta");
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>k-sir audy</title>
    <link href="styles.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">tokoQuee</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" onclick="opensidenav()"><i class="fas fa-bars"></i></button>
        
    </nav> 
    <script>
        function opensidenav(){
            document.getElementById("layoutsidenav").style.display="block";
        }
    </script>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                            Barang
                        </a>
                        <a class="nav-link" href="transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                            Transaksi
                        </a>
                        <a class="nav-link" href="tambah_transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                            Tambah Transaksi
                        </a>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div> 
            <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Tambah Transaksi</h1>
                    <div class="card mb-4">
                       <div class="card-header">
                            <!-- Button trigger modal -->
                            <p>Tanggal : <?php echo date('l, d M Y');?> </p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tmbhtransaksimodal" style="align: center;">
                                Barang
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        $get = mysqli_query($conn, "SELECT * FROM dtl_transaksi left join barang on dtl_transaksi.id_barang=barang.id_barang where id_transaksi is null");
                                        // $get = mysqli_query($conn, "SELECT * FROM dtl_transaksi left join barang on dtl_transaksi.id_barang=barang.id_barang where dtl_transaksi.id_transaksi = $id_transaksi");
                                        // $get = mysqli_query($conn, "SELECT * FROM dtl_transaksi ");
                                        //$i=1;
                                        while ($p = mysqli_fetch_array($get)) {
                                            $id_tmbhtransaksi = $p['id'];
                                            // $tanggal = $p['tanggal'];
                                            $nama_barang = $p['nama_barang'];
                                            $jumlah = $p['jumlah'];
                                            $harga = $p['harga'];
                                            $total = $total + ($p['harga'] *  $p['jumlah']);
                                           
                                        ?>
                                        <tr>
                                                <!-- <td>< ?= $i++ ?></td> -->
                                                <!-- <td>< ?= $id_tmbhtransaksi ?></td> -->
                                                <!-- <td>< ?= $tanggal ?></td> -->
                                                <td><?= $nama_barang ?></td>
                                                <td id="jumlahbarang"><a class="btn" href="function.php?updatetransaksi=ok&jumlah=1&barang=<?=$p['id_barang']?>&id=<?=$id_tmbhtransaksi?>"><i class="fa fa-plus" aria-hidden="true"></i></a><form action="function.php?barang=<?=$p['id_barang']?>&id=<?=$id_tmbhtransaksi?>" method="post"><input type="text" name="jumlahproduk" id="jumlahproduk" value="<?=$jumlah?>" onchange="this.form.submit()"></form><a class="btn" href="function.php?updatetransaksi=ok&jumlah=-1&barang=<?=$p['id_barang']?>&id=<?=$id_tmbhtransaksi?>"><i class="fa fa-minus" aria-hidden="true"></i></a></td>
                                                <td>Rp <?php echo number_format($harga) ?></td>
                                                <td>Rp <?php echo number_format($p['harga'] *  $p['jumlah']) ?></td>                           
                                                <td>
                                                     <a href="delete.php?id_barang=<?= $p['id_barang']; ?>">Delete</a>
                                                </td> 
                                                
                                            
                                        </tr>
                                        </div>
                                            <?php
                                        };
                                      

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                                <p align="right">Total Rp <?php echo number_format($total);?> </p>
                                <a href="function.php?simpantransaksi=oke&&total=<?=$total?>" type="submit" name="simpantransaksi" class="btn btn-primary">Simpan</a>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy;>|| by @llaudya nie bos</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>                                          
    </body>

<!-- Modal -->
<div class="modal fade" id="tmbhtransaksimodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <!-- <input type="text" name="id_dtltransaksi" placeholder="id detail transaksi" class="form-control">
                    <br> -->
                    <select name="barang" class="form-control " id="barang" required>
                        <option selected>pilih barang</option>
                        <?php
                        $tampilanbarang = mysqli_query($conn, "SELECT * from barang");
                        while ($d = mysqli_fetch_array($tampilanbarang)) {
                        ?>
                            <option value="<?php echo $d['id_barang'] ?>_<?php echo $d['harga'] ?>"><?php echo $d['id_barang'] ?> <?php echo $d['nama_barang'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <input type="number" name="jumlah" placeholder="jumlah" id="jumlah" class="form-control">
                    <br />
                    <button type="submit" name="tmbhtransaksi" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>
