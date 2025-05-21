<?php
session_start();
include('../../html/db/connect.php');

$username = $_SESSION['username'];
$result = $con->query("SELECT * FROM user WHERE username = '$username'")->fetch_array();

$current_user_id = $result['id_user']; // <-- thêm dòng này

// Cho phép cả admin và nhân viên
if (!$result || !in_array($result['role'], ['admin', 'nhanvien'])) {
    header('Location: ../html/index.php?quanly=taikhoan');
    exit();
}
?>


<?php
// Lọc dữ liệu từ GET
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$role_filter = isset($_GET['status']) ? $_GET['status'] : '';

// Khởi tạo truy vấn SQL cơ bản
$sql_query = "SELECT * FROM user WHERE 1";

// Thêm điều kiện tìm kiếm nếu có
if (!empty($keyword)) {
    // Kiểm tra nếu là số (ID), ngược lại là tên
    if (is_numeric($keyword)) {
        $sql_query .= " AND id_user = " . intval($keyword);
    } else {
        $escaped_keyword = mysqli_real_escape_string($con, $keyword);
        $sql_query .= " AND username LIKE '%$escaped_keyword%'";
    }
}

// Thêm điều kiện lọc vai trò nếu có
if (!empty($role_filter)) {
    $escaped_role = mysqli_real_escape_string($con, $role_filter);
    $sql_query .= " AND role = '$escaped_role'";
}

