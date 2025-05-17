<?php
session_start();
require_once 'crud.php';
$crud = new crud('127.0.0.1', 'root', '', 'monitoringasto'); // langsung instansiasi


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['stok_file'])) {
    $file = $_FILES['stok_file']['tmp_name'];
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (!$lines || count($lines) <= 1) {
        die("File kosong atau tidak valid.");
    }

    $success = 0;
    $failed = 0;

    foreach (array_slice($lines, 1) as $line) {
        $cols = array_map('trim', explode('|', $line));

        if (count($cols) < 13) {
            $failed++;
            continue;
        }

        list($mnemonic, $old_sc, $old_pn, $new_pn, $desc, $min, $max, $oh_skk, $po, $incoming, $eta, $status, $remark) = $cols;

        // Validasi tanggal ETA
        $etaDb = (strtotime($eta) !== false) ? $eta : null;

        try {
            $crud->insert('items', [
                'mnemonic' => $mnemonic,
                'old_sc' => $old_sc,
                'old_pn' => $old_pn,
                'new_pn' => $new_pn,
                'description' => $desc,
                'status' => $status,
                'remark' => $remark
            ]);
            $item_id = $crud->getLastInsertId();

            $crud->insert('stock_levels', [
                'item_id' => $item_id,
                'min_stock' => $min,
                'max_stock' => $max,
                'oh_skk' => $oh_skk
            ]);

            $crud->insert('purchase_orders', [
                'item_id' => $item_id,
                'total_po' => $po,
                'incoming' => $incoming,
                'eta' => $etaDb
            ]);

            $success++;
        } catch (Exception $e) {
            $failed++;
        }
    }

    echo "<h3>Import selesai</h3>";
    echo "<p>Berhasil: $success</p>";
    echo "<p>Gagal: $failed</p>";
    echo '<a href="stokminimum.php" class="btn btn-success mt-3">Kembali</a>';
} else {
    echo "Upload gagal.";
}
