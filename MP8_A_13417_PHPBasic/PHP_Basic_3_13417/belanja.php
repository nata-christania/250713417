<?php
$makanan = $_POST['makanan'] ?? '';
$aksesoris = $_POST['aksesoris'] ?? '';
$errors = [];
$success = false;

$hargaMakanan = 0;
$hargaAksesoris = 0;
$totalBayar = 0;
$diskon = 0;
$totalHarga = 0;

function dapatDiskon($totalBayar) {
    if ($totalBayar >= 100000) {
        return 0.10;
    } else {
        return 0;
    }
}

function totalHarga($diskon, $totalBayar) {
    return $totalBayar - ($totalBayar * $diskon);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($makanan) || empty($aksesoris)) {
        $errors[] = "Harap pilih makanan/minuman dan aksesoris.";
    }

    if (empty($errors)) {
        if ($makanan == "daging_kaleng") {
            $hargaMakanan = 10000;
        } elseif ($makanan == "susu") {
            $hargaMakanan = 15000;
        }

        if ($aksesoris == "kalung") {
            $hargaAksesoris = 50000;
        } elseif ($aksesoris == "pakaian") {
            $hargaAksesoris = 100000;
        }

        $totalBayar = $hargaMakanan + $hargaAksesoris;
        $diskon = dapatDiskon($totalBayar);
        $totalHarga = totalHarga($diskon, $totalBayar);
        $success = true;
    }
} else {
    echo "<p>Silahkan pilih produk yang ingin dibeli.</p>";
}
?>

<h2>Belanja</h2>
<form method="POST" action="">
    <p>Daftar Kategori:</p>

    <p>Makanan dan Minuman : <br />
        <select name="makanan">
            <option value="">-- Pilih --</option>
            <option value="daging_kaleng" <?php if ($makanan == "daging_kaleng") echo "selected"; ?>>Daging Kaleng</option>
            <option value="susu" <?php if ($makanan == "susu") echo "selected"; ?>>Susu</option>
        </select>
    </p>

    <p>Aksesoris : <br />
        <select name="aksesoris">
            <option value="">-- Pilih --</option>
            <option value="kalung" <?php if ($aksesoris == "kalung") echo "selected"; ?>>Kalung</option>
            <option value="pakaian" <?php if ($aksesoris == "pakaian") echo "selected"; ?>>Pakaian</option>
        </select>
    </p>

    <button type="submit">Kirim</button>
</form>

<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>!! " . htmlspecialchars($error) . " !!</p>";
    }
}

if ($success) {
    echo "<h3>Informasi Belanja</h3>";
    echo "<p>Makanan dan Minuman: " . htmlspecialchars($makanan) . "</p>";
    echo "<p>Aksesoris: " . htmlspecialchars($aksesoris) . "</p>";
    echo "<p>Total Harga: Rp" . htmlspecialchars($totalHarga) . "</p>";
    echo "<p>Diskon: " . htmlspecialchars($diskon * 100) . "%</p>";

    if ($diskon == 0) {
        echo "<p>Maaf tidak ada diskon yang diberikan.</p>";
    } else {
        echo "<p>Selamat! Anda mendapatkan diskon " . htmlspecialchars($diskon * 100) . "%.</p>";
    }
}
?>