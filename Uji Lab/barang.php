<?php
include 'koneksi.php';
function rupiah($angka){
    $hasil_rp= "Rp " . number_format($angka,2,',','.');
    return $hasil_rp;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Toko Sinar Jaya</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pHQVM3+vJ00dOq/aDRTIO/NG4xXUm0CzOdJOMY2SY9AZaPWO5cQ9pNJc20cLHwSa2sj/2t1q0p5cVpblQXKmow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header, footer {
            background-color: #2c3e50;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        main {
            padding: 20px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .button {
            display: flex;
            gap: 10px;
        }
        .btn-1, .btn-2, .btn-home {
            border: 1px solid #000;
            padding: 5px 10px;
            text-decoration: none;
            color: black;
            background-color: #e0e0e0;
            border-radius: 4px;
        }
        .btn-2 {
            margin: 0 5px;
        }
        .btn-1:hover, .btn-2:hover, .btn-home:hover {
            background-color: #ccc;
            color: black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            min-width: 400px;
        }
        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }
        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }
        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }
        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
</head>
<body>
    <header>
        <h1>TOKO SINAR JAYA</h1>
    </header>
    <main>
        <div class="button-container">
            <div class="button">
                <a href="index.php" class="btn-home"><i class="fa fa-home"></i> Home</a>
                <a href="tambah.php" class="btn-1">Tambah Data</a>
            </div>
        </div>
        <table id="brg">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Stok Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $select = mysqli_query($conn, "SELECT * FROM barang");
                    while($data = mysqli_fetch_array($select)){
                ?>
                <tr>
                    <td><?php echo $data['kd_barang'] ?></td>
                    <td><?php echo $data['namabrg'] ?></td>
                    <td><?php echo rupiah($data['hargabrg']) ?></td>
                    <td><?php echo $data['stokbrg'] ?></td>
                    <td class="text-center">
                        <a href="hapus.php?kd_barang=<?php echo $data['kd_barang']?>" class="btn-2">Hapus</a>
                        <a href="edit.php?kd_barang=<?php echo $data['kd_barang'] ?>" class="btn-2">Edit</a>
                    </td>
                </tr> 
                <?php } ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 Toko Sinar Jaya. All Rights Reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#brg').DataTable({
                searchable: false,
                scrollCollapse: true,
                scrollY: '200px'
            });
        });
    </script>
</body>
</html>