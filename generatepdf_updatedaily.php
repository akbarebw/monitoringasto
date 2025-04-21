<?php
require './assets/dompdf/vendor/autoload.php'; // Autoload Composer untuk Dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// Konfigurasi Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Aktifkan jika ada CSS eksternal
$dompdf = new Dompdf($options);

// Ambil konten HTML dari file updatedailycomponent.php
ob_start();
include('updatedailycomponent.php'); // Pastikan ini adalah halaman yang ingin dirender
$html = ob_get_clean();

// Muat konten ke Dompdf
$dompdf->loadHtml($html);

// Atur ukuran halaman dan orientasi (optional)
$dompdf->setPaper('A4', 'portrait'); // Bisa diganti 'landscape'

// Render HTML menjadi PDF
$dompdf->render();

// Output PDF ke browser
$dompdf->stream("updatedailycomponent.pdf", ["Attachment" => false]); // Attachment false agar langsung ditampilkan
?>