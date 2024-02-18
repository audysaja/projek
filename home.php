<?php
require 'function.php';
date_default_timezone_set("Asia/Jakarta");
session_start();

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
        <a><font color="white">Hello!!, Selamat Datang <?php echo $_SESSION['name']; ?></font></a>
        
    </nav> 
    <script>
        function opensidenav(){
            document.getElementById("layoutSidenav").style.display="block";
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
                <div class="container-fuild">
                    <h1 class="mt-4">Stok Barang</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- button tambah barang (trigger modal)-->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#barangmodal">
                                Tambah Barang
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>No</th> -->
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $viewbarang = mysqli_query($conn, "SELECT * FROM `barang`");
                                        while ($data = mysqli_fetch_array($viewbarang)) {
                                            $id_barang = $data['id_barang'];
                                            $nama_barang = $data['nama_barang'];
                                            $harga = $data['harga'];
                                            $stok = $data['stok'];
                                        ?>
                                        <tr>
                                                <!-- <td>< ?= $i++ ?></td> -->
                                                <td><?= $id_barang ?></td>
                                                <td><?= $nama_barang ?></td>
                                                <td>Rp <?php echo number_format($harga)?></td>
                                                <td><?= $stok ?></td>
                                                <td>
                                                    <button style="margin: 2px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_barang<?= $id_barang; ?>">delete</button>
                                                    <button style="margin: 2px;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalupdate<?= $id_barang; ?>">Ubah</button>
                                                </td>
                                            </tr>
                                            <!-- update modal -->
                                            <div class="modal fade" id="modalupdate<?= $id_barang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Barang</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <input type="text" name="id_barang" value="<?= $id_barang; ?>" class="form-control" required>
                                                                <br />
                                                                <input type="text" name="nama_barang" value="<?= $nama_barang; ?>" class="form-control" required>
                                                                <br />
                                                                <input type="number" name="harga" value="<?= $harga; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="stok" value="<?= $stok; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="id_barang" value="<?= $id_barang; ?>">
                                                                <br />
                                                                <button type="submit" name="updatebarang" class="btn btn-warning">Ubah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- update modal -->

                                            <!-- awal delete modal -->

<div class="modal fade" id="delete_barang<?= $id_barang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <fieldset disabled>
                        <!-- <input type="text" value="< ?= $id_barang; ?>" class="form-control">
                        <br /> -->
                        <input type="text" value="<?= $nama_barang; ?>" class="form-control">
                        <br />
                        <input type="number" value="<?= $stok; ?>" class="form-control">
                        <br />
                    </fieldset>
                
                    Apakah anda ingin menghapus data barang ini?
                    <br />
                    <br>
                    <input type="hidden" name="id_barang" value="<?= $id_barang; ?>">
                    <input type="hidden" name="harga" value="<?= $harga; ?>">
                    <button type="submit" name="delete_barang" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete modal transaksi -->

                                            
                                        <?php
                                        };

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy;>|| by @llaudya nie bos</div>
                            <!-- <a href="https://acbagusid.anandanesia.com/about.html" style="text-decoration:none;"</a> -->
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

<div class="modal fade" id="barangmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="text" name="id_barang" placeholder="id barang" class="form-control" required>
                    <br />
                    <input type="text" name="nama_barang" placeholder="nama barang" class="form-control" required>
                    <br />
                    <input type="number" name="harga" placeholder="harga" class="form-control" required>
                    <br />
                    <input type="number" name="stok" placeholder="stok" class="form-control" required>
                    <br />
                    <!-- <textarea type="text" placeholder="spesifikasi hp" class="form-control" name="spek" rows="3" required></textarea>
                    <br /> -->
                    <button type="submit" name="insertbarang" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</html>