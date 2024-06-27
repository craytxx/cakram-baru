<!DOCTYPE html>
<html lang="en">

<head>
    <title>CAKRAM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: red;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><i class="fa-solid fa-store"></i> CAKRAM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" title="Home"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="/home/about"><i class="fa-solid fa-circle-info"></i> About</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="Menu">
                            <i class="fa-solid fa-list"></i> Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="barang.php"><i class="fa-solid fa-box"></i> Daftar
                                    Barang</a></li>
                            <!-- <li><a class="dropdown-item" href="/supplier"><i class="fa-solid fa-dolly"></i> Daftar Supplier</a></li>
                            <li><a class="dropdown-item" href="/jasa"><i class="fa-solid fa-user-gear"></i> Daftar Jasa</a></li>
                            <li><a class="dropdown-item" href="/mastertrans"><i class="fa-solid fa-receipt"></i> Master Transaksi</a></li>
                            <li><a class="dropdown-item" href="/transaksi"><i class="fa-solid fa-money-bill-wave"></i> Transaksi</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="Menu">
                            <i class="fa-solid fa-list"></i> Riwayat
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="riwayat.php"><i class="fa-solid fa-folder"></i> Riwayat
                                    Barang</a></li>
                            <!-- <li><a class="dropdown-item" href="/riwayattrans"><i class="fa-regular fa-folder"></i> Riwayat Transaksi</a></li> -->
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="/barang"><i class="fa-solid fa-list"></i> Daftar Barang</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="/transaksi" title="Transaksi"><i class="fa-solid fa-money-bill-wave"></i> Transaksi</a>
                    </li> -->

            </div>
        </div>
    </nav>

    <div class="container-fluid mt-3">


    </div>
</body>

</html>


<?php

// Database configuration
$servername = "localhost";
$username = "cakram";
$password = "cakram";
$dbname = "cakram_coba";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions for adding or editing items
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_item'])) {
        // Add new item
        $kode_barang = $_POST['kode_barang'];
        $nama = $_POST['nama'];
        $stok = $_POST['stok'];
        $size = $_POST['size'];
        $harga = $_POST['harga'];
        $kode_supplier = $_POST['kode_supplier'];

        $sql = "INSERT INTO barang (kode_barang, nama, stok, size, harga, kode_supplier)
                VALUES ('$kode_barang', '$nama', '$stok', '$size', '$harga', '$kode_supplier')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Barang added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['edit_item'])) {
        // Edit existing item
        $kode_barang = $_POST['kode_barang'];
        $nama = $_POST['nama'];
        $stok = $_POST['stok'];
        $size = $_POST['size'];
        $harga = $_POST['harga'];
        $kode_supplier = $_POST['kode_supplier'];

        $sql = "UPDATE barang SET 
                nama='$nama', 
                stok='$stok', 
                size='$size', 
                harga='$harga', 
                kode_supplier='$kode_supplier'
                WHERE kode_barang='$kode_barang'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Barang updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $kode_barang = $_GET['delete'];
    $sql = "DELETE FROM barang WHERE kode_barang='$kode_barang'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Barang deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://badoystudio.com/cloudme.fonts.googleapis.com/css?family=Raleway">
</head>

<body>

    <div class="container">
        <h3 class="text-center"><b>Daftar Barang</b></h3>
        <hr>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['message'];
                unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        <a href="javascript:void(0);" class="btn btn-primary"
            onclick="document.getElementById('addForm').style.display='block'"><i class="fa-solid fa-square-plus"></i>
            Tambah Barang</a>
        <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-left-long"></i> Kembali</a>
        <!-- Back to Home Button -->
        <hr>

        <!-- Add Item Form -->
        <div id="addForm" style="display: none;">
            <form action="" method="post">
                <input type="hidden" name="add_item">
                <div class="form-group">
                    <label for="kode_barang">Kode Barang:</label>
                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" class="form-control" id="stok" name="stok" required>
                </div>
                <div class="form-group">
                    <label for="size">Size:</label>
                    <input type="text" class="form-control" id="size" name="size" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="form-group">
                    <label for="kode_supplier">Kode Supplier:</label>
                    <input type="text" class="form-control" id="kode_supplier" name="kode_supplier" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Barang</button>
            </form>
        </div>

        <!-- Display Items -->
        <table class="table table-bordered table-hover mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Size</th>
                    <th>Harga</th>
                    <th>Kode Supplier</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM barang";
                $result = $conn->query($sql);
                $i = 1;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>" . $row['kode_barang'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['stok'] . "</td>";
                        echo "<td>" . $row['size'] . "</td>";
                        echo "<td>" . 'Rp ' . number_format($row['harga'], 0, ',', '.') . "</td>";
                        echo "<td>" . $row['kode_supplier'] . "</td>";
                        echo "<td>
                        
                        <a href='?delete=" . $row['kode_barang'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Hapus</a>
                    </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No items found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Edit Item Form -->
        <?php
        if (isset($_GET['edit'])) {
            $kode_barang = $_GET['edit'];
            $sql = "SELECT * FROM barang WHERE kode_barang='$kode_barang'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <div id="editForm">
                <form action="" method="post">
                    <input type="hidden" name="edit_item">
                    <input type="hidden" name="kode_barang" value="<?= $row['kode_barang']; ?>">
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok:</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="<?= $row['stok']; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="size">Size:</label>
                        <input type="text" class="form-control" id="size" name="size" value="<?= $row['size']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="<?= $row['harga']; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="kode_supplier">Kode Supplier:</label>
                        <input type="text" class="form-control" id="kode_supplier" name="kode_supplier"
                            value="<?= $row['kode_supplier']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Barang</button>
                </form>
            </div>
            <?php
        }
        ?>

    </div>
    <br><br>
    <footer class="w3-container w3-red w3-padding-32 w3-margin-top">
        <p>By CAKRAM | Contact: 081326979091 </a></p>
    </footer>
</body>

</html>

<?php
// Close the connection
$conn->close();
?>
