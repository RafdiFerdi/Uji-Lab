<?php
include 'koneksi.php';
$barang = mysqli_query($conn, "SELECT * FROM barang");
$jsArray = "var hargabrg = new Array();";
$jsArray1 = "var namabrg = new Array();";  
$jsArray2 = "var stokbrg = new Array();";

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
    <title>Transaksi - Toko Sinar Jaya</title>
    <link rel="stylesheet" href="style.css">
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
        .transaksi {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        input, select, button {
    width: calc(100% - 16px); /* Mengurangi lebar 16px untuk padding */
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; /* Memastikan padding dan border masuk dalam lebar elemen */
}
        
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            background-color: #27ae60;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #2ecc71;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: left;
        }
        thead {
            background-color: #34495e;
            color: #fff;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            text-align: center;
        }
        td {
            text-align: center;
        }
        .btn-2 {
            text-decoration: none;
            padding: 5px 10px;
            color: #fff;
            background-color: #e74c3c;
            border-radius: 4px;
            margin-right: 5px;
        }
        .btn-2:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <header>
        <h1>TOKO SINAR JAYA</h1>
    </header>
    <main>
        <form class="transaksi" method="POST" action="action-trans.php">
            <div class="form-group">
                <label>Id Transaksi</label>
                <input type="text" name="id" placeholder="Masukkan ID Transaksi">
            </div>
            <div class="form-group">
                <label>Tgl. Transaksi</label>
                <input type="text" name="tgl_input" value="<?php echo date("Y-m-d G:i:s"); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" list="datalist1" id="kode_barang" aria-describedby="basic-addon2" placeholder="Masukkan Kode Barang" required>
                <datalist id="datalist1">
                    <?php 
                        if(mysqli_num_rows($barang)) {
                            while($row_brg = mysqli_fetch_array($barang)) {
                                echo '<option value="' . $row_brg["kd_barang"] . '">' . $row_brg["kd_barang"] . '</option>';
                                $jsArray .= "hargabrg['" . $row_brg['kd_barang'] . "'] = '" . addslashes($row_brg['hargabrg']) . "';";
                                $jsArray1 .= "namabrg['" . $row_brg['kd_barang'] . "'] = '" . addslashes($row_brg['namabrg']) . "';";
                                $jsArray2 .= "stokbrg['" . $row_brg['kd_barang'] . "'] = '" . addslashes($row_brg['stokbrg']) . "';";
                            }
                        }
                    ?>
                </datalist>
                <button type="button" onclick="searchItem()">Cari</button>
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="namabrg" id="namabrg" readonly>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="text" id="hargabrg" name="hargabrg" readonly>
            </div>
            <div class="form-group">
                <label>Stok Barang</label>
                <input type="number" id="stokbrg" name="stokbrg" readonly>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" id="quantity" onchange="total()" name="quantity" placeholder="0" min="0" required>
            </div>    
            <div class="form-group">
                <label>Sub-Total</label>
                <input type="text" id="subtotal" name="subtotal" readonly>
            </div>
            <div class="form-group">
                <button name="save" value="simpan" type="submit">Tambah</button>
            </div>
        </form>

        <footer>
            <table id="brg">
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN barang ON transaksi.kd_barang = barang.kd_barang");
                    $no = 1;
                    while($data = mysqli_fetch_array($select)){
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['id_transaksi'] ?></td>
                        <td><?php echo $data['tgltransaksi'] ?></td>
                        <td><?php echo $data['kd_barang'] ?></td>
                        <td><?php echo $data['namabrg'] ?></td>
                        <td><?php echo rupiah($data['hargabrg']) ?></td>
                        <td><?php echo $data['stokbrg'] ?></td>
                        <td><?php echo $data['jmlbeli'] ?></td>
                        <td><?php echo rupiah($data['totalbayar']) ?></td>
                        <td>
                            <a href="print.php?id_transaksi=<?php echo $data['id_transaksi']; ?>" class="btn-2">Cetak</a> 
                            <a href="hapus-trans.php?id_transaksi=<?php echo $data['id_transaksi']; ?>" class="btn-2" onclick="return confirmDelete()">Hapus</a>
                        </td>
                    </tr>   
                    <?php } ?>
                </tbody>
            </table>
        </footer>
    </main>

    <script type="text/javascript">
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus data ini?");
        }

        <?php echo $jsArray; ?>
        <?php echo $jsArray1; ?>
        <?php echo $jsArray2; ?>

        function changeValue(kd_barang) {
            var harga = parseFloat(hargabrg[kd_barang]);
            document.getElementById("namabrg").value = namabrg[kd_barang];
            document.getElementById("hargabrg").value = formatRupiah(harga.toFixed(2).replace('.', ','), 'Rp. ');
            document.getElementById("stokbrg").value = stokbrg[kd_barang];
        }

        function searchItem() {
            var kd_barang = document.getElementById("kode_barang").value;
            changeValue(kd_barang);
        }

        function total() {
            var harga = parseFloat(document.getElementById('hargabrg').value.replace(/[^,\d]/g, '').replace(',', '.'));
            var jumlah_beli = parseInt(document.getElementById('quantity').value);
            var stok_barang = parseInt(document.getElementById('stokbrg').value);

            if (jumlah_beli < 0) {
                alert("Jumlah tidak bisa kurang dari 0!");
                document.getElementById('quantity').value = 0;
                jumlah_beli = 0;
            }

            if (jumlah_beli > stok_barang) {
                alert("Stok barang tidak mencukupi!");
                document.getElementById('quantity').value = stok_barang;
                jumlah_beli = stok_barang;
            }

            var jumlah_harga = harga * jumlah_beli;
            document.getElementById('subtotal').value = formatRupiah(jumlah_harga.toFixed(2).replace('.', ','), 'Rp. ');
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
</body>
</html>
