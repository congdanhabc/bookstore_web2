<?php
session_start();
include('../../html/db/connect.php');

// Lấy username từ session
$username = $_SESSION['username'] ?? null;

if (!$username) {
    header('Location: ../html/index.php?quanly=taikhoan');
    exit();
}

// Truy vấn role từ database
$result = $con->query("SELECT role FROM user WHERE username = '$username'");
$user = $result->fetch_array();

if (!$user || !in_array($user['role'], ['admin', 'nhanvien'])) {
    header('Location: ../html/index.php?quanly=taikhoan');
    exit();
}

// Gán role vào session
$_SESSION['role'] = $user['role'];

?>

<style>
    .main {
        background: oklch(97% 0 0) !important;
    }

    .topbar {
        width: 100% !important;
        height: 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
    }

    .user_name {
        padding-right: 10px;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        white-space: nowrap;
        font-weight: 500;
    }

    .user {
        margin-right: 65px;
        justify-content: center;
        overflow: unset !important;
        align-items: center;
        display: flex;
        position: unset !important;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
        border-radius: unset !important;
    }

    .user img {
        position: unset !important;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .navigation ul li a .icon {
        position: relative;
        display: block;
        min-width: 60px;
        height: 60px;
        line-height: 70px;
        text-align: center;
        top: 13px;
    }

    .manage_order {
        display: grid;
        padding: 60px 20px 0px 20px;
        background: oklch(97% 0 0);
    }

    .title_order {
        color: oklch(68.5% 0.169 237.323);
        font-family: "Noto Sans", sans-serif;
        font-size: 33px;
    }

    .dash {
        border: none;
        border-radius: 45px;
        padding-bottom: 4px;
        font-weight: bold;
        /* height: 0px; */
        background-color: oklch(68.5% 0.169 237.323);
        margin-top: 10px;
        width: 114px;
        margin-left: 5px;
    }

    .update_near {
        align-items: center;
        border-radius: 20px;
        background: white;
        margin: 20px 20px 10px 20px;
        justify-content: space-between;
        display: flex;
    }

    .update_near_1 {
        align-items: center;
        gap: 15px;
        display: flex;
        margin-left: 15px;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .infor_store {
        gap: 10px;
        align-items: center;
        margin-right: 15px;
        display: flex;
    }

    .title_store span {
        font-size: 18px;
        font-family: 'Roboto', sans-serif;
    }

    .input_name {
        margin-right: 10px;
        font-family: 'Roboto', sans-serif;
        width: 500px;
        border-radius: 10px;
        outline: none;
        height: 45px;
        font-size: 15px;
        padding: 10px;
        border: 2px solid #3498db;
    }

    .input_name::placeholder {
        font-size: 18px;
        font-family: 'Roboto', sans-serif;
        color: #3498db;
    }

    .title_update span {
        font-size: 18px;
        font-family: 'Roboto', sans-serif;
    }

    .time_update {
        font-weight: bold;
        font-size: 18px;
        font-family: 'Roboto', sans-serif;
    }

    .icon_reload {
        padding: 10px;
        border-radius: 50%;
        border: 1px solid oklch(92.2% 0 0);
    }

    .icon_reload i {
        color: oklch(63.7% 0.237 25.331);
        font-size: 18px;
    }

    .card {
        position: relative;
        background: var(--white);
        padding: 10px 15px 20px 15px !important;
        border-radius: 15px;
        justify-content: space-between;
        cursor: pointer;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
        display: unset !important;
    }

    .frame_total {
        /* justify-content: center; */
        padding-left: 15px;
        border-radius: 10px;
        height: 50px;
        background: oklch(94.1% 0.03 12.58);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: oklch(27.9% 0.041 260.031) !important;
    }

    .frame_total i {
        color: oklch(64.5% 0.246 16.439);
        font-size: 25px;
    }

    .frame_quantity {
        padding-left: 15px;
        border-radius: 10px;
        height: 50px;
        background: oklch(90.1% 0.058 230.902);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .frame_quantity i {
        color: oklch(62.3% 0.214 259.815);
        font-size: 25px;
    }

    .iconBx span {
        color: black;
        padding-left: 10px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        font-size: 28px;
    }

    .frame_success {
        padding-left: 15px;
        border-radius: 10px;
        height: 50px;
        background: oklch(93.8% 0.127 124.321);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .frame_success i {
        color: oklch(76.8% 0.233 130.85);
        font-size: 25px;
    }

    .frame_fail {
        padding-left: 15px;
        border-radius: 10px;
        height: 50px;
        background: oklch(90.1% 0.076 70.697);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .frame_fail i {
        color: oklch(70.5% 0.213 47.604);
        font-size: 25px;
    }

    .cardBox .card .iconBx {
        font-size: unset !important;
        color: var(--black2);
    }

    .cardBox .card .cardName {
        font-weight: 700;
        font-family: 'Roboto', sans-serif;
        color: oklch(27.9% 0.041 260.031) !important;
        font-size: 16px !important;
        margin-top: unset !important;
    }

    .total_money span {
        padding-left: 10px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        font-size: 28px;
    }

    .local {
        color: black;
        padding-left: unset !important;
        font-size: 17px !important;
        font-family: 'Roboto', sans-serif;
        font-weight: 600;
    }

    .details .recentOrders {
        display: unset !important;
    }

    .header_near {
        justify-content: space-between;
        display: flex;
        color: var(--blue);
        align-items: center;
    }

    .header_near h2 {
        font-family: 'Roboto', sans-serif;
        font-size: 23px;
    }

    .btn_review {
        font-weight: 600;
        font-size: 16px;
        font-family: 'Roboto', sans-serif;
        position: relative;
        padding: 8px 10px;
        background: var(--blue);
        text-decoration: none;
        color: var(--white);
        border-radius: 6px;
    }

    .details {
        position: relative;
        width: 100%;
        padding: 20px;
        display: grid;
        grid-template-columns: 71% 27% !important;
        grid-gap: 30px;
    }

    .table_exchange {
        max-height: 500px;
        overflow-y: auto;
        margin-top: 20px;
        border-radius: 5px;
    }

    .table_exchange_1 thead {
        border: 2px solid red;
        background: blue;
    }

    .table_exchange_1 thead tr td {
        border: 2px solid #3498db;
        font-family: 'Roboto', sans-serif;
        color: white;
        background: oklch(70.7% 0.165 254.624);
    }

    .details table {
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px !important;
    }

    .details .recentOrders table tr td {
        text-align: center;
        padding: 10px;
    }

    .details .recentOrders table tr td:nth-child(2) {
        text-align: center !important;
    }

    .details .recentOrders table tr td:last-child {
        text-align: center !important;
    }

    .details .recentOrders table tr th {
        border: 2px solid oklch(0.92 0.004 286.32);
        padding: 7px 0px 7px 0px;
        font-family: 'Roboto', sans-serif;
        font-weight: 500;
        font-size: 17px;
        color: black;
    }

    .details .recentOrders table tr th:nth-child(2) {
        width: 120px;
        text-align: center !important;
        color: oklch(54.6% 0.245 262.881);
    }

    .details .recentOrders table tr th:nth-child(5) {
        width: 250px;
        text-align: center !important;

    }

    .details .recentOrders table tr th:nth-child(6) {
        width: 180px;
        text-align: center !important;
    }

    .badge-delivered {
        background-color: oklch(0.897 0.196 126.665);
        color: rgb(21, 87, 36);
        border: 2px solid oklch(0.897 0.196 126.665);
    }

    .badge-cancelled {
        background-color: oklch(0.704 0.191 22.216);
        color: oklch(0.505 0.213 27.518);
        border: 2px solid oklch(0.704 0.191 22.216);
        border-radius: 10px;
        text-align: center;
    }

    .badge-status {
        width: 78px !important;
        margin-right: -10px;
        border: none !important;
        margin-bottom: 10px;
        margin-top: 10px;
        margin-left: 20px;
        border-radius: 30px;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .details .recentOrders table tr {
        color: var(--black1);
        border-bottom: 2px solid oklch(0.92 0.004 286.32) !important;
    }

    .user_near h2 {
        font-family: 'Roboto', sans-serif;
        font-size: 23px;
        font-weight: 700 !important;
        color: var(--blue);
    }

    .recentCustomers small {
        display: block;
        font-size: 13px;
        color: #444;
        margin-top: 2px;
    }

    .recentCustomers .user-container {
        position: relative;
        display: inline-block;
    }

    .recentCustomers .user-detail-popup {
        display: none;
        line-height: 30px;
        color: black;
        position: absolute;
        top: 100%;
        left: -32px;
        background-color: white !important;
        border: 2px solid #3498db;
        border-radius: 3px;
        padding: 10px 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        z-index: 100;
        font-size: 13px;
        height: 110px;
        width: 360px;
    }

    .recentCustomers .user-container:hover .user-detail-popup {
        display: block;
    }

    .table_user {
        border: none !important;
        margin-top: 10px !important;
    }

    .recentCustomers .imgBx {
        position: relative;
        width: 50px !important;
        height: 50px !important;
        border-radius: 50%;
        overflow: hidden;
        border-radius: 30px !important;
        border: 2px solid #3498db !important;
    }

    .recentCustomers table tr td h4 {
        font-weight: 600 !important;
        font-family: 'Roboto', sans-serif;
        font-size: 18px !important;
        line-height: 25px !important;
    }

    .recentCustomers table tr td h4 span {
        font-weight: 700 !important;
        font-family: 'Roboto', sans-serif;
        font-size: 16px !important;
        color: oklch(62.3% 0.214 259.815) !important;
    }

    .infor_user {
        align-items: end;
        text-align: center;
        display: flex;
    }

    .title_infor {
        font-weight: 600;
        margin-right: 10px;
        font-family: 'Roboto', sans-serif;
        font-size: 17px !important;
    }

    .infor_user p {
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
    }

    .cardBox .card:hover {
        background: oklch(80.9% 0.105 251.813) !important;
    }

    .cardBox .card:hover .number,
    .cardBox .card:hover .cardName,
    .cardBox .card:hover .iconBx {
        color: var(--white);
    }

    .details .recentOrders table tbody tr:hover {
        color: var(--white);
        background: oklch(80.9% 0.105 251.813) !important;
    }

    .recentCustomers table tr:hover {
        background: oklch(80.9% 0.105 251.813) !important;
        color: var(--white);
    }

    .frame_user {
        overflow-y: auto;
        max-height: 550px;
    }
</style>

<style></style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/doan.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Đồ án</title>
</head>

<?php
include('../../html/db/connect.php');

$sql_hoadon = mysqli_query($con, "SELECT hoadon.* FROM hoadon WHERE trang_thai = 'Đã giao' OR trang_thai='Đã hủy' ORDER BY ngay_tao DESC LIMIT 10");

$sql_user = mysqli_query($con, "
    SELECT u.*, 
           COUNT(h.id_hoadon) AS so_don_hang,
           SUM(h.tong_tien) AS tong_chi_tieu,
           MAX(h.ngay_tao) AS lan_mua_gan_nhat
    FROM user u
    LEFT JOIN khachhang k ON u.id_user = k.id_user
    LEFT JOIN  hoadon h ON k.id_khachhang = h.id_khachhang
    GROUP BY u.id_user
    ORDER BY lan_mua_gan_nhat DESC
    LIMIT 10
");
?>

<?php
$sql_doanhthu = mysqli_query($con, "SELECT SUM(tong_tien) AS tong_doanh_thu FROM hoadon WHERE trang_thai = 'Đã giao'");
$row_doanhthu = mysqli_fetch_assoc($sql_doanhthu);
$tong_doanh_thu = $row_doanhthu['tong_doanh_thu'] ?? 0;
?>

<?php
include('../../html/db/connect.php');

$sql_count_order = mysqli_query($con, "SELECT COUNT(*) AS total_orders FROM hoadon");

$row_count_order = mysqli_fetch_assoc($sql_count_order);
$total_orders = $row_count_order['total_orders'];
?>

<?php

include('../../html/db/connect.php');

$sql_count_order_success = mysqli_query($con, "SELECT COUNT(*) AS total_orders_success FROM hoadon WHERE trang_thai='Đã giao'");

$row_count_order_success = mysqli_fetch_assoc($sql_count_order_success);
$total_orders_success = $row_count_order_success['total_orders_success'];
?>

<?php

include('../../html/db/connect.php');

$sql_count_order_fail = mysqli_query($con, "SELECT COUNT(*) AS total_orders_fail FROM hoadon WHERE trang_thai='Đã hủy'");

$row_count_order_fail = mysqli_fetch_assoc($sql_count_order_fail);
$total_orders_fail = $row_count_order_fail['total_orders_fail'];
?>

<?php
$sql_latest_time = mysqli_query($con, "SELECT ngay_tao FROM hoadon ORDER BY ngay_tao DESC LIMIT 1");
$row_latest_time = mysqli_fetch_assoc($sql_latest_time);

$latest_time = date("H:i:s - d/m/Y", strtotime($row_latest_time['ngay_tao']));
?>

<?php
function getStatusClass($status)
{
    return match ($status) {
        'Đã giao' => 'badge-delivered',
        'Đã hủy'  => 'badge-cancelled',
        default   => 'badge-status',
    };
}
?>


<body>
    <div class="container">
        <?php
        include("../interface/navigation.php")
        ?>

        <!--main-->
        <div class="main">

            <?php
            include("../interface/topbar.php")
            ?>

            <div class="manage_order">
                <h1 class="title_order">Tổng quan hôm nay</h1>
                <hr class="dash">
            </div>

            <div class="update_near">
                <div class="update_near_1">
                    <div class="title_update">
                        <span>Cập nhật gần nhất: </span>
                        <span class="time_update"><?php echo $latest_time; ?></span>
                    </div>
                    <div class="icon_reload">
                        <a href="../../Admin/interface/trangchu.php">
                            <i class="fa-solid fa-rotate fa-rotate-270"></i>
                        </a>
                    </div>
                </div>
                <div class="infor_store">
                    <div class="title_store">
                        <span>Cửa hàng:</span>
                    </div>
                    <div class="name_store">
                        <input class="input_name" value placeholder="BookStore">
                    </div>
                </div>
            </div>

            <!--cards-->
            <div class="cardBox">
                <div class="card">
                    <div class="frame_total">
                        <i class="fa-solid fa-comment-dollar"></i>
                        <div class="cardName">TỔNG DOANH THU</div>
                    </div>
                    <div class="total_money">
                        <span><?php echo number_format($tong_doanh_thu, 0, ',', '.'); ?></span>
                        <span class="local">đ</span>
                    </div>
                </div>
                <div class="card">
                    <div class="frame_quantity">
                        <i class="fa-solid fa-chart-simple"></i>
                        <div class="cardName">SỐ LƯỢNG GIAO DỊCH</div>
                    </div>
                    <div class="iconBx">
                        <span><?php echo $total_orders; ?></span>
                        <span class="local">giao dịch</span>
                    </div>
                </div>
                <div class="card">
                    <div class="frame_success">
                        <i class="fa-regular fa-circle-check"></i>
                        <div class="cardName">GIAO DỊCH THÀNH CÔNG</div>
                    </div>
                    <div class="iconBx">
                        <span><?php echo $total_orders_success; ?></span>
                        <span class="local">giao dịch</span>
                    </div>
                </div>
                <div class="card">
                    <div class="frame_fail">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div class="cardName">GIAO DỊCH THẤT BẠI</div>
                    </div>
                    <div class="iconBx">
                        <span><?php echo $total_orders_fail; ?></span>
                        <span class="local">giao dịch</span>
                    </div>
                </div>
            </div>

            <div class="details">
                <!--order details list-->
                <div class="recentOrders">
                    <div class="header_near">
                        <h2>GIAO DỊCH GẦN NHẤT</h2>
                        <a href="#" class="btn_review">Xem thêm</a>
                    </div>
                    <div class="table_exchange">
                        <div class="table_exchange_1">
                            <table>
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>Mã hóa đơn</td>
                                        <td>Ngày giờ</td>
                                        <td>Số điện thoại</td>
                                        <td>Tên khách hàng</td>
                                        <td>Giá trị giao dịch (đ)</td>
                                        <td>Trạng thái</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row_hoadon = mysqli_fetch_array($sql_hoadon)) {
                                    ?>
                                        <tr>
                                            <th><?php echo $row_hoadon['id_hoadon'] ?></th>
                                            <th><?php echo $row_hoadon['ma_hoadon'] ?></th>
                                            <th><?php echo $row_hoadon['ngay_tao'] ?></th>
                                            <th><?php echo $row_hoadon['so_dien_thoai'] ?></th>
                                            <th><?php echo $row_hoadon['ho_va_ten'] ?></th>
                                            <th><?php echo number_format($row_hoadon['tong_tien'], 0, ',', '.') . 'đ' ?></th>
                                            <th class="badge-status <?php echo getStatusClass($row_hoadon['trang_thai']); ?>">
                                                <?php echo $row_hoadon['trang_thai']; ?>
                                            </th>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--New Customers-->
                <div class="recentCustomers">
                    <div class="user_near">
                        <h2>TÀI KHOẢN MUA HÀNG GẦN NHẤT</h2>
                    </div>
                    <div class="frame_user">
                        <table class="table_user">
                            <?php while ($row_user = mysqli_fetch_array($sql_user)) { ?>
                                <tr>
                                    <td width="60px">
                                        <div class="imgBx">
                                            <img src="../../img/<?php echo $row_user['img'] ?>" alt="avatar">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-container">
                                            <h4><?php echo $row_user['username'] ?><br>
                                                <span><?php echo $row_user['email'] ?></span>
                                            </h4>

                                            <!-- Popup hiển thị khi hover -->
                                            <div class="user-detail-popup">
                                                <div class="infor_user">
                                                    <p class="title_infor">🛒 Số đơn hàng: </p>
                                                    <p><?php echo $row_user['so_don_hang'] ?></p>
                                                </div>
                                                <div class="infor_user">
                                                    <p class="title_infor">💰 Tổng chi tiêu: </p>
                                                    <p><?php echo number_format($row_user['tong_chi_tieu'], 0, ',', '.') ?>đ</p>
                                                </div>
                                                <div class="infor_user">
                                                    <p class="title_infor">🕒 Lần mua gần nhất: </p>
                                                    <p><?php echo date("d/m/Y H:i", strtotime($row_user['lan_mua_gan_nhat'])) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        //Menu
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.onclick = function() {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }



        //add hovered class in selected list item
        let list = document.querySelectorAll('.navigation li');

        function activeLink() {
            list.forEach((item) =>
                item.classList.remove('hovered'));
            this.classList.add('hovered');
        }
        list.forEach((item) =>
            item.addEventListener('mouseover', activeLink));
    </script>


</body>

</html>