// Thực thi truy vấn
$sql_user = mysqli_query($con, $sql_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/doan.css">
    <link rel="stylesheet" href="../../css/password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Đồ án</title>
</head>

<style>
    .table {
        width: unset !important;
        padding: unset !important;
        max-height: 600px;
        overflow-y: auto;
        border: unset !important;
        border-radius: 5px;
        margin: 5px 20px 0px 20px;
        border: 1px solid oklch(0.92 0.004 286.32);
        background-color: white;
    }

    thead th {
        position: sticky;
        top: 0;
        background-color: #f6f9fc;
        color: white;
        font-size: 15px;
    }

    .table_section thead th {
        border: 2px solid #3498db;
        position: sticky;
        top: -1px;
        background: oklch(70.7% 0.165 254.624) !important;
        z-index: 1;
    }

    .table_header {
        border-radius: 5px;
        margin: 0px 20px 0px 20px;
        border: 1px solid oklch(0.92 0.004 286.32);
        background-color: white;
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

    th,
    td {
        border-bottom: 1px solid #dddddd;
        padding: 10px 20px !important;
        word-break: break-all;
        text-align: center;
    }

    .table tbody th:nth-child(1) {
        border: 2px solid oklch(0.92 0.004 286.32);
        font-size: 18px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        width: 70px;
        text-align: center;
    }

    .table th:nth-child(1) {
        font-size: 16px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        width: 80px;
        text-align: center;
    }


    .table tbody th:nth-child(2) {
        border: 2px solid oklch(0.92 0.004 286.32);
        font-size: 16px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        width: 200px;
        padding: 10px 20px;
    }

    .table th:nth-child(2) {
        font-size: 16px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        width: 200px;
        padding: 10px 20px;
    }


    .table tbody th:nth-child(3) {
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 200px;
        font-size: 18px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        padding: 10px 20px;
    }

    .table th:nth-child(3) {
        width: 250px;
        font-size: 16px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        padding: 10px 20px;
    }


    .table tbody th:nth-child(4) {
        border: 2px solid oklch(0.92 0.004 286.32);
        font-size: 18px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        padding: 10px 20px;
    }

    .table th:nth-child(4) {
        font-size: 16px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        padding: 10px 20px;
    }


    .table tbody th:nth-child(5) {
        border: 2px solid oklch(0.92 0.004 286.32);
        font-size: 18px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        padding: 10px 20px;
    }

    .table th:nth-child(5) {
        width: 350px;
        font-size: 16px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        padding: 10px 20px;
    }


    .table tbody th:nth-child(6) {
        border: 2px solid oklch(0.92 0.004 286.32);
        font-size: 16px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        width: 180px;
        padding: 10px 20px;
    }

    .table th:nth-child(6) {
        font-size: 16px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        width: 180px;
        padding: 10px 20px;
    }


    .table tbody th:nth-child(7) {
        border: 2px solid oklch(0.92 0.004 286.32);
        font-size: 16px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        width: 200px;
        padding: 10px 20px;
    }

    .table th:nth-child(7) {
        font-size: 16px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        width: 200px;
        padding: 10px 20px;
    }

    .select_role {
        font-family: "Roboto", ui-sans-serif;
        padding: 0px 3px;
        padding-right: -2px;
        cursor: pointer;
        outline: none;
        border-radius: 4px;
        height: 35px;
        background: #ffffff;
        border: 1px solid #e5e5e5;
        font-size: 16px;
        width: auto;
        color: #000;
        font-weight: 500;
    }

    .table_wrapper tbody {
        line-height: 50px;
    }

    th img {
        margin-top: 20px;
        height: 70px !important;
        width: 70px !important;
        object-fit: cover;
        border-radius: 5px !important;
        border: 2px solid #3498db !important;
    }

    .table_section {
        max-height: unset !important;
        overflow-y: unset !important;
        margin-top: unset !important;
        border: unset !important;
        /* tùy chọn: thêm viền để dễ nhìn */
    }

    .table_section table {
        width: 100%;
    }

    .table_section thead th {
        position: sticky;
        top: 0;
        background: #f9f9f9;
        z-index: 1;
    }

    th button:nth-child(1) {
        outline: none;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        padding: unset !important;
        color: #ffffff;
        height: 35px;
        width: 35px;
        background-color: #0298cf;
    }

    th button:nth-child(2) {
        outline: none;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        padding: unset !important;
        color: #ffffff;
        height: 35px;
        width: 35px;
        background-color: #0298cf;
    }

    th button:nth-child(3) {
        outline: none;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        padding: unset !important;
        color: #ffffff;
        height: 35px;
        width: 35px;
        background-color: #0298cf;
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .modal-content {
        background: #fff;
        padding: 20px;
        margin: 10% auto;
        width: 400px;
        border-radius: 10px;
        position: relative;
    }

    .close {
        position: absolute;
        right: 10px;
        top: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    /* Hiệu ứng nền mờ */
    .box_edit {
        display: none;
        position: fixed;
        z-index: 999;
        background: rgba(0, 0, 0, 0.5);
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        animation: fadeIn 0.3s ease;
    }

    /* Hiệu ứng mở modal */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Hộp modal */
    .box_edit_1 {
        background: #ffffff;
        padding: 30px;
        margin: 80px auto;
        width: 555px;
        max-width: 90%;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        animation: slideIn 0.3s ease;
        position: relative;
    }

    /* Hiệu ứng vào */
    @keyframes slideIn {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .title_edit {
        flex-direction: row-reverse;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .title_edit h3 {
        font-size: 24px;
        font-family: 'Roboto', sans-serif;
        color: oklch(63.7% 0.237 25.331);
    }

    .icon_close {
        font-size: 22px;
        cursor: pointer;
        color: #888;
        transition: color 0.2s ease;
    }

    .icon_close:hover {
        color: red;
    }

    .edit_name,
    .edit_email {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .edit_img {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .edit_name label,
    .edit_email label {
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        width: 60px;
        color: #287bff;
    }

    .edit_img label {
        white-space: nowrap;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        color: #287bff;
    }

    input {
        padding: 10px 20px;
        margin: 0 10px;
        outline: none;
        border: 1px solid #0298cf;
        border-radius: 6px;
        color: black;
    }

    .edit_name input,
    .edit_email input {
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        flex: 1;
        transition: all 0.2s ease;
    }

    .edit_img input {
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        flex: 1;
        transition: all 0.2s ease;
    }

    .edit_name input:focus,
    .edit_email input:focus,
    .edit_img input:focus {
        border-color: #409EFF;
        box-shadow: 0 0 0 2px rgba(64, 158, 255, 0.2);
    }

    #current_user_img {
        max-width: 100px;
        margin-top: 10px;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    /* Nút cập nhật */
    .update_edit {
        margin-top: 15px !important;
        width: 100%;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        font-weight: 600;
        padding: 12px;
        background-color: #409EFF;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .update_edit:hover {
        background-color: #337ecc;
    }

    .navigation ul li a .icon {
        position: relative;
        display: block;
        min-width: 60px;
        height: 60px;
        line-height: 45px !important;
        text-align: center;
        top: 13px;
    }

    .box_add {
        position: fixed;
        top: -123px;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .box_add_inner {
        background: white;
        padding: 25px;
        border-radius: 10px;
        width: 600px;
        animation: fadeIn 0.3s ease-in-out;
    }

    .form_group {
        margin-bottom: 15px;
    }

    .form_group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .form_group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .btn_submit {
        background: #28a745;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 6px;
        cursor: pointer;
    }

    .icon_close {
        float: right;
        cursor: pointer;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .alert {
        padding: 15px;
        margin: 20px auto;
        width: 90%;
        max-width: 500px;
        border-radius: 8px;
        font-weight: bold;
        text-align: center;
        animation: fadeOut 1s forwards;
    }

    .success-alert {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .error-alert {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        80% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            display: none;
        }
    }

    .table_section {
        max-height: 755px;
        /* hoặc chiều cao bạn muốn */
        overflow-y: auto;
        margin-top: 10px;
        border: unset !important;
        /* tùy chọn: thêm viền để dễ nhìn */
    }

    .table_wrapper tbody tr:nth-child(even) {
        background-color: #f2f2f2;
        /* Màu xám nhạt cho dòng lẻ */
    }

    .table_wrapper tbody tr:nth-child(odd) {
        background-color: #ffffff;
        /* Màu trắng cho dòng chẵn */
    }

    .table_section table {
        border-collapse: collapse;
        width: 100%;
    }

    .title_add {
        flex-direction: row-reverse;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .title_add h3 {
        font-size: 24px;
        font-family: 'Roboto', sans-serif;
        color: oklch(63.7% 0.237 25.331);
    }

    .form_group {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .form_group_name label,
    .form_group_email label {
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        width: 75px;
        color: #287bff;
    }

    .form_group_name,
    .form_group_email {
        margin-bottom: 15px;
        align-items: center;
        display: flex;
    }

    .form_group_password {
        margin-bottom: 15px;
        align-items: center;
        display: flex;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        color: #287bff;
    }

    .form_group_repassword {
        margin-bottom: 15px;
        align-items: center;
        display: flex;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        color: #287bff;
    }

    .form_group_img {
        margin-bottom: 15px;
        align-items: center;
        display: flex;
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        color: #287bff;
    }

    .form_group_name input,
    .form_group_email input,
    .form_group_password input,
    .form_group_repassword input,
    .form_group_img input {
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        flex: 1;
        transition: all 0.2s ease;
    }

    .btn_submit {
        margin-top: 20px;
        width: 100%;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        font-weight: 600;
        padding: 12px;
        background-color: #409EFF;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .btn_submit:hover {
        background-color: #337ecc;
    }

    .add_new {
        margin-right: 10px;
        font-weight: 500;
        font-size: 16px;
        font-family: 'Roboto', sans-serif;
        padding: 12px 15px !important;
        color: #ffffff;
        background: linear-gradient(46.26deg, oklch(62.3% 0.214 259.815), #009edb 96.59%) !important;
    }

    .table_header p {
        margin-left: unset !important;
        font-size: 20px;
        font-family: "Noto Sans", sans-serif;
        color: oklch(68.5% 0.169 237.323) !important;
        font-weight: 700 !important;
    }

    .search_user input {
        margin-right: 10px;
        font-family: 'Roboto', sans-serif;
        width: 240px;
        border-radius: 2px;
        outline: none;
        height: 45px;
        font-size: 15px;
        padding: 10px;
        border: 2px solid #3498db;
    }

    .classify_status {
        margin-right: 10px;
    }

    .search_status {
        font-weight: 600;
        color: oklch(62.3% 0.214 259.815);
        background: oklch(97.7% 0.013 236.62);
        font-family: 'Roboto', sans-serif;
        width: 240px;
        outline: none;
        box-shadow: none;
        height: 45px;
        font-size: 15px;
        padding: 10px;
        border: 2px solid #3498db;
        border-radius: 2px;
    }

    .edit_password {
        align-items: center;
        margin-bottom: 20px;
        display: flex;
    }

    .edit_password label {
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        /* width: 60px; */
        color: #287bff;
    }

    .edit_password input {
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        flex: 1;
        transition: all 0.2s ease;
        padding: 10px 20px;
    }

    .highlighted-row {
        background-color: #d1e7fd !important;
        /* màu nền tô đậm */
        font-weight: bold;
    }

    .select_role {
        font-weight: 600;
        font-family: 'Roboto', sans-serif;
        padding: 8px 10px;
        border: none;
        border-radius: 8px;
        background-color: #f9f9f9;
        color: #333;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .select_role:hover {
        border-color: #999;
        background-color: #f1f1f1;
    }

    .select_role:focus {
        outline: none;
        border-color: #5c9ded;
        box-shadow: 0 0 0 3px rgba(92, 157, 237, 0.3);
    }

    .select_role option {
        background-color: white;
        color: #333;
    }

    .search_user {
        display: flex;
    }

    .add_user {
        align-items: center;
        text-align: center;
        display: flex
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
        margin-bottom: 40px !important;
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

    .main {
        background-color: oklch(97% 0 0);
    }

    .button_return {
        font-weight: 500;
        font-size: 16px;
        font-family: 'Roboto', sans-serif;
        padding: 12px 15px !important;
        color: #ffffff;
        background: linear-gradient(46.26deg, oklch(62.3% 0.214 259.815), #009edb 96.59%) !important;
        border-radius: 6px;
    }

    .button_return span {
        font-weight: 500;
        font-size: 16px;
        font-family: 'Roboto', sans-serif;
    }

    .classify_status select option {
        font-weight: 500;
        font-size: 16px;
        font-family: 'Roboto', sans-serif;
    }

    .select_role option {
        font-weight: 500;
        font-size: 16px;
        font-family: 'Roboto', sans-serif;
    }
</style>

<body>
    <div class="container">
        <?php
        include("../../Admin/interface/navigation.php")
        ?>
        <!--main-->
        <div class="main">
            <?php
            include("../../Admin/interface/topbar.php")
            ?>

            <?php if (isset($_SESSION['success_add'])): ?>
                <div class="alert success-alert">
                    <?= $_SESSION['success_add']; ?>
                </div>
                <?php unset($_SESSION['success_add']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert error-alert">
                    <?= $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <div class="manage_order">
                <h1 class="title_order">Quản lí tài khoản</h1>
                <hr class="dash">
            </div>

            <div class="table_header">
                <p>Form xử lí</p>
                <form method="GET" action="">
                    <div class="search_user">
                        <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                        <div class="classify_status">
                            <select class="search_status" name="status" onchange="this.form.submit()">
                                <option value="">-- Tất cả vai trò --</option>
                                <?php
                                $sql_role = mysqli_query($con, "SELECT DISTINCT role FROM user");
                                while ($row = mysqli_fetch_assoc($sql_role)) {
                                    $role = $row['role'];
                                    $selected = (isset($_GET['status']) && $_GET['status'] == $role) ? 'selected' : '';
                                    echo "<option value=\"$role\" $selected>$role</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="add_user">
                            <button type="button" class="add_new" onclick="openAddModal()">
                                <i class="fa-solid fa-user-plus"></i>
                                Thêm người dùng
                            </button>
                        </div>
                        <div class="button_reset">
                            <a href="../../Admin/interface/account.php" style="text-decoration: none;">
                                <button type="button" class="button_return">
                                    <i class="fa-solid fa-rotate-left"></i>
                                    <span>Trở về</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table">
                <div class="table_section">
                    <div class="table_wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hình ảnh</th>
                                    <th>Họ và Tên</th>
                                    <th>Email</th>
                                    <th>Ngày tạo</th>
                                    <th>Vai trò</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row_user = mysqli_fetch_array($sql_user)) {
                                ?>
                                    <tr>
                                        <th><?php echo $row_user['id_user'] ?></th>
                                        <th><img src="../../img/<?php echo $row_user['img'] ?>"></th>
                                        <th><?php echo $row_user['username'] ?></th>
                                        <th><?php echo $row_user['email'] ?></th>
                                        <th><?php echo $row_user['created_at'] ?></th>
                                        <th>
                                            <select class="select_role"
                                                onchange="handleRoleChange(<?php echo $row_user['id_user']; ?>,this.value,<?php echo $current_user_id; ?>)">
                                                <option <?php if ($row_user['role'] == 'admin') echo 'selected'; ?>>admin</option>
                                                <option <?php if ($row_user['role'] == 'nhanvien') echo 'selected'; ?>>nhanvien</option>
                                                <option <?php if ($row_user['role'] == 'khachhang') echo 'selected'; ?>>khachhang</option>
                                            </select>
                                        </th>
                                        <th>
                                            <button onclick="editUser(<?php echo $row_user['id_user']; ?>)">
                                                <i class="fa-solid fa-pencil" style="color: #fcfcfc;"></i>
                                            </button>

                                            <?php if ($row_user['trangthai'] == 'hoạt động') { ?>
                                                <button style="background-color: oklch(76.8% 0.233 130.85) !important;" onclick="toggleStatus(<?php echo $row_user['id_user']; ?>, 'không hoạt động')">
                                                    <i class="fa-solid fa-lock-open" style="color: #fcfcfc;"></i>
                                                </button>
                                            <?php } else { ?>
                                                <button style="background-color: oklch(76.9% 0.188 70.08);" onclick="toggleStatus(<?php echo $row_user['id_user']; ?>, 'hoạt động')">
                                                    <i class="fa-solid fa-lock" style="color: #fcfcfc;"></i>
                                                </button>
                                            <?php } ?>

                                            <button style="background-color: oklch(63.7% 0.237 25.331);" onclick="confirmDelete(<?php echo $row_user['id_user']; ?>)">
                                                <i class="fa-solid fa-trash" style="color: #fcfcfc;"></i>
                                            </button>
                                        </th>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box_edit" id="editModal">
                    <div class="box_edit_1">
                        <div class="title_edit">
                            <span class="icon_close" onclick="closeModal()">❌</span>
                            <h3>Chỉnh sửa thông tin người dùng</h3>
                        </div>
                        <div class="form_edit">
                            <form id="editUserForm" enctype="multipart/form-data" method="POST" action="../../Admin/php/suathongtinuser.php">
                                <input type="hidden" name="id_user" id="edit_id_user">
                                <div class="edit_name">
                                    <label>Họ tên:</label>
                                    <input type="text" name="username" id="edit_username">
                                    <span id="username_error" style="font-weight: 600;font-family: 'Roboto';color: red;font-size: 14px;"></span>
                                </div>

                                <div class="edit_email">
                                    <label>Email:</label>
                                    <input type="email" name="email" id="edit_email">
                                    <span id="email_error" style="font-weight: 600;font-family: 'Roboto';color: red;font-size: 14px;"></span>
                                </div>

                                <div class="edit_password">
                                    <label>Mật khẩu cũ:</label>
                                    <input type="password" name="current_password" id="current_password">
                                    <span id="current_password_error" style="font-weight: 600;font-family: 'Roboto';color: red;font-size: 14px;"></span>
                                </div>

                                <div class="edit_password">
                                    <label>Mật khẩu mới:</label>
                                    <input type="password" name="new_password" id="new_password">
                                    <span id="new_password_error" style="font-weight: 600;font-family: 'Roboto';color: red;font-size: 14px;"></span>
                                </div>

                                <div class="edit_password">
                                    <label>Nhập lại mật khẩu mới:</label>
                                    <input type="password" id="confirm_password">
                                    <span id="confirm_password_error" style="font-weight: 600;font-family: 'Roboto';color: red;font-size: 14px;"></span>
                                </div>

                                <div class="edit_img">
                                    <label>Ảnh đại diện:</label>
                                    <input type="file" name="img_file" id="edit_user_img_input" onchange="previewImage(event)"><br>
                                </div>

                                <img id="current_user_img" src="" style="max-width: 150px; margin-top: 10px;"><br>

                                <button type="submit" name="capnhat" class="update_edit">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box_add" id="addUserModal" style="display: none;">
                    <div class="box_add_inner">
                        <div class="title_add">
                            <span class="icon_close" onclick="closeAddModal()">❌</span>
                            <h3>Thêm người dùng mới</h3>
                        </div>
                        <form id="addUserForm" method="POST" enctype="multipart/form-data" action="../../Admin/php/suathongtinuser.php">
                            <div class="form_group_name">
                                <label>Họ tên:</label>
                                <input type="text" name="username" id="username_input" required onblur="checkUsername()">
                                <small id="username_check" style="color: red; display: ruby; font-size: 14px; font-family: 'Roboto', sans-serif; font-weight: 600"><br></small>
                            </div>

                            <div class="form_group_email">
                                <label>Email:</label>
                                <input type="email" name="email" id="email_input" required onblur="checkEmail()">
                                <small id="email_check" style="color: red; display: block; font-size: 14px; font-family: 'Roboto', sans-serif; font-weight: 600;"></small>
                            </div>

                            <div class="form_group_password">
                                <label>Mật khẩu:</label>
                                <input type="password" name="password" autocomplete="new-password" required>
                            </div>

                            <div class="form_group_repassword">
                                <label>Nhập lại mật khẩu:</label>
                                <input type="password" name="repassword" id="repassword_input" autocomplete="new-password" required onblur="checkPasswordMatch()">
                                <small id="password_check" style="color: red; display: block; font-size: 14px; font-family: 'Roboto', sans-serif; font-weight: 600;"></small>
                            </div>

                            <div class="form_group_img">
                                <label>Ảnh đại diện:</label>
                                <input type="file" name="img_file" accept="image/*" onchange="previewAddImage(event)">
                            </div>

                            <img id="preview_add_img" src="#" style="display:none; max-width: 150px; margin-top: 10px;">

                            <button type="submit" name="themnguoidung" class="btn_submit">Thêm người dùng</button>
                        </form>
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

    <script>
        function updateRole(userId, newRole) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../../Admin/php/khoamouser.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("id_user=" + userId + "&role=" + newRole);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("Cập nhật vai trò thành công!");
                } else {
                    alert("Cập nhật thất bại.");
                }
            };
        }
    </script>

    <script>
        function handleRoleChange(userId, newRole, currentUserId) {
            // Nếu người dùng hiện tại đang đổi vai trò của chính mình từ admin => khách hàng
            if (userId === currentUserId && newRole === 'khachhang') {
                if (!confirm("Bạn đang thay đổi vai trò của chính mình sang khách hàng. Bạn có chắc muốn tiếp tục?")) {
                    location.reload(); // Hoặc reset lại dropdown nếu cần
                    return;
                }
            }

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../../Admin/php/khoamouser.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("id_user=" + userId + "&role=" + newRole);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Nếu là người dùng hiện tại đổi vai trò của chính mình => chuyển hướng
                    if (userId === currentUserId && newRole === 'khachhang') {
                        window.location.href = "../../html/index.php?quanly=taikhoan";
                    } else {
                        alert("Cập nhật vai trò thành công!");
                    }
                } else {
                    alert("Cập nhật thất bại.");
                }
            };
        }
    </script>

    <script>
        function toggleStatus(idUser, newStatus) {
            let confirmMsg = (newStatus === 'không hoạt động') ?
                "Bạn có chắc chắn muốn khóa tài khoản này không?" :
                "Bạn có chắc chắn muốn mở lại tài khoản này không?";

            if (confirm(confirmMsg)) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "../../Admin/php/khoamouser.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onload = function() {
                    if (this.status === 200) {
                        let response = this.responseText.trim();

                        if (response === "success_không hoạt động") {
                            alert("✅ Khóa tài khoản thành công!");
                        } else if (response === "success_hoạt động") {
                            alert("✅ Mở khóa tài khoản thành công!");
                        } else if (response === "fail") {
                            alert("❌ Cập nhật thất bại. Vui lòng thử lại!");
                        } else {
                            alert("❌ Phản hồi không xác định: " + response);
                        }

                        location.reload(); // Làm mới bảng
                    }
                };

                xhr.send("id_user=" + idUser + "&trangthai=" + encodeURIComponent(newStatus));
            }
        }
    </script>

    <script>
        function editUser(idUser) {
            const row = [...document.querySelectorAll("table tbody tr")].find(
                tr => tr.children[0].textContent == idUser
            );

            if (row) {
                document.getElementById("edit_id_user").value = idUser;
                document.getElementById("edit_username").value = row.children[2].textContent.trim();
                document.getElementById("edit_email").value = row.children[3].textContent.trim();

                const imgSrc = row.children[1].querySelector("img").getAttribute("src");
                document.getElementById("current_user_img").src = imgSrc;

                document.getElementById("editModal").style.display = "block";
            }
        }

        function closeModal() {
            document.getElementById("editModal").style.display = "none";
        }

        function previewImage(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function() {
                const imgElement = document.getElementById("current_user_img");
                imgElement.src = reader.result; // Gán ảnh xem trước
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Gửi form bằng AJAX
        document.getElementById("editUserForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const newPassword = document.getElementById("new_password").value.trim();
            const confirmPassword = document.getElementById("confirm_password").value.trim();
            const currentPassword = document.getElementById("current_password").value.trim();

            let hasError = false;

            // Kiểm tra xác nhận mật khẩu mới
            if (newPassword && newPassword.length < 6) {
                document.getElementById("new_password_error").textContent = "❌ Mật khẩu mới phải dài hơn 6 ký tự!";
                hasError = true;
            } else {
                document.getElementById("new_password_error").textContent = "";
            }

            if (newPassword && newPassword !== confirmPassword) {
                document.getElementById("confirm_password_error").textContent = "❌ Mật khẩu xác nhận không khớp!";
                hasError = true;
            } else {
                document.getElementById("confirm_password_error").textContent = "";
            }

            if (hasError) return;

            // Gửi dữ liệu nếu không có lỗi
            const formData = new FormData(this);
            formData.append("confirm_password", confirmPassword);

            fetch("../../Admin/php/suathongtinuser.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(data => {
                    if (data.trim() === "success") {
                        alert("✅ Cập nhật thành công!");
                        closeModal();
                        location.reload();
                    } else {
                        if (data.includes("wrong_password")) {
                            document.getElementById("current_password_error").textContent = "❌ Mật khẩu cũ không đúng!";
                        } else {
                            alert("❌ Lỗi: " + data);
                        }
                    }
                })
                .catch(error => {
                    alert("❌ Có lỗi xảy ra.");
                    console.error(error);
                });
        });

        // Hàm kiểm tra email
        function checkEmailExists(email) {
            return fetch(`../../Admin/php/kiemtraemail.php?email=${encodeURIComponent(email)}`)
                .then(res => res.text());
        }

        // Hàm kiểm tra username
        function checkUsernameExists(username) {
            return fetch(`../../Admin/php/kiemtraemail.php?username=${encodeURIComponent(username)}`)
                .then(res => res.text());
        }

        // Sự kiện kiểm tra email real-time
        document.getElementById("edit_email").addEventListener("input", async function() {
            const email = this.value.trim();
            const errorSpan = document.getElementById("email_error");

            if (email === "") {
                errorSpan.textContent = "";
                return;
            }

            const response = await checkEmailExists(email);

            const currentRow = [...document.querySelectorAll("table tbody tr")].find(
                tr => tr.children[0].textContent == document.getElementById("edit_id_user").value
            );

            const oldEmail = currentRow?.children[3].textContent.trim();

            if (response.includes("Email đã tồn tại!") && email !== oldEmail) {
                errorSpan.textContent = "❌ Email đã tồn tại!";
            } else {
                errorSpan.textContent = "";
            }
        });

        // Sự kiện kiểm tra username real-time
        document.getElementById("edit_username").addEventListener("input", async function() {
            const username = this.value.trim();
            const errorSpan = document.getElementById("username_error");

            // Kiểm tra độ dài
            if (username.length < 6) {
                errorSpan.textContent = "❌ Username phải dài hơn 6 ký tự!";
                return;
            }

            // Kiểm tra ký tự hợp lệ (chỉ chữ, số, khoảng trắng)
            const regex = /^[\p{L}\s0-9]+$/u;
            if (!regex.test(username)) {
                errorSpan.textContent = "❌ Username chỉ được chứa chữ cái, số và khoảng trắng!";
                return;
            }

            // Kiểm tra trùng tên nếu qua 2 điều kiện trên
            const response = await checkUsernameExists(username);

            const currentRow = [...document.querySelectorAll("table tbody tr")].find(
                tr => tr.children[0].textContent == document.getElementById("edit_id_user").value
            );

            const oldUsername = currentRow?.children[2].textContent.trim();

            if (response.includes("Họ tên đã tồn tại!") && username !== oldUsername) {
                errorSpan.textContent = "❌ Họ tên đã tồn tại!";
            } else {
                errorSpan.textContent = "";
            }
        });
    </script>

    <script>
        document.querySelector('.add_new').addEventListener('click', function() {
            document.getElementById('addUserModal').style.display = 'flex';
        });

        function closeAddModal() {
            document.getElementById('addUserModal').style.display = 'none';
            document.getElementById('email_check').innerText = '';
            document.getElementById('username_check').innerText = '';
            document.getElementById('password_check').innerText = '';
        }

        function previewAddImage(event) {
            const img = document.getElementById('preview_add_img');
            img.src = URL.createObjectURL(event.target.files[0]);
            img.style.display = 'block';
        }

        function isValidUsername(username) {
            const regex = /^[\p{L}\s0-9]+$/u;
            return regex.test(username);
        }

        document.getElementById('addUserForm').addEventListener('submit', function(event) {
            const pass = document.querySelector('input[name="password"]').value;
            const repass = document.getElementById('repassword_input').value;
            const username = document.getElementById('username_input').value;

            let hasError = false;

            // Kiểm tra password khớp
            if (pass !== repass) {
                document.getElementById('password_check').innerText = 'Mật khẩu không khớp!';
                hasError = true;
            }

            // Kiểm tra độ dài mật khẩu
            if (pass.length <= 6) {
                document.getElementById('password_check').innerText = 'Mật khẩu phải dài hơn 6 ký tự!';
                hasError = true;
            }

            // Kiểm tra username hợp lệ
            if (!isValidUsername(username)) {
                document.getElementById('username_check').innerText = 'Username chỉ được chứa chữ cái, số và khoảng trắng!';
                hasError = true;
            } else if (username.length <= 6) {
                document.getElementById('username_check').innerText = 'Username phải dài hơn 6 ký tự!';
                hasError = true;
            }

            if (hasError) {
                event.preventDefault();
            }
        });

        function checkPasswordMatch() {
            const pass = document.querySelector('input[name="password"]').value;
            const repass = document.getElementById('repassword_input').value;
            const checkPass = document.getElementById('password_check');

            if (pass && repass && pass !== repass) {
                checkPass.innerText = 'Mật khẩu không khớp!';
            } else {
                checkPass.innerText = '';
            }
        }

        function checkEmail() {
            const email = document.getElementById('email_input').value;
            const checkSpan = document.getElementById('email_check');

            if (email) {
                fetch(`../../Admin/php/kiemtraemail.php?email=${encodeURIComponent(email)}`)
                    .then(res => res.text())
                    .then(data => {
                        if (data !== 'OK') {
                            checkSpan.innerText = data;
                        } else {
                            checkSpan.innerText = ''; // Không hiển thị gì nếu OK
                        }
                    });
            }
        }

        function checkUsername() {
            const username = document.getElementById('username_input').value;
            const checkSpan = document.getElementById('username_check');

            if (username) {
                fetch(`../../Admin/php/kiemtraemail.php?username=${encodeURIComponent(username)}`)
                    .then(res => res.text())
                    .then(data => {
                        if (data !== 'OK') {
                            checkSpan.innerText = data;
                        } else {
                            checkSpan.innerText = ''; // Không hiển thị gì nếu OK
                        }
                    });
            }
        }
    </script>

    <script>
        function confirmDelete(userId) {
            if (confirm("Bạn có chắc chắn muốn xóa người dùng này không?")) {
                window.location.href = '../../Admin/php/suathongtinuser.php?id=' + userId;
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('table tbody tr');
            let currentlyHighlighted = null;

            tableRows.forEach(row => {
                row.addEventListener('click', function(e) {
                    // Bỏ highlight nếu có dòng khác đang được chọn
                    if (currentlyHighlighted && currentlyHighlighted !== row) {
                        currentlyHighlighted.classList.remove('highlighted-row');
                    }

                    // Toggle dòng hiện tại
                    if (row.classList.contains('highlighted-row')) {
                        row.classList.remove('highlighted-row');
                        currentlyHighlighted = null;
                    } else {
                        row.classList.add('highlighted-row');
                        currentlyHighlighted = row;
                    }

                    // Ngăn không cho sự kiện lan ra ngoài
                    e.stopPropagation();
                });
            });

            // Nếu click ra ngoài bảng thì bỏ chọn
            document.addEventListener('click', function() {
                if (currentlyHighlighted) {
                    currentlyHighlighted.classList.remove('highlighted-row');
                    currentlyHighlighted = null;
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.select_role').forEach(function(select) {
            function updateSelectColor(selectElement) {
                const value = selectElement.value;
                switch (value) {
                    case 'admin':
                        selectElement.style.backgroundColor = 'oklch(82.8% 0.111 230.318)'; // xám nhạt
                        break;
                    case 'khachhang':
                        selectElement.style.backgroundColor = 'oklch(70.4% 0.191 22.216)';
                        break;
                    case 'nhanvien':
                        selectElement.style.backgroundColor = 'oklch(0.828 0.189 84.429)';
                        break;
                }
            }

            // Gọi khi load trang
            updateSelectColor(select);

            // Gọi mỗi khi người dùng thay đổi lựa chọn
            select.addEventListener('change', function() {
                updateSelectColor(this);
                // Có thể thêm AJAX cập nhật trạng thái vào đây nếu muốn
            });
        });
    </script>

</body>

</html>