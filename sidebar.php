<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="d-flex flex-row mb-2 align-items-center justify-content-center">
    <img style="width: 280!important" src="./assets/src/kpp.png"/>
</div>
<div class="d-flex flex-row align-items-center justify-content-center">
    <img style="width: 60!important" src="./assets/src/ciss.png"/>
    <img style="height: 100!important" src="./assets/src/asto.png"/>
    <img style="height: 100!important" src="./assets/src/plantasto.png"/>
</div>

<ul class="list-group mt-4" style="font-size: small">
    <li class="list-group-item <?= ($current_page === 'dashboard.php') ? 'active' : '' ?>">
        <a href="./dashboard.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M21 20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V9.48907C3 9.18048 3.14247 8.88917 3.38606 8.69972L11.3861 2.47749C11.7472 2.19663 12.2528 2.19663 12.6139 2.47749L20.6139 8.69972C20.8575 8.88917 21 9.18048 21 9.48907V20ZM19 19V9.97815L12 4.53371L5 9.97815V19H19ZM7 15H17V17H7V15Z"></path></svg>
            Dashboard
        </a>
    </li>
    <?php
    if($_SESSION['role']!='2'){
        echo '
                <li class="list-group-item ';

        if($current_page === 'stockitem.php'){
            echo 'active';
        }
        else {
            echo ' ';
        }

        echo'">
                    <a href="./stockitem.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L21.5 6.5V17.5L12 23L2.5 17.5V6.5L12 1ZM5.49388 7.0777L12.0001 10.8444L18.5062 7.07774L12 3.311L5.49388 7.0777ZM4.5 8.81329V16.3469L11.0001 20.1101V12.5765L4.5 8.81329ZM13.0001 20.11L19.5 16.3469V8.81337L13.0001 12.5765V20.11Z"></path></svg>
            Stock Item
        </a>
    </li>
            ';
    }
    ?>
    <?php
        if($_SESSION['role'] != '2') {
            echo '
                <li class="list-group-item ' . (($current_page === 'spring_list.php') ? 'active' : '') . '">
                    <a href="./spring_list.php">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 3H21V5H3V3ZM3 7H21V9H3V7ZM3 11H21V13H3V11ZM3 15H21V17H3V15ZM3 19H21V21H3V19Z"/>
                        </svg>
                        Monitoring Spring
                    </a>
                </li>
               
            ';
        }
