<h1>Informasi Alumni</h1>

<?php
// Deklarasi Variabel
$namaAlumni = "Dede Irawan"; // Nama alumni
$tahunKelulusan = 2005; // Tahun kelulusan
$statusAktif = true; // Status alumni aktif
$jumlahLulusan5Tahun = 300; // Jumlah lulusan 5 tahun terakhir
$tahunSekarang = date("Y"); // Tahun sekarang

// Operator Aritmatika
$lamaKelulusan = $tahunSekarang - $tahunKelulusan; // Lama kelulusan
$rasioAlumni = $jumlahLulusan5Tahun / 150; // Rasio alumni

// Menampilkan Lama Kelulusan
echo "<p>Lama Kelulusan: $lamaKelulusan tahun</p>";

// Operator Penugasan dan Perbandingan
$jumlahAlumni = 120; 
$jumlahAlumni += 10; // Penambahan jumlah alumni

// Cek jika jumlah alumni mencukupi untuk acara reuni
if ($jumlahAlumni >= 130) {
    echo "<p>Jumlah sudah mencukupi untuk acara reuni</p>";
}

// Operator Logika
if ($statusAktif && $lamaKelulusan <= 5) {
    echo "<p>$namaAlumni adalah alumni aktif dan lulus dalam 5 tahun terakhir.</p>";
} else {
    echo "<p>$namaAlumni adalah alumni tidak aktif atau lulus lebih dari 5 tahun yang lalu.</p>";
}

// Manipulasi String
echo "<p>Nama Lengkap: $namaAlumni</p>";
echo "<p>Nama dalam Huruf Besar: " . strtoupper($namaAlumni) . "</p>";
echo "<p>Nama dalam Huruf Kecil: " . strtolower($namaAlumni) . "</p>";

// Inisial Nama Alumni
$initials = substr($namaAlumni, 0, 1) . substr($namaAlumni, strpos($namaAlumni, " ") + 1, 1);
echo "<p>Inisial: $initials</p>";
?>
