<?php
session_start();
require_once 'crud.php';
$crud = new crud('127.0.0.1', 'root', '', 'monitoringasto');
$conn = $crud->getConnection(); // ambil koneksi langsung dari objek crud

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['spring_file'])) {
    $file = $_FILES['spring_file']['tmp_name'];
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $success = 0;
    $failed = 0;

    foreach ($lines as $line) {
        $parts = explode('|', $line);
        if (count($parts) !== 8) {
            $failed++;
            continue;
        }

        [$springType, $component, $scUt, $pnUt, $sohUt, $ito, $aUsage, $detailsRaw] = $parts;

        // Escaping string untuk keamanan
        $springTypeEsc = $conn->real_escape_string($springType);
        $componentEsc = $conn->real_escape_string($component);

        // Ambil ID spring type dan component
        $springTypeResult = $crud->query("SELECT id FROM spring_types WHERE kode = '$springTypeEsc'");
        $springTypeRow = $springTypeResult->fetch_assoc();
        $springTypeId = $springTypeRow['id'] ?? null;

        $componentResult = $crud->query("SELECT id FROM components WHERE nama_component = '$componentEsc'");
        $componentRow = $componentResult->fetch_assoc();
        $componentId = $componentRow['id'] ?? null;


        if (!$springTypeId || !$componentId) {
            $failed++;
            continue;
        }

        // Insert master spring item
        $crud->insert('spring_items', [
            'spring_type_id' => $springTypeId,
            'component_id' => $componentId,
            'sc_ut' => $scUt,
            'pn_ut' => $pnUt,
            'soh_ut' => $sohUt,
            'ito' => $ito,
            'a_usage' => $aUsage,
            'total_soh' => $sohUt, // sementara, akan ditambah dari detail
            'readiness' => ($sohUt > 0 ? 100 : 0)
        ]);

        $springItemId = $crud->getLastInsertId();
        $totalSoh = (int) $sohUt;

        // Insert detail rows
        $details = explode(';', $detailsRaw);
        foreach ($details as $d) {
            $cols = explode(',', $d);
            if (count($cols) !== 7) continue;

            [$scKpp, $pnSm, $sohSm, $order, $mit, $dout, $brandName] = $cols;

            $brandNameEsc = $conn->real_escape_string($brandName);
            $brandResult = $crud->query("SELECT id FROM brands WHERE nama_brand = '$brandNameEsc'");
            $brandRow = $brandResult->fetch_assoc();
            $brandId = $brandRow['id'] ?? null;
            if (!$brandId) continue;

            $crud->insert('spring_item_details', [
                'spring_item_id' => $springItemId,
                'sc_kpp' => $scKpp,
                'pn_sm' => $pnSm,
                'soh_sm' => $sohSm,
                'jumlah_order' => $order,
                'mit' => $mit,
                'd_out' => $dout,
                'brand_id' => $brandId
            ]);

            $totalSoh += (int) $sohSm;
        }

        // Update total_soh & readiness
        $totalSoh = (int) $totalSoh;
        $readiness = ($totalSoh > 0) ? 100 : 0;
        $id = (int) $springItemId;

        $crud->query("UPDATE spring_items SET total_soh = $totalSoh, readiness = $readiness WHERE id = $id");


        $success++;
    }

    echo "<h3>Import selesai</h3>";
    echo "<p>Berhasil: $success</p><p>Gagal: $failed</p>";
    echo '<a href="spring_list.php" class="btn btn-success mt-3">Kembali</a>';
} else {
    echo "Upload gagal.";
}