?>

    <li class="list-group-item <?= ($current_page === 'outofstock.php') ? 'active' : '' ?>">
        <a href="./outofstock.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L21.5 6.5V17.5L12 23L2.5 17.5V6.5L12 1ZM5.49388 7.0777L12.0001 10.8444L18.5062 7.07774L12 3.311L5.49388 7.0777ZM4.5 8.81329V16.3469L11.0001 20.1101V12.5765L4.5 8.81329ZM13.0001 20.11L19.5 16.3469V8.81337L13.0001 12.5765V20.11Z"></path></svg>
            Out of Stock
        </a>
    </li>
    <?php
    if($_SESSION['role']!='2'){
        echo '
                <li class="list-group-item ';

        if($current_page === 'needpenawaran.php'){
            echo 'active';
        }
        else {
            echo ' ';
        }

        echo'">
                    <a href="./needpenawaran.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L21.5 6.5V17.5L12 23L2.5 17.5V6.5L12 1ZM5.49388 7.0777L12.0001 10.8444L18.5062 7.07774L12 3.311L5.49388 7.0777ZM4.5 8.81329V16.3469L11.0001 20.1101V12.5765L4.5 8.81329ZM13.0001 20.11L19.5 16.3469V8.81337L13.0001 12.5765V20.11Z"></path></svg>
            Need Penawaran
        </a>
    </li>
            ';
    }
    ?>
    <?php
    if($_SESSION['role']!='2'){
        echo '
                <li class="list-group-item ';

        if($current_page === 'inout.php'){
            echo 'active';
        }
        else {
            echo ' ';
        }

        echo'">
                    <a href="./inout.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L21.5 6.5V17.5L12 23L2.5 17.5V6.5L12 1ZM5.49388 7.0777L12.0001 10.8444L18.5062 7.07774L12 3.311L5.49388 7.0777ZM4.5 8.81329V16.3469L11.0001 20.1101V12.5765L4.5 8.81329ZM13.0001 20.11L19.5 16.3469V8.81337L13.0001 12.5765V20.11Z"></path></svg>
            In/Out
        </a>
    </li>
            ';
    }
    ?>
    <?php
    if($_SESSION['role']!='2'){
        echo '
                <li class="list-group-item ';

        if($current_page === 'forecastoverhaul.php'){
            echo 'active';
        }
        else {
            echo ' ';
        }

        echo'">
                    <a href="./forecastoverhaul.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L21.5 6.5V17.5L12 23L2.5 17.5V6.5L12 1ZM5.49388 7.0777L12.0001 10.8444L18.5062 7.07774L12 3.311L5.49388 7.0777ZM4.5 8.81329V16.3469L11.0001 20.1101V12.5765L4.5 8.81329ZM13.0001 20.11L19.5 16.3469V8.81337L13.0001 12.5765V20.11Z"></path></svg>
            Forecast Overhaul
        </a>
    </li>
            ';
    }
    ?>
    <?php
    if($_SESSION['role']!='2'){
        echo '
                <li class="list-group-item ';

        if($current_page === 'exportdata.php'){
            echo 'active';
        }
        else {
            echo ' ';
        }

        echo'">
                    <a href="./exportdata.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M22 4C22 3.44772 21.5523 3 21 3H3C2.44772 3 2 3.44772 2 4V20C2 20.5523 2.44772 21 3 21H21C21.5523 21 22 20.5523 22 20V4ZM4 15H7.41604C8.1876 16.7659 9.94968 18 12 18C14.0503 18 15.8124 16.7659 16.584 15H20V19H4V15ZM4 5H20V13H15C15 14.6569 13.6569 16 12 16C10.3431 16 9 14.6569 9 13H4V5ZM16 11H13V14H11V11H8L12 6.5L16 11Z"></path></svg>
            Export Data
        </a>
    </li>
            ';
    }
    ?>
    <?php
    if($_SESSION['role']!='2'){
        echo '
                <li class="list-group-item ';

        if($current_page === 'listegi.php'){
            echo 'active';
        }
        else {
            echo ' ';
        }

        echo'">
                    <a href="./listegi.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M8.5 7C8.5 5.89543 7.60457 5 6.5 5C5.39543 5 4.5 5.89543 4.5 7C4.5 8.10457 5.39543 9 6.5 9C7.60457 9 8.5 8.10457 8.5 7ZM10.5 7C10.5 9.20914 8.70914 11 6.5 11C4.29086 11 2.5 9.20914 2.5 7C2.5 4.79086 4.29086 3 6.5 3C8.70914 3 10.5 4.79086 10.5 7ZM21 4H13V6H21V4ZM21 11H13V13H21V11ZM21 18H13V20H21V18ZM6.5 19C5.39543 19 4.5 18.1046 4.5 17C4.5 15.8954 5.39543 15 6.5 15C7.60457 15 8.5 15.8954 8.5 17C8.5 18.1046 7.60457 19 6.5 19ZM6.5 21C8.70914 21 10.5 19.2091 10.5 17C10.5 14.7909 8.70914 13 6.5 13C4.29086 13 2.5 14.7909 2.5 17C2.5 19.2091 4.29086 21 6.5 21ZM6.5 8C7.05228 8 7.5 7.55228 7.5 7C7.5 6.44772 7.05228 6 6.5 6C5.94772 6 5.5 6.44772 5.5 7C5.5 7.55228 5.94772 8 6.5 8Z"></path></svg>
            List EGI
        </a>
    </li>
            ';
    }
    ?>
    <li class="list-group-item <?= ($current_page === 'profile.php') ? 'active' : '' ?>">
        <a href="./profile.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H18C18 18.6863 15.3137 16 12 16C8.68629 16 6 18.6863 6 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11Z"></path></svg>
            Profile
        </a>
    </li>
    <?php
        if($_SESSION['role']=='0'){
            echo '
                <li class="list-group-item ';

            if($current_page === 'administrator.php'){
                echo 'active';
            }
            else {
                echo ' ';
            }

            echo'">
                    <a href="./administrator.php">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M3.78307 2.82598L12 1L20.2169 2.82598C20.6745 2.92766 21 3.33347 21 3.80217V13.7889C21 15.795 19.9974 17.6684 18.3282 18.7812L12 23L5.6718 18.7812C4.00261 17.6684 3 15.795 3 13.7889V3.80217C3 3.33347 3.32553 2.92766 3.78307 2.82598ZM5 4.60434V13.7889C5 15.1263 5.6684 16.3752 6.7812 17.1171L12 20.5963L17.2188 17.1171C18.3316 16.3752 19 15.1263 19 13.7889V4.60434L12 3.04879L5 4.60434ZM12 11C10.6193 11 9.5 9.88071 9.5 8.5C9.5 7.11929 10.6193 6 12 6C13.3807 6 14.5 7.11929 14.5 8.5C14.5 9.88071 13.3807 11 12 11ZM7.52746 16C7.77619 13.75 9.68372 12 12 12C14.3163 12 16.2238 13.75 16.4725 16H7.52746Z"></path></svg>
                        Administrator
                    </a>
                </li>
            ';
        }
    ?>
    <li class="list-group-item">
        <a id="logoutButton" class="sidebar-logout" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" class="me-1" viewBox="0 0 24 24" fill="currentColor"><path d="M5 22C4.44772 22 4 21.5523 4 21V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V6H18V4H6V20H18V18H20V21C20 21.5523 19.5523 22 19 22H5ZM18 16V13H11V11H18V8L23 12L18 16Z"></path></svg>
            Logout
        </a>
    </li>
</ul>
<script>
    $(document).ready(function() {
        $('#logoutButton').on('click', function () {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { action: 'logout' },
                success: function (response) {
                    if (response === 'logged_out') {
                        alert('Logged out successfully!');
                        window.location.href = 'login.php';
                    }
                }
            });
        });
    });
</script>
