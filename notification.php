<?php
$role = $_SESSION['role']; 
echo "<script>var userRole = $role;</script>";
?>

<script src="./assets/js/jquery.js"></script>

<style>
    /* Container untuk semua notifikasi */
    .notification-container {
        width: 600px;
        right: 20px;
        top: 20px;
        position: fixed;
        z-index: 99;
        display: flex;
        flex-direction: column;
        gap: 10px; /* Jarak antar notifikasi */
    }

    /* Kartu notifikasi */
    .notification-card {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        animation: slide-in 0.5s ease-out;
    }

    /* Animasi notifikasi masuk */
    @keyframes slide-in {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>

<script>
    $(document).ready(function () {       

        function showNotification(title, options) {
    if (Notification.permission === "granted") {
        console.log("Menampilkan notifikasi...");
        const notification = new Notification(title, options);

      
        notification.onclick = () => {
            console.log("Notifikasi diklik!");
            window.focus(); // Membawa tab ke depan (opsional)
        };

        // Menutup notifikasi setelah 5 detik (opsional)
        setTimeout(() => {
            notification.close();
            console.log("Notifikasi ditutup.");
        }, 5000);
    } else {
        console.error("Notifikasi tidak diizinkan oleh pengguna.");
    }
}

        // Fetch data dari action PHP
        $.ajax({
            url: "action.php", // URL action PHP
            type: "POST",
            data: { action: "fetchforecastoverhaulnotif" }, // Parameter untuk action PHP
            success: function (response) {
                // Parsing data JSON dari PHP
                const forecastData = response;

                // Tampilkan notifikasi berdasarkan forecastData
                const currentDate = Math.floor(Date.now() / 1000); // Epoch waktu sekarang
                const notificationsContainer = $(".notification-container");
                

                forecastData.forEach((item) => {
                    const daysRemaining = Math.ceil((item.plandate - currentDate) / 86400); // Hitung hari tersisa

                    let message = "";

                    if (daysRemaining === 30) {
                        message = `H-1 bulan ${item.codeno} ${item.schedule} ${item.component} (Plan Date: ${new Date(item.plandate * 1000).toLocaleDateString("id-ID")})`;
                    } else if (daysRemaining === 7) {
                        message = `H-1 minggu ${item.codeno} ${item.schedule} ${item.component} (Plan Date: ${new Date(item.plandate * 1000).toLocaleDateString("id-ID")})`;
                    } else if (daysRemaining >= 1 && daysRemaining <= 6) {
                        message = `H-${daysRemaining} ${item.codeno} ${item.schedule} ${item.component} (Plan Date: ${new Date(item.plandate * 1000).toLocaleDateString("id-ID")})`;
                    }

                    if (message) {
                        // Buat elemen notifikasi baru
                        const notification = $('<div class="notification-card"></div>').text(message);

                        // Tambahkan notifikasi ke container
                        notificationsContainer.append(notification);
                        
                        if (userRole != 2) {

                        showNotification("Notifikasi REMAN ASTO", {
                            body: message,
                        });

                        const sound = new Audio("./assets/src/notification.wav"); // Ganti dengan path file suara Anda
        sound.play();
                    }

                        // Hapus notifikasi setelah 10 detik
                        setTimeout(() => {
                            notification.fadeOut(1000, function() {
                                $(this).remove();
                            });
                        }, 5000);

                        
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            },
        });
    });
</script>
<?php
    if($_SESSION['role']!=2){
        echo '
<div class="notification-container"></div>';
    }
?>
