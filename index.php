<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Anuitas</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>Kalkulator Anuitas</h2>
    <form method="post">
        <label for="modal">Modal (Rupiah):</label><br>
        <input type="number" id="modal" name="modal" required><br><br>

        <label for="bunga">Bunga (% per tahun):</label><br>
        <input type="number" id="bunga" name="bunga" step="0.01" required><br><br>

        <label for="lama">Lama Peminjaman (tahun):</label><br>
        <input type="number" id="lama" name="lama" required><br><br>

        <input type="submit" value="Hitung">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $modal = $_POST['modal'];
        $bunga = $_POST['bunga'] / 100 / 12;
        $lama = $_POST['lama'] * 12;

        $angsuran_bulan = $modal * $bunga / (1 - pow(1 + $bunga, -$lama));

        echo "<h3>Hasil Perhitungan</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Bulan Ke</th>
                    <th>Bunga Bulan Ke</th>
                    <th>Angsuran pada akhir bulan ke-</th>
                    <th>Sisa utang pada akhir bulan ke-</th>
                    <th>Anuitas</th>
                </tr>";

        $sisa_utang = $modal;

        for ($i = 1; $i <= $lama; $i++) {
            $bunga_bulan = $sisa_utang * $bunga;
            $pokok_bulan = $angsuran_bulan - $bunga_bulan;
            $sisa_utang -= $pokok_bulan;

            echo "<tr>
                    <td>$i</td>
                    <td> Rp. " . number_format($bunga_bulan, 2) . "</td>
                    <td> Rp. " . number_format($pokok_bulan, 2) . "</td>
                    <td> Rp. " . number_format(max($sisa_utang, 0), 2) . "</td>
                    <td> Rp. " . number_format($angsuran_bulan, 2) . "</td>
                  </tr>";
        }

        echo "</table>";
    }
    ?>
</body>

</html>