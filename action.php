<?php
    session_start();
    require_once './crud.php';

    $crud = new crud('127.0.0.1', 'root', '', 'monitoringasto'); // Update with your database credentials

    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = $crud->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['password'] = $user['password'];;
            $_SESSION['role'] = $user['role'];
            echo 'success';
        } else {
            echo 'failure';
        }
    }

    if ($action === 'logout') {
        session_destroy();
        echo 'logged_out';
    }

    if ($action == 'fetchjumlahbarang') {
        $result = $crud->query("SELECT COUNT(component) AS `total` FROM stockitem");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
            echo $row['total'];
        }
    }
    elseif ($action == 'fetchkomponenmasuk') {
        $result = $crud->query("SELECT COUNT(component) AS `total` FROM `inout` WHERE dateremove = 0");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
            echo $row['total'];
        }
    }
    elseif ($action == 'fetchkomponenkeluar') {
        $result = $crud->query("SELECT COUNT(component) AS `total` FROM `inout` WHERE dateremove != 0");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
            echo $row['total'];
        }
    }
    elseif ($action == 'fetchChartData') {
        // Inisialisasi array untuk xValues (kata kunci) dan hasilnya
        $keywords = ["TRANSMISI GRSO935", "TRANSMISI GRSO905", "PLANETARY GRSO935", "PLANETARY GRSO905", "DIFF RF RBP900", "DIFF RR RP900", "DIFF RBP835", "DIFF RP835", "FINAL DRIVE"];
        $labels = [];
        $values = [];

        // Loop untuk setiap keyword
        foreach ($keywords as $keyword) {
            // Escape string untuk menghindari potensi SQL Injection
            $escapedKeyword = $crud->escape_string($keyword);

            // Query untuk menghitung jumlah komponen yang sesuai dengan keyword
            $query = "SELECT COUNT(component) AS `total` FROM stockitem WHERE component LIKE '%$escapedKeyword%'";
            $result = $crud->query($query);
            $row = $result->fetch_assoc(); // Ambil baris hasil query

            // Tambahkan ke array
            $labels[] = $keyword; // Tambahkan keyword ke labels
            $values[] = $row['total'] ?? 0; // Tambahkan hasil count
        }

        // Kirim data sebagai JSON
        echo json_encode([
            "labels" => $labels,
            "values" => $values
        ]);

    }
    elseif ($action == 'fetchstockitem') {
        $egi = $_POST['egi'] ?? '';

        $sql = "SELECT * FROM `stockitem`";
        if (!empty($egi)) {
            $sql .= " WHERE `egi` = '" . $crud->escape_string($egi) . "'";
        }

        $result = $crud->query($sql);
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
            echo "
                 <tr data-id='{$row['id_stockitem']}'>
                    <td class='row-number'></td>
                    <td>{$row['component']}</td>
                    <td>{$row['pn']}</td>
                    <td>{$row['rfu']}</td>
                    <td><button class='edit btn btn-primary' data-id='{$row['id_stockitem']}' data-component='{$row['component']}' data-pn='{$row['pn']}' data-rfu='{$row['rfu']}' data-egi='{$row['egi']}'>Edit</button></td>
                    <td><button class='delete btn btn-danger' data-id='{$row['id_stockitem']}'>Delete</button></td>
                </tr>
            ";
        }
    }
    elseif ($action == 'insertstockitem') {
        $component = $_POST['component'];
        $pn = $_POST['pn'];
        $rfu = $_POST['rfu'];
        $egi = $_POST['egi'];

        $sql = "INSERT INTO `stockitem` (component, pn, rfu, egi) VALUES ('$component', '$pn', '$rfu', '$egi')";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'editstockitem') {
        $id = $_POST['id'];
        $component = $_POST['component'];
        $pn = $_POST['pn'];
        $rfu = $_POST['rfu'];
        $egi = $_POST['egi'];

        $sql = "UPDATE `stockitem` SET `component` = '$component', `pn` = '$pn', `rfu` = '$rfu', `egi` = '$egi' WHERE `id_stockitem` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'deletestockitem') {
        $id = $_POST['id'];

        $sql = "DELETE FROM `stockitem` WHERE `id_stockitem` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'fetchoutofstock') {
        $result = $crud->query("SELECT * FROM outofstock");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
            $etaNormal = date("d/m/Y", $row['eta']);
            $etaInput = date("Y-m-d", $row['eta']);
            echo "
                <tr data-id='{$row['id_outofstock']}'>
                    <td class='row-number'></td>
                    <td>{$row['component']}</td>
                    <td>{$row['pn']}</td>
                    <td>{$row['apl']}</td>
                    <td>{$row['qty']}</td>
                    <td>{$row['stokkpp']}</td>
                    <td>{$row['feedbackut']}</td>
                    <td>{$row['wr']}</td>
                    <td>{$etaNormal}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['remark']}</td>
                    <td><button class='edit btn btn-primary' data-id='{$row['id_outofstock']}' data-component='{$row['component']}' data-pn='{$row['pn']}' data-apl='{$row['apl']}' data-qty='{$row['qty']}' data-stokkpp='{$row['stokkpp']}' data-feedbackut='{$row['feedbackut']}' data-wr='{$row['wr']}' data-eta='{$etaInput}' data-status='{$row['status']}' data-remark='{$row['remark']}'>Edit</button></td>
                    <td><button class='delete btn btn-danger' data-id='{$row['id_outofstock']}'>Delete</button></td>
                </tr>
            ";
        }
    }
    elseif ($action == 'insertoutofstock') {
        $component = $_POST['component'];
        $pn = $_POST['pn'];
        $apl = $_POST['apl'];
        $qty = $_POST['qty'];
        $stokkpp = $_POST['stokkpp'];
        $feedbackut = $_POST['feedbackut'];
        $wr = $_POST['wr'];
        $eta = strtotime($_POST['eta']);
        $status = $_POST['status'];
        $remark = $_POST['remark'];

        $sql = "INSERT INTO `outofstock` (component, pn, apl, qty, stokkpp, feedbackut, wr, eta, status, remark) VALUES ('$component', '$pn', '$apl', '$qty', '$stokkpp', '$feedbackut', '$wr', '$eta', '$status', '$remark')";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'editoutofstock') {
        $id = $_POST['id'];
        $component = $_POST['component'];
        $pn = $_POST['pn'];
        $apl = $_POST['apl'];
        $qty = $_POST['qty'];
        $stokkpp = $_POST['stokkpp'];
        $feedbackut = $_POST['feedbackut'];
        $wr = $_POST['wr'];
        $eta = strtotime($_POST['eta']);
        $status = $_POST['status'];
        $remark = $_POST['remark'];

        $sql = "UPDATE `outofstock` SET `component` = '$component', `pn` = '$pn', `apl` = '$apl', `qty` = '$qty', `stokkpp` = '$stokkpp', `feedbackut` = '$feedbackut', `wr` = '$wr', `eta` = '$eta', `status` = '$status', `remark` = '$remark' WHERE `id_outofstock` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'deleteoutofstock') {
        $id = $_POST['id'];

        $sql = "DELETE FROM `outofstock` WHERE `id_outofstock` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'fetchforecastoverhaul') {
        $result = $crud->query("SELECT * FROM forecastoverhaul");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
            $periodNormal = date("F Y", $row['period']);
            $periodInput = date("Y-m", $row['period']);
            if($row['plandate']!=0){
                $plandateNormal = date("d/m/Y", $row['plandate']);
            }
            else {
                $plandateNormal = '';
            }
            $plandateInput = date("Y-m-d", $row['plandate']);
            echo "
                <tr data-id='{$row['id_forecastoverhaul']}'>
                    <td class='row-number'></td>
                    <td>{$row['schedule']}</td>
                    <td>{$periodNormal}</td>
                    <td>{$row['workorder']}</td>
                    <td>{$row['egi']}</td>
                    <td>{$row['codeno']}</td>
                    <td>{$row['sn']}</td>
                    <td>{$row['lokasi']}</td>
                    <td>{$row['component']}</td>
                    <td>{$row['type']}</td>
                    <td>{$plandateNormal}</td>
                    <td>{$row['planhm']}</td>
                    <td>{$row['wrpart']}</td>
                    <td>{$row['supplyby']}</td>
                    <td>{$row['status']}</td>
                    <td><button class='edit btn btn-primary' data-id='{$row['id_forecastoverhaul']}' data-schedule='{$row['schedule']}' data-period='{$periodInput}' data-workorder='{$row['workorder']}' data-egi='{$row['egi']}' data-codeno='{$row['codeno']}' data-sn='{$row['sn']}' data-lokasi='{$row['lokasi']}' data-component='{$row['component']}' data-type='{$row['type']}' data-plandate='{$plandateInput}' data-planhm='{$row['planhm']}' data-wrpart='{$row['wrpart']}' data-supplyby='{$row['supplyby']}' data-status='{$row['status']}'>Edit</button></td>
                    <td><button class='delete btn btn-danger' data-id='{$row['id_forecastoverhaul']}'>Delete</button></td>
                </tr>
            ";
        }
    }
    elseif ($action == 'fetchforecastoverhaulnotif') {
        header('Content-Type: application/json');
        $result = $crud->query("SELECT * FROM forecastoverhaul");
        $data = $crud->fetchAll($result);
    
        $forecastData = [];
    
        foreach ($data as $row) {
            $forecastData[] = [
                "component" => $row['component'],
                "egi" => $row['egi'],
                "codeno" => $row['codeno'],
                "schedule" => $row['schedule'],
                "plandate" => $row['plandate'], // Sudah dalam format epoch 10 digit
            ];
        }
    
        // Kirim data sebagai JSON
        echo json_encode($forecastData);
        exit;
    }    
    elseif ($action == 'insertforecastoverhaul') {
        $schedule = $_POST['schedule'];
        $period = strtotime($_POST['period']);
        $workorder = $_POST['workorder'];
        $egi = $_POST['egi'];
        $codeno = $_POST['codeno'];
        $sn = $_POST['sn'];
        $lokasi = $_POST['lokasi'];
        $component = $_POST['component'];
        $type = $_POST['type'];
        $plandate = strtotime($_POST['plandate']);
        $planhm = $_POST['planhm'];
        $wrpart = $_POST['wrpart'];
        $supplyby = $_POST['supplyby'];
        $status = $_POST['status'];

        $sql = "INSERT INTO `forecastoverhaul` (schedule, period, workorder, egi, codeno, sn, lokasi, component, type, plandate, wrpart, supplyby, status, planhm) VALUES ('$schedule', '$period', '$workorder', '$egi', '$codeno', '$sn', '$lokasi', '$component', '$type', '$plandate', '$wrpart', '$supplyby', '$status', '$planhm')";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'editforecastoverhaul') {
        $id = $_POST['id'];
        $schedule = $_POST['schedule'];
        $period = strtotime($_POST['period']);
        $workorder = $_POST['workorder'];
        $egi = $_POST['egi'];
        $codeno = $_POST['codeno'];
        $sn = $_POST['sn'];
        $lokasi = $_POST['lokasi'];
        $component = $_POST['component'];
        $type = $_POST['type'];
        $plandate = strtotime($_POST['plandate']);
        $planhm = $_POST['planhm'];
        $wrpart = $_POST['wrpart'];
        $supplyby = $_POST['supplyby'];
        $status = $_POST['status'];

        $sql = "UPDATE `forecastoverhaul` SET `schedule` = '$schedule', `period` = '$period', `workorder` = '$workorder', `egi` = '$egi', `codeno` = '$codeno', `sn` = '$sn', `lokasi` = '$lokasi', `component` = '$component', `type` = '$type', `plandate` = '$plandate', `wrpart` = '$wrpart', `supplyby` = '$supplyby', `status` = '$status', `planhm` = '$planhm'  WHERE `id_forecastoverhaul` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'deleteforecastoverhaul') {
        $id = $_POST['id'];

        $sql = "DELETE FROM `forecastoverhaul` WHERE `id_forecastoverhaul` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'fetchneedpenawaran') {
        $result = $crud->query("SELECT * FROM needpenawaran");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
            $etaNormal = date("d/m/Y", $row['eta']);
            $etaInput = date("Y-m-d", $row['eta']);
            echo "
                <tr data-id='{$row['id_needpenawaran']}'>
                    <td class='row-number'></td>
                    <td>{$row['item']}</td>
                    <td>{$row['pn']}</td>
                    <td>{$row['keperluan']}</td>
                    <td>{$row['qty']}</td>
                    <td>{$row['req']}</td>
                    <td>{$row['pr']}</td>
                    <td>{$etaNormal}</td>
                    <td>{$row['status']}</td>
                    <td><button class='foto btn btn-success' data-id='{$row['id_needpenawaran']}'>Foto</button></td>
                    <td><button class='edit btn btn-primary' data-id='{$row['id_needpenawaran']}' data-item='{$row['item']}' data-pn='{$row['pn']}' data-keperluan='{$row['keperluan']}' data-qty='{$row['qty']}' data-req='{$row['req']}' data-pr='{$row['pr']}' data-eta='{$etaInput}' data-status='{$row['status']}'>Edit</button></td>
                    <td><button class='delete btn btn-danger' data-id='{$row['id_needpenawaran']}'>Delete</button></td>
                </tr>
            ";
        }
    }
    elseif ($action == 'insertneedpenawaran') {
        $item = $_POST['item'];
        $pn = $_POST['pn'];
        $keperluan = $_POST['keperluan'];
        $qty = $_POST['qty'];
        $req = $_POST['req'];
        $pr = $_POST['pr'];
        $eta = strtotime($_POST['eta']);
        $status = $_POST['status'];

        $sql = "INSERT INTO `needpenawaran` (item, pn, keperluan, qty, req, pr, eta, `status`) VALUES ('$item', '$pn', '$keperluan', '$qty', '$req', '$pr', '$eta', '$status')";
        //$sql = "INSERT INTO `needpenawaran` (item) VALUES ('$item')";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'editneedpenawaran') {
        $id = $_POST['id'];
        $item = $_POST['item'];
        $pn = $_POST['pn'];
        $keperluan = $_POST['keperluan'];
        $qty = $_POST['qty'];
        $req = $_POST['req'];
        $pr = $_POST['pr'];
        $eta = strtotime($_POST['eta']);
        $status = $_POST['status'];

        $sql = "UPDATE `needpenawaran` SET `item` = '$item', `pn` = '$pn', `keperluan` = '$$keperluan', `qty` = '$qty', `req` = '$req', `pr` = '$pr', `eta` = '$eta', `status` = '$status' WHERE `id_needpenawaran` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'deleteneedpenawaran') {
        $id = $_POST['id'];

        $sql = "DELETE FROM `needpenawaran` WHERE `id_needpenawaran` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'getFotoneedpenawaran') {
        $id = $_POST['id']; // Ambil ID dari request

        // Ambil nama file foto berdasarkan ID dari database
        $sql = "SELECT `foto` FROM `needpenawaran` WHERE `id_needpenawaran` = '$id'";
        $result = $crud->query($sql);
        $row = $result->fetch_assoc();

        if ($row && !empty($row['foto'])) {
            echo $row['foto']; // Kirim nama file foto sebagai respons
        } else {
            echo ''; // Jika tidak ada foto, kirim respons kosong
        }
    }
    elseif ($action == 'insertfotoneedpenawaran') {
        $id = $_POST['id'];
        if (!empty($_FILES['foto']['name'])) {
            $fileName = $_FILES['foto']['name'];
            $fileTmp = $_FILES['foto']['tmp_name'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExt = ['png', 'jpg', 'jpeg'];

            if (in_array($fileExt, $allowedExt)) {
                $newFileName = uniqid() . '.' . $fileExt; // Nama file unik
                $uploadPath = "assets/user/needpenawaran/$newFileName";

                if (move_uploaded_file($fileTmp, $uploadPath)) {
                    // Update database dengan nama file
                    $sql = "UPDATE `needpenawaran` SET `foto` = '$newFileName' WHERE `id_needpenawaran` = '$id'";
                    $crud->query($sql);
                    echo 'Success: File uploaded and record updated.';
                } else {
                    echo 'Error: File upload failed.';
                }
            } else {
                echo 'Error: Invalid file type.';
            }
        } else {
            echo 'Error: No file selected.';
        }
    }
    elseif ($action == 'fetchinout') {
        $result = $crud->query("SELECT * FROM `inout`");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
            //$dateRemoveNormal = date("d/m/Y", $row['dateremove']);
            $dateRemoveInput = date("Y-m-d", $row['dateremove']);
            if($row['dateinstall']>0){
                $dateInstallNormal = date("d/m/Y", $row['dateinstall']);
            }
            else {
                $dateInstallNormal = '';
            }
            if($row['dateremove']>0){
                $dateRemoveNormal = date("d/m/Y", $row['dateremove']);
            }
            else {
                $dateRemoveNormal = '';
            }
            $dateInstallInput = date("Y-m-d", $row['dateinstall']);
            echo "
                <tr data-id='{$row['id_inout']}'>
                    <td class='row-number'></td>
                    <td>{$row['egi']}</td>
                    <td>{$row['component']}</td>
                    <td>{$row['exunit']}</td>
                    <td>{$dateRemoveNormal}</td>
                    <td>{$row['pn']}</td>
                    <td>{$dateInstallNormal}</td>
                    <td>{$row['installto']}</td>
                    <td>{$row['hourmeter']}</td>
                    <td>{$row['mpovh']}</td>
                    <td>{$row['mpins']}</td>
                    <td>{$row['remaks']}</td>
                    <td>{$row['status']}</td>
                    <td><button class='foto btn btn-success' data-id='{$row['id_inout']}'>Foto</button></td>
                    <td><button class='edit btn btn-primary' data-id='{$row['id_inout']}' data-egi='{$row['egi']}' data-component='{$row['component']}' data-exunit='{$row['exunit']}' data-dateremove='{$dateRemoveInput}' data-pn='{$row['pn']}' data-dateinstall='{$dateInstallInput}' data-installto='{$row['installto']}' data-hourmeter='{$row['hourmeter']}' data-mpovh='{$row['mpovh']}' data-mpins='{$row['mpins']}' data-remarks='{$row['remaks']}' data-status='{$row['status']}''>Edit</button></td>
                    <td><button class='delete btn btn-danger' data-id='{$row['id_inout']}'>Delete</button></td>
                </tr>
            ";
        }
    }
    elseif ($action == 'insertinout') {
        $egi = $_POST['egi'];
        $component = $_POST['component'];
        $pn = $_POST['pn'];
        $installto = $_POST['installto'];
        $exunit = $_POST['removefrom'];
        //$dateremove = strtotime($_POST['dateremove']);
        //$dateinstall = strtotime($_POST['dateinstall']);
        $hourmeter = $_POST['hourmeter'];
        $mpovh = $_POST['mpovh'];
        $mpins = $_POST['mpins'];
        $remarks = $_POST['remarks'];
        $status = $_POST['status'];
        if($_POST['dateremove']===0||$_POST['dateremove']==='0'||$_POST['dateremove']==="1970-01-01"){
            $dateremove = '0';
        }
        else{
            $dateremove = strtotime($_POST['dateremove']);
        }
        if($_POST['dateinstall']===0||$_POST['dateinstall']==='0'||$_POST['dateinstall']==="1970-01-01"){
            $dateinstall = '0';
        }
        else{
            $dateinstall = strtotime($_POST['dateinstall']);
        }
        $sql = "INSERT INTO `inout` (egi, component, pn, installto, exunit, dateremove, dateinstall, hourmeter, mpovh, mpins, remaks, `status`) VALUES ('$egi', '$component', '$pn', '$installto', '$exunit', '$dateremove', '$dateinstall', '$hourmeter', '$mpovh', '$mpins', '$remarks', '$status')";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'editinout') {
        $id = $_POST['id'];
        $egi = $_POST['egi'];
        $component = $_POST['component'];
        $pn = $_POST['pn'];
        $installto = $_POST['installto'];
        $exunit = $_POST['removefrom'];
        //$dateremove = strtotime($_POST['dateremove']);
        //$dateinstall = strtotime($_POST['dateinstall']);
        $hourmeter = $_POST['hourmeter'];
        $mpovh = $_POST['mpovh'];
        $mpins = $_POST['mpins'];
        $remarks = $_POST['remarks'];
        $status = $_POST['status'];
        if($_POST['dateremove']===0||$_POST['dateremove']==='0'||$_POST['dateremove']==="1970-01-01"){
            $dateremove = '0';
        }
        else{
            $dateremove = strtotime($_POST['dateremove']);
        }
        if($_POST['dateinstall']===0||$_POST['dateinstall']==='0'||$_POST['dateinstall']==="1970-01-01"){
            $dateinstall = '0';
        }
        else{
            $dateinstall = strtotime($_POST['dateinstall']);
        }

        $sql = "UPDATE `inout` SET `egi` = '$egi', `component` = '$component', `pn` = '$pn', `installto` = '$installto', `exunit` = '$exunit', `dateremove` = '$dateremove', `dateinstall` = '$dateinstall', `hourmeter` = '$hourmeter', `mpovh` = '$mpovh', `mpins` = '$mpins', `remaks` = '$remarks', `status` = '$status' WHERE `id_inout` = '$id'";
        //$sql = "UPDATE `inout` SET `dateremove` = '$dateremove' WHERE `id_inout` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'deleteinout') {
        $id = $_POST['id'];

        $sql = "DELETE FROM `inout` WHERE `id_inout` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'getFotoinout') {
        $id = $_POST['id']; // Ambil ID dari request

        // Ambil nama file foto berdasarkan ID dari database
        $sql = "SELECT `foto` FROM `inout` WHERE `id_inout` = '$id'";
        $result = $crud->query($sql);
        $row = $result->fetch_assoc();

        if ($row && !empty($row['foto'])) {
            echo $row['foto']; // Kirim nama file foto sebagai respons
        } else {
            echo ''; // Jika tidak ada foto, kirim respons kosong
        }
    }
    elseif ($action == 'insertfotoinout') {
        $id = $_POST['id'];
        if (!empty($_FILES['foto']['name'])) {
            $fileName = $_FILES['foto']['name'];
            $fileTmp = $_FILES['foto']['tmp_name'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExt = ['png', 'jpg', 'jpeg'];

            if (in_array($fileExt, $allowedExt)) {
                $newFileName = uniqid() . '.' . $fileExt; // Nama file unik
                $uploadPath = "assets/user/inout/$newFileName";

                if (move_uploaded_file($fileTmp, $uploadPath)) {
                    // Update database dengan nama file
                    $sql = "UPDATE `inout` SET `foto` = '$newFileName' WHERE `id_inout` = '$id'";
                    $crud->query($sql);
                    echo 'Success: File uploaded and record updated.';
                } else {
                    echo 'Error: File upload failed.';
                }
            } else {
                echo 'Error: Invalid file type.';
            }
        } else {
            echo 'Error: No file selected.';
        }
    }
    elseif ($action == 'insertuser') {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $password = '123';
        $role = $_POST['role'];

        $sql = "INSERT INTO `user` (username, name, password, role) VALUES ('$username', '$name', '$password', '$role')";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'fetchuser') {
        $result = $crud->query("SELECT * FROM `user`");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
            switch ($row['role']){
                case 0 :
                    $role = 'Administrator';
                    break;
                case 1 :
                    $role = 'KPP';
                    break;
                case 2 :
                    $role = 'UTVH';
                    break;
            }
            echo "
                <tr data-id='{$row['id_user']}'>
                    <td class='row-number'></td>
                    <td>{$row['username']}</td>
                    <td>{$row['name']}</td>
                    <td>$role</td>
            ";

            if($row['role']==0){
                echo "
                    <td><button class='btn btn-secondary' disabled>ROLE</button></td>
                    <td><button class='btn btn-secondary' disabled>RESET</button></td>
                    <td><button class='btn btn-secondary' disabled>DELETE</button></td>
                ";
            }
            else {
                echo "
                    <td><button class='role btn btn-primary' data-id='{$row['id_user']}' data-username='{$row['username']}' data-role='{$row['role']}'>ROLE</button></td>
                    <td><button class='reset btn btn-danger' data-id='{$row['id_user']}' data-username='{$row['username']}'>RESET</button></td>
                    <td><button class='delete btn btn-danger' data-id='{$row['id_user']}' data-username='{$row['username']}'>DELETE</button></td>
                    ";
            }

            echo "
                </tr>
            ";
        }
    }
    elseif ($action == 'resetuser') {
        $id = $_POST['id'];

        $sql = "UPDATE `user` SET `password` = '123' WHERE `id_user` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'deleteuser') {
        $id = $_POST['id'];

        $sql = "DELETE FROM `user` WHERE `id_user` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'roleuser') {
        $id = intval($_POST['id']);
        $role = intval($_POST['role']);

        $sql = "UPDATE `user` SET `role` = $role WHERE `id_user` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'fetchupdatedailycomponent') {
        $sql = "SELECT * FROM stockitem ORDER BY egi, id_stockitem";
        $result = $crud->query($sql);
        $data = $crud->fetchAll($result);

        echo json_encode($data);
    }
    elseif ($action == 'editpassword') {
        $id = intval($_POST['id']);
        $password = $_POST['password'];

        $sql = "UPDATE `user` SET `password` = '$password' WHERE `id_user` = '$id'";
        $crud->query($sql);
        echo 'Success';
        session_destroy();
    }
    elseif ($action == 'fetchlistegi') {
        $sql = "SELECT * FROM `list_egi`";
        $result = $crud->query($sql);
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
            echo "
                 <tr data-id='{$row['id_listegi']}'>
                    <td class='row-number'></td>
                    <td>{$row['egi']}</td>
                    <td><button class='edit btn btn-primary' data-id='{$row['id_listegi']}' data-egi='{$row['egi']}'>Edit</button></td>
                    <td><button class='delete btn btn-danger' data-id='{$row['id_listegi']}'>Delete</button></td>
                </tr>
            ";
        }
    }
    elseif ($action == 'fetchlistegidropdown') {
        $sql = "SELECT * FROM `list_egi`";
        $result = $crud->query($sql);
        $data = $crud->fetchAll($result);
        echo '
        <li>
                                <input type="text" class="form-control" id="dropdownSearch" onkeyup="filterDropdown(this)" placeholder="Search...">
                            </li>
        ';
        foreach ($data as $row) {
            $egi = addslashes($row['egi']);
            echo "
            <li><a class='dropdown-item' href='#' onclick='selectEgi(\"{$egi}\")'>{$row['egi']}</a></li>
            ";
        }
    }
    elseif ($action == 'fetchlistegidropdownsearch') {
        $sql = "SELECT * FROM `list_egi`";
        $result = $crud->query($sql);
        $data = $crud->fetchAll($result);
        echo '
        <li>
                                        <input type="text" class="form-control" id="dropdownSearch" onkeyup="filterDropdown(this)" placeholder="Search...">
                                    </li>
        ';
        foreach ($data as $row) {
            $egi = addslashes($row['egi']);
            echo "
            <li><a class='dropdown-item egi-item' href='#'>{$egi}</a></li>
            ";
        }
    }
    elseif ($action == 'insertlistegi') {
        $egi = $_POST['egi'];

        $sql = "INSERT INTO `list_egi` (egi) VALUES ('$egi')";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'editlistegi') {
        $id = $_POST['id'];
        $egi = $_POST['egi'];

        $sql = "UPDATE `list_egi` SET `egi` = '$egi' WHERE `id_listegi` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    elseif ($action == 'deletelistegi') {
        $id = $_POST['id'];

        $sql = "DELETE FROM `list_egi` WHERE `id_listegi` = '$id'";
        $crud->query($sql);
        echo 'Success';
    }
    if ($action === 'fetchspringitems') {
        $sql = "SELECT si.*, st.kode AS tipe, c.nama_component, b.nama_brand
                FROM spring_items si
                JOIN spring_types st ON si.spring_type_id = st.id
                JOIN components c ON si.component_id = c.id
                JOIN brands b ON si.brand_id = b.id";
    
        $result = $crud->query($sql);
        $data = $crud->fetchAll($result);
    
        foreach ($data as $row) {
            $percent = ($row['a_usage'] > 0) ? min(100, round((($row['total_soh'] - $row['mit']) / $row['a_usage']) * 100)) : 0;
            $badgeClass = ($percent >= 100) ? 'bg-success' : 'bg-danger';

            echo "<tr data-id='{$row['id']}'>
                <td></td>
                <td data-springtypeid='{$row['spring_type_id']}'>{$row['tipe']}</td>
                <td data-componentid='{$row['component_id']}'>{$row['nama_component']}</td>
                <td data-brandid='{$row['brand_id']}'>{$row['nama_brand']}</td>
                <td>{$row['sc_kpp']}</td>
                <td>{$row['pn_sm']}</td>
                <td>{$row['sc_ut']}</td>
                <td>{$row['pn_ut']}</td>
                <td>{$row['soh_sm']}</td>
                <td>{$row['soh_ut']}</td>
                <td>{$row['total_soh']}</td>
                <td>{$row['ito']}</td>
                <td>{$row['jumlah_order']}</td>
                <td>{$row['mit']}</td>
                <td>{$row['d_out']}</td>
                <td>{$row['a_usage']}</td>
                <td><span class='badge $badgeClass'>{$percent}%</span></td>
                <td><button class='edit btn btn-primary' data-id='{$row['id']}'>Edit</button></td>
                <td><button class='delete btn btn-danger' data-id='{$row['id']}'>Delete</button></td>
            </tr>";
        }
    }
    
    elseif ($action === 'insertspringitem') {
        $soh_sm = $_POST['soh_sm'];
        $soh_ut = $_POST['soh_ut'];
        $total_soh = $soh_sm + $soh_ut;
        $mit = $_POST['mit'];
        $a_usage = $_POST['a_usage'];
        $readiness = ($a_usage > 0) ? min(100, round((($total_soh - $mit) / $a_usage) * 100)) : 0;
    
        $data = [
            'spring_type_id' => $_POST['spring_type_id'],
            'component_id' => $_POST['component_id'],
            'brand_id' => $_POST['brand_id'],
            'sc_kpp' => $_POST['sc_kpp'],
            'pn_sm' => $_POST['pn_sm'],
            'sc_ut' => $_POST['sc_ut'],
            'pn_ut' => $_POST['pn_ut'],
            'soh_sm' => $soh_sm,
            'soh_ut' => $soh_ut,
            'total_soh' => $total_soh,
            'ito' => $_POST['ito'],
            'jumlah_order' => $_POST['jumlah_order'],
            'mit' => $mit,
            'd_out' => $_POST['d_out'],
            'a_usage' => $a_usage,
            'readiness' => round($readiness)
        ];
        $crud->insert('spring_items', $data);
        echo 'Success';
    }
    
    elseif ($action === 'editspringitem') {
        $id = $_POST['id'];
        $soh_sm = $_POST['soh_sm'];
        $soh_ut = $_POST['soh_ut'];
        $total_soh = $soh_sm + $soh_ut;
        $mit = $_POST['mit'];
        $a_usage = $_POST['a_usage'];
        $readiness = ($a_usage > 0) ? min(100, round((($total_soh - $mit) / $a_usage) * 100)) : 0;

    
        $data = [
            'spring_type_id' => $_POST['spring_type_id'],
            'component_id' => $_POST['component_id'],
            'brand_id' => $_POST['brand_id'],
            'sc_kpp' => $_POST['sc_kpp'],
            'pn_sm' => $_POST['pn_sm'],
            'sc_ut' => $_POST['sc_ut'],
            'pn_ut' => $_POST['pn_ut'],
            'soh_sm' => $soh_sm,
            'soh_ut' => $soh_ut,
            'total_soh' => $total_soh,
            'ito' => $_POST['ito'],
            'jumlah_order' => $_POST['jumlah_order'],
            'mit' => $mit,
            'd_out' => $_POST['d_out'],
            'a_usage' => $a_usage,
            'readiness' => round($readiness)
        ];
        $crud->update('spring_items', $data, "id = '$id'");
        echo 'Success';
    }
    
    elseif ($action === 'deletespringitem') {
        $id = $_POST['id'];
        $crud->delete('spring_items', "id = '$id'");
        echo 'Success';
    }
    if ($action === 'insertSpringType') {
        $name = $crud->escape_string($_POST['name']);
        $crud->query("INSERT INTO spring_types (kode) VALUES ('$name')");
        echo 'success';
      }
      
      if ($action === 'insertComponent') {
        $name = $crud->escape_string($_POST['name']);
        $crud->query("INSERT INTO components (nama_component) VALUES ('$name')");
        echo 'success';
      }
      
      if ($action === 'insertBrand') {
        $name = $crud->escape_string($_POST['name']);
        $crud->query("INSERT INTO brands (nama_brand) VALUES ('$name')");
        echo 'success';
      }
      
      if ($action === 'fetchSpringTypes') {
        $result = $crud->query("SELECT * FROM spring_types ORDER BY kode ASC");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
          echo "<option value='{$row['id']}'>{$row['kode']}</option>";
        }
      }
      
      if ($action === 'fetchComponents') {
        $result = $crud->query("SELECT * FROM components ORDER BY nama_component ASC");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
          echo "<option value='{$row['id']}'>{$row['nama_component']}</option>";
        }
      }
      
      if ($action === 'fetchBrands') {
        $result = $crud->query("SELECT * FROM brands ORDER BY nama_brand ASC");
        $data = $crud->fetchAll($result);
        foreach ($data as $row) {
          echo "<option value='{$row['id']}'>{$row['nama_brand']}</option>";
        }
      }

      if ($_POST['action'] === 'fetchBrandsTable') {
        $brands = $crud->query("SELECT * FROM brands ORDER BY id DESC");
        foreach ($brands as $index => $b) {
          echo "<tr>
            <td>" . ($index + 1) . "</td>
            <td>{$b['nama_brand']}</td>
            <td>
              <button class='btn btn-sm btn-warning btn-edit-brand' data-id='{$b['id']}' data-name='{$b['nama_brand']}'>Edit</button>
             <button class='btn btn-danger btn-sm btn-delete-brand' data-id='{$b['id']}'>Delete</button>

            </td>
          </tr>";
        }
        exit;
      }
      
      // Tambah brand
      if ($_POST['action'] === 'insertBrand') {
        $name = trim($_POST['name']);
    
        // Cek apakah nama brand sudah ada
        $stmt = $conn->prepare("SELECT COUNT(*) FROM brands WHERE nama_brand = ?");
        $stmt->execute([$name]);
        $exists = $stmt->fetchColumn();
    
        if ($exists > 0) {
            echo "Duplicate";
            return;
        }
    
        $stmt = $conn->prepare("INSERT INTO brands (nama_brand) VALUES (?)");
        if ($stmt->execute([$name])) {
            echo "Success";
        } else {
            echo "Failed";
        }
    }
    
      // Update brand
      if ($_POST['action'] === 'updateBrand') {
        $id = intval($_POST['id']);
        $name = addslashes($_POST['name']);
        $crud->query("UPDATE brands SET nama_brand = '$name' WHERE id = $id");
        exit('Success');
    }
    
    
      // Hapus brand
      if ($_POST['action'] === 'deleteBrand') {
        $id = intval($_POST['id']); // pastikan id berupa angka
        $crud->query("DELETE FROM brands WHERE id = $id");
        exit('Success');
    }
    // Fetch komponen untuk tabel
    if ($_POST['action'] === 'fetchComponentsForTable') {
        $components = $crud->query("SELECT * FROM components ORDER BY id DESC");
        foreach ($components as $index => $c) {
            echo "<tr>
                <td>" . ($index + 1) . "</td>
                <td>{$c['nama_component']}</td>
                <td>
                    <button class='btn btn-sm btn-warning btn-edit-component' data-id='{$c['id']}' data-name='{$c['nama_component']}'>Edit</button>
                    <button class='btn btn-sm btn-danger btn-delete-component' data-id='{$c['id']}'>Delete</button>
                </td>
            </tr>";
        }
        exit;
    }
    
  
  // Tambah Komponen
  if ($_POST['action'] === 'insertComponentWithValidation') {
    $name = trim($_POST['name']);

    // Validasi nama kosong
    if (empty($name)) {
        exit("Empty");
    }

    // Cek duplikat
    $result = $crud->query("SELECT COUNT(*) AS total FROM components WHERE nama_component = '$name'");
    $row = $result ? $result->fetch_assoc() : ['total' => 0];

    if ($row['total'] > 0) {
        exit("Duplicate");
    }

    // Insert komponen
    $insert = $crud->query("INSERT INTO components (nama_component) VALUES ('$name')");
    if ($insert) {
        exit("Success");
    } else {
        exit("Failed");
    }
}

