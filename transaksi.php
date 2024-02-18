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
    <script src="scripts.js"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
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
                    <h1 class="mt-4">Data Transaksi</h1>
                    <div class="card mb-4">
                    <div class="card-header">
                     </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $sql = "SELECT SUM(nilai) AS total_nilai FROM data";
                                        // $query1 = "SELECT * FROM transaksi";
                                        // $query2 = "SELECT SUM(total) AS total_nilai FROM dtl_transaksi";

                                        // $sql = $query1 . " UNION " . $query2;
                                        // $get = mysqli_query($conn, $sql);
                                        // $get = mysqli_query($conn, "SELECT t.*, SUM(d.total) AS total_nilai
                                        // FROM transaksi t
                                        // INNER JOIN dtl_transaksi d ON t.id_transaksi = d.id_transaksi
                                        // GROUP BY t.id_transaksi");
                                        $get = mysqli_query($conn, "SELECT * FROM transaksi");
                                        // $i=1;
                                        while ($p = mysqli_fetch_array($get)) {
                                            $id_transaksi = $p['id_transaksi'];
                                            $tanggal = $p['tanggal'];
                                            $total = $p['total'];
                                        ?>
                                        <tr>
                                                <td><?= $id_transaksi ?></td>
                                                <td><?= date('d-m-Y', strtotime($tanggal)) ?></td>
                                                <td>Rp <?php echo number_format ($total) ?></td>
                                                <td>
                                                    <button style="margin: 2px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_transaksi<?= $id_transaksi; ?>">delete</button>
                                                    <a href="detail_transaksi.php?id_transaksi=<?php echo $id_transaksi ?>" style="margin: 2px;" class="btn btn-warning">detail</a>
                                                </td>
                                            </tr>
                                            
                                            <!-- awal delete modal -->

                                            <div class="modal fade" id="delete_transaksi<?= $id_transaksi; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Transaksi</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <fieldset disabled>
                                                                    <input type="text" value="<?= $tanggal; ?>" class="form-control">
                                                                    <br />
                                                                    <input type="number" value="<?= $total; ?>" class="form-control">
                                                                    <br />
                                                                </fieldset>
                                                                
                                                                Apakah anda ingin menghapus data transaksi ini?
                                                                <br />
                                                                <br />
                                                                <input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
                                                                <input type="hidden" name="tanggal" value="<?= $tanggal; ?>">
                                                                <input type="hidden" name="total" value="<?= $total; ?>">
                                                                <button type="submit" name="delete_transaksi" class="btn btn-danger">Hapus</button>
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
<div class="modal fade" id="transaksimodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <!-- <input type="text" name="id_transaksi" placeholder="id transaksi" class="form-control">
                    <br>     -->
                    <input type="date" name="tanggal" placeholder="tanggal" class="form-control">
                    <br>
                    <select name="barang" class="form-control">
                        <option selected value="< ?= $id_barang; ?>">pilih barang</option>
                        <?php
                        $tampilanbarang = mysqli_query($conn, "SELECT * from barang");
                        while ($fetcharray = mysqli_fetch_array($tampilanbarang)) {
                            $nama_barang = $fetcharray['nama_barang'];
                            $id_barang = $fetcharray['id_barang'];
                        ?>
                            <option value="< ?= $id_barang; ?>"><?= $nama_barang; ?></option>

                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <input type="number" name="harga" placeholder="harga" id="harga" class="form-control">
                    <br />
                    <input type="number" name="jumlah" placeholder="jumlah" id="jumlah" class="form-control">
                    <br /> 
                    <input type="number" name="total" placeholder="total" class="form-control total">
                    <br />
                    <button type="submit" name="savetransaksi" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>
<!-- 
<script>
    var data = 0;
    var jumlah = 0;
    var total = 0;
    $('#barang, #jumlah').on('change input', function() {
        var data = $('#barang').val().split('_') || 0;
        var jumlah = $('#jumlah').val() || 0;
        var total = data[1] * jumlah;
        $('.harga').val(total);
    });
</script> -->