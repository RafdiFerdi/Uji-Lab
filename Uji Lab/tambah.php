<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - Toko Sinar Jaya</title>
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
        form {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .button-group button {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-submit {
            background-color: #27ae60;
            color: #fff;
        }
        .btn-submit:hover {
            background-color: #2ecc71;
        }
        .btn-back {
            background-color: #e74c3c;
            color: #fff;
        }
        .btn-back:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <header>
        <h1>TOKO SINAR JAYA</h1>
    </header>
    <main>
        <form action="tambah-brg.php" method="post">
            <div class="form-group">
                <label>KODE BARANG:</label>
                <input type="text" name="kd_barang" class="form-control" placeholder="Masukkan Kode Barang" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>NAMA BARANG:</label>
                <input type="text" name="nm" class="form-control" placeholder="Masukkan Nama Barang" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>HARGA BARANG:</label>
                <input type="number" name="hg" class="form-control" placeholder="Masukkan Harga Barang" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>STOK BARANG:</label>
                <input type="number" name="stok" class="form-control" placeholder="Masukkan Stok Barang" autocomplete="off" required>
            </div>
            <div class="button-group">
                <button type="button" class="btn-back" onclick="window.location.href='barang.php'">Kembali</button>
                <button type="submit" name="submit" class="btn-submit">Submit</button>
            </div>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Toko Sinar Jaya. All Rights Reserved.</p>
    </footer>
</body>
</html>