if ($_POST['action'] === 'updateComponentWithValidation') {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);

    // Validasi
    if (empty($name)) {
        exit('Empty');
    }

    // Cek duplikat dengan pengecualian ID saat ini
    $result = $crud->query("SELECT COUNT(*) AS total FROM components WHERE nama_component = '$name' AND id != $id");
    $row = $result ? $result->fetch_assoc() : ['total' => 0];

    if ($row['total'] > 0) {
        exit("Duplicate");
    }

    // Update
    $update = $crud->query("UPDATE components SET nama_component = '$name' WHERE id = $id");
    if ($update) {
        exit("Success");
    } else {
        exit("Failed");
    }
}
  
  // Hapus Komponen
  if ($_POST['action'] === 'deleteComponent') {
    $id = intval($_POST['id']);
    $crud->query("DELETE FROM components WHERE id = $id");
    exit('Success');
  }
  
  if ($_POST['action'] === 'fetchSpringTypesTable') {
    $springTypes = $crud->query("SELECT * FROM spring_types ORDER BY id DESC");
    foreach ($springTypes as $index => $s) {
        echo "<tr>
            <td>" . ($index + 1) . "</td>
            <td>{$s['kode']}</td>
            <td>
              <button class='btn btn-sm btn-warning btn-edit-springtype' data-id='{$s['id']}' data-name='{$s['kode']}'>Edit</button>
              <button class='btn btn-sm btn-danger btn-delete-springtype' data-id='{$s['id']}'>Delete</button>
            </td>
        </tr>";
    }
    exit;
}

if ($_POST['action'] === 'insertSpringTypeWithValidation') {
    $name = trim($_POST['name']);
    if (empty($name)) exit("Empty");

    $check = $crud->query("SELECT COUNT(*) AS total FROM spring_types WHERE kode = '$name'");
    $row = $check->fetch_assoc();
    if ($row['total'] > 0) exit("Duplicate");

    $insert = $crud->query("INSERT INTO spring_types (kode) VALUES ('$name')");
    echo $insert ? "Success" : "Failed";
    exit;
}

if ($_POST['action'] === 'updateSpringTypeWithValidation') {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    if (empty($name)) exit("Empty");

    $check = $crud->query("SELECT COUNT(*) AS total FROM spring_types WHERE kode = '$name' AND id != $id");
    $row = $check->fetch_assoc();
    if ($row['total'] > 0) exit("Duplicate");

    $update = $crud->query("UPDATE spring_types SET kode = '$name' WHERE id = $id");
    echo $update ? "Success" : "Failed";
    exit;
}

if ($_POST['action'] === 'deleteSpringType') {
    $id = intval($_POST['id']);
    $crud->query("DELETE FROM spring_types WHERE id = $id");
    exit('Success');
}

?>
