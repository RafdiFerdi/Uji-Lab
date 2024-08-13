<?php 
include "koneksi.php";

// Mendapatkan id_transaksi dari URL
$id = $_GET['id_transaksi'];

// Query untuk mengambil data transaksi dan barang
$select = mysqli_query($conn, "SELECT * FROM transaksi 
                               INNER JOIN barang ON transaksi.kd_barang = barang.kd_barang 
                               WHERE id_transaksi = '$id'");
$data = mysqli_fetch_array($select);

// Fungsi untuk format mata uang
function rupiah($angka){
    return "Rp " . number_format($angka, 2, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Transaksi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-group {
            margin: 10px;
        }
        label {
            margin-right: 1px;
        }
        thead, th, td {
            border: 4px solid #000;
            padding: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }
        .header-print, .from-print, .to-print {
            margin-bottom: 20px;
        }
        .header-print h1, .header-print h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="header-print">
        <h1>TOKO SINAR JAYA</h1>
        <h2>No Tagihan: <?php echo $data['id_transaksi']; ?></h2>
    </header>
    <main>
        <div class="main-print">
            <div class="from-print">
                From
                <address>
                    <strong>Admin Sahretech</strong><br>
                    Jl. Sudirman No.3012, Palembang<br>
                    Kec. Palembang Raya, Palembang,<br>
                    Sumatera Selatan 30961<br>
                    Phone: (804) 123-5432<br>
                    Email: info@sahretech.com
                </address>
            </div>
            <div class="to-print">
                To
                <address>
                    Ahmad Indra Maulana<br>
                    Jl. Sudirman No. 3012, Palembang<br>
                    Kec. Palembang Raya, Palembang,<br>
                    Sumatera Selatan 30961<br>
                    Phone: (555) 539-1037<br>
                    Email: nbelputra437@gmail.com
                </address>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Stok Barang</th>
                        <th>Jumlah Beli</th>
                        <th>Total Bayar</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><?php echo $data['id_transaksi']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($data['tgltransaksi'])); ?></td>
                            <td><?php echo $data['kd_barang']; ?></td>
                            <td><?php echo $data['namabrg']; ?></td>
                            <td><?php echo rupiah($data['hargabrg']); ?></td>
                            <td><?php echo $data['stokbrg']; ?></td>
                            <td><?php echo $data['jmlbeli']; ?></td>
                            <td><?php echo rupiah($data['totalbayar']); ?></td>
                        </tr>
                        <tr>
                            <td colspan="8"><b>Total Biaya</b></td>
                            <td><b><?php echo rupiah($data['totalbayar']); ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-print">
            <p><strong>Terima Kasih atas Pembelian Anda!</strong></p>
        </div>
    </footer>
</body>
<script>
    window.print();
</script>
</html>
