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
            <a class="navbar-brand" href="cakram.php"><i class="fa-solid fa-store"></i> CAKRAM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="cakram.php" title="Home"><i class="fa-solid fa-house"></i> Home</a>
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
// Koneksi ke database
$servername = "localhost";
$username = "cakram"; // Sesuaikan dengan username Anda
$password = "cakram";     // Sesuaikan dengan password Anda
$dbname = "cakram_coba"; // Sesuaikan dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pagination settings
$limit = 5; // Data per halaman
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($currentPage - 1) * $limit;

// Mengambil data dari database
$sql = "SELECT * FROM riwayat_barang LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Menghitung total data untuk pagination
$totalDataSql = "SELECT COUNT(*) as total FROM riwayat_barang";
$totalDataResult = $conn->query($totalDataSql);
$totalDataRow = $totalDataResult->fetch_assoc();
$totalData = $totalDataRow['total'];
$totalPages = ceil($totalData / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Riwayat Barang</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://badoystudio.com/cloudme.fonts.googleapis.com/css?family=Raleway">
</head>

<body>
    <div class='container'>
        <div class='row'>
            <div class="col">
                <h3 class="text-center mt-5"><b>Daftar Riwayat Barang</b></h3>
                <hr>
                <a href="cakram.php" class="btn btn-secondary"><i class="fa-solid fa-left-long"></i> Kembali</a>
                <hr>

                <!-- flashdata dengan alert -->
                <?php if (isset($_SESSION['pesan'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?= $_SESSION['pesan']; ?>
                        <?php unset($_SESSION['pesan']); ?>
                    </div>
                <?php endif; ?>

                <table class="table table-bordered table-hover mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Size</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Kode Supplier</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1 + $offset;
                        while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $row['kode_barang']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['size']; ?></td>
                                <td><?= 'Rp ' . number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td><?= $row['kode_supplier']; ?></td>
                                <td><?= date('d-m-Y H:i:s', strtotime($row['waktu'])); ?></td>
                                <td><?= $row['status']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($currentPage == 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?= $currentPage - 1; ?>">Previous</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $currentPage) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($currentPage == $totalPages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?= $currentPage + 1; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Link Bootstrap JS dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <footer class="w3-container w3-red w3-padding-32 w3-margin-top">
        <p>By CAKRAM | Contact: 081326979091 </a></p>
    </footer>
</body>

</html>

<?php
// Menutup koneksi
$conn->close();
?>
