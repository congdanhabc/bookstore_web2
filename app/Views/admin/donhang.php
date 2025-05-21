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

// var_dump($username);
// var_dump($user);
// var_dump($_SESSION['role']);
?>

<?php
$sql_user = mysqli_query($con, "SELECT user.* FROM user");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/doan.css">
    <link rel="stylesheet" href="../../css/new_products.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Book Store</title>
    <!-- html2canvas để chụp ảnh nội dung -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <!-- jsPDF để xuất PDF -->
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>

</head>

<style>
    .main {
        background: oklch(97% 0 0)
    }

    body {
        overflow-y: scroll;
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

    .form_product {
        padding-top: 40px;
        background: oklch(97% 0 0);
    }

    .form_search {
        border-radius: 5px;
        margin: 0px 20px 0px 20px;
        border: 1px solid oklch(0.92 0.004 286.32);
        background-color: white;
    }

    .title_form {
        padding: 15px 0px 0px 25px;
        border-bottom: 1px solid oklch(0.92 0.004 286.32);
        margin-bottom: 15px;
    }

    .title_form h1 {
        font-weight: 700;
        color: oklch(68.5% 0.169 237.323);
        font-family: "Noto Sans", sans-serif;
        font-size: 21px;
        margin-bottom: 15px;
    }

    .search_product {
        overflow: hidden;
        gap: 15px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .input_product {
        margin-left: 22px;
    }

    .input_product input {
        font-family: 'Roboto', sans-serif;
        width: 240px;
        border-radius: 2px;
        outline: none;
        height: 45px;
        font-size: 15px;
        padding: 10px;
        border: 2px solid #3498db;
        border-radius: 2px;
    }

    .classify_status select {
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

    .button_search button {
        width: 120px;
        font-weight: 600;
        border-radius: 20px;
        border: none;
        font-family: 'Noto Sans';
        font-size: 15px;
        text-align: center;
        background: linear-gradient(46.26deg, oklch(62.3% 0.214 259.815), #009edb 96.59%) !important;
        color: #fff;
        padding: 10px 0px;
        text-decoration: none;
        transition: background 0.3s ease-in-out;
    }

    .recent-payments {
        position: relative;
        display: grid;
        min-height: unset !important;
        background: var(--white);
        padding: unset !important;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
        border-radius: unset !important;
    }

    .content {
        background: oklch(97% 0 0);
    }

    .recent-payments thead tr th {
        font-size: 17px;
        z-index: 10;
        top: 0;
        border: 2px solid #3498db;
        font-family: 'Roboto', sans-serif;
        color: white;
        height: 40px;
        background: oklch(70.7% 0.165 254.624);
    }

    .content .recent-payments table tr th {
        text-align: center;
    }

    .form_add {
        padding-top: 15px;
        background: oklch(97% 0 0);
    }

    .form_add_1 {
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        display: flex;
        padding: 20px 0px;
        border-radius: 4px;
        margin: 0px 20px 0px 20px;
        border: 1px solid oklch(0.92 0.004 286.32);
        background-color: white;
    }

    .classify_delivery select option {
        font-weight: 500;
        font-size: 15px;
        font-family: 'Roboto', sans-serif;
    }

    .classify_receive select option {
        font-weight: 500;
        font-size: 15px;
        font-family: 'Roboto', sans-serif;
    }

    .classify_status select option {
        font-weight: 500;
        font-size: 16px;
        font-family: 'Roboto', sans-serif;
    }

    .button_add {
        margin: 15px 15px 15px 0px;
        justify-content: end;
        display: flex;
    }

    .button_add button {
        cursor: pointer;
        display: flex;
        font-weight: 600;
        border-radius: 2px;
        border: none;
        font-family: 'Noto Sans';
        font-size: 15px;
        text-align: center;
        background: oklch(63.7% 0.237 25.331);
        color: #fff;
        padding: 11px 8px;
        text-decoration: none;
        transition: background 0.3s ease-in-out;
    }

    .button_add i {
        margin-right: 5px;
        font-size: 19px;
    }

    .content-2 {
        width: 100%;
        overflow-x: auto;
        max-height: 1000px;
        overflow-y: auto;
        border: 1px solid oklch(0.92 0.004 286.32);
    }

    .container .content .cards-1 {
        padding: 4px 20px !important;
    }

    .content .recent-payments table tr td:nth-child(1) {
        font-weight: 500;
        border: 2px solid oklch(0.92 0.004 286.32);
        font-family: 'Roboto';
        width: 500px;
        text-align: center;
        font-size: 18px;
        height: 80px;
    }

    .content .recent-payments table tr td:nth-child(2) {
        font-size: 18px;
        font-weight: 500;
        font-family: 'Roboto';
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 700px;
        text-align: center;
    }

    .content .recent-payments table tr td:nth-child(3) {
        line-height: 25px;
        border: 2px solid oklch(0.92 0.004 286.32);
        font-weight: 500;
        font-family: 'Roboto';
        width: 2700px;
        text-align: center;
        font-size: 18px;
    }

    .content .recent-payments table tr td:nth-child(4) {
        font-weight: 500;
        font-family: 'Roboto';
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1500px;
        text-align: center;
        font-size: 18px;
    }

    .content .recent-payments table tr td:nth-child(5) {
        font-size: 18px;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 400px;
        text-align: center;
    }

    .content .recent-payments table tr td:nth-child(6) {
        font-size: 18px;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 2000px;
        text-align: center;
    }

    .content .recent-payments table tr td:nth-child(7) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1000px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(8) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 2000px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(9) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1500px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(10) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1900px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(11) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1950px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(12) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1500px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(13) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1500px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(14) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1600px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(15) {
        line-height: 30px;
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 6500px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(16) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 800px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(17) {
        line-height: 30px;
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 2000px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(18) {
        line-height: 30px;
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1200px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(19) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1500px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(20) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 1700px;
        text-align: center;
        /* padding-left: 20px; */
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(21) {
        width: 1700px;
        border: 2px solid oklch(0.92 0.004 286.32);
        text-align: center;
    }

    .th,
    td {
        border-bottom: 1px solid #dddddd;
    }

    img.profile-1 {
        margin-bottom: 10px;
        margin-top: 10px;
        width: 120px !important;
        height: 160px !important;
        padding: 5px 5px !important;
        align-items: center;
        justify-content: center;
    }

    .recent-payments table {
        min-width: 4500px;
        width: 100%;
        border-collapse: collapse;
    }

    .recent-payments tbody tr:nth-child(even) {
        background-color: oklch(98.5% 0.001 106.423);
        /* Màu xám nhạt cho dòng lẻ */
    }

    .recent-payments tbody tr:nth-child(odd) {
        background-color: white;
        /* Màu trắng cho dòng chẵn */
    }

    td button:nth-child(1) {
        height: 35px;
        width: 35px;
        outline: none;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        padding: unset !important;
        color: #ffffff;
        background-color: oklch(76.8% 0.233 130.85);
    }

    td button:nth-child(2) {
        height: 35px;
        width: 35px;
        outline: none;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        padding: unset !important;
        color: #ffffff;
    }

    td button:nth-child(3) {
        height: 35px;
        width: 35px;
        outline: none;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        padding: unset !important;
        color: #ffffff;
        background-color: oklch(63.7% 0.237 25.331);
    }

    .input-style {
        font-family: 'Roboto', sans-serif;
        width: 100%;
        padding: 10px;
        margin: 6px 0 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 17px;
        box-sizing: border-box;
        outline: none;
    }

    .input-style option {
        font-family: 'Roboto', sans-serif;
        font-size: 17px;
    }

    .btn-green {
        font-family: 'Roboto', sans-serif;
        font-size: 17px;
        padding: 13px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-green:hover {
        background-color: #45a049;
    }

    .btn-red {
        font-family: 'Roboto', sans-serif;
        font-size: 17px;
        padding: 10px 20px;
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-red:hover {
        background-color: #e53935;
    }

    @media screen and (max-width: 600px) {
        #editForm {
            width: 90%;
            padding: 20px;
        }

        .btn-green,
        .btn-red {
            flex: 1;
            width: 100%;
        }
    }

    .edit_product {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .form_edit {
        display: none;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 550px;
        z-index: 999;
        font-family: 'Segoe UI', sans-serif;
    }


    .alert {
        padding: 12px 100px !important;
        border-radius: 5px;
        margin: unset !important;
        width: fit-content;
    }

    .alert-success {
        font-weight: 500;
        font-family: 'Roboto';
        font-size: 17px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        transition: opacity 0.5s ease-in-out;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert_update {
        display: flex;
        justify-content: center;
    }

    .form_edit h2 {
        font-family: "Roboto", sans-serif;
        margin-bottom: 20px;
        color: oklch(63.7% 0.237 25.331);
    }

    .font_label label {
        font-weight: 500;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
    }

    .author_nxb {
        display: flex;
    }

    .edit_form_add {
        display: flex;
    }

    .infor_nxb {
        display: flex;
    }

    .price_pure_discount {
        display: flex;
    }

    .price_pure {
        display: flex;
    }

    .price_discount {
        display: flex;
    }

    .edit_form_add table thead tr {
        text-align: left;
    }

    .edit_form_add table thead tr th {
        font-weight: 500;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
    }

    .edit_form_add table tbody tr td {
        padding-right: 40px;
        border-bottom: unset !important
    }

    .input-style-1 {
        font-family: 'Roboto', sans-serif;
        width: 120%;
        padding: 10px;
        margin: 6px 0 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 17px;
        box-sizing: border-box;
        outline: none;
    }

    .input-style-2 {
        width: 115%;
        font-family: 'Roboto', sans-serif;
        padding: 10px;
        margin: 6px 0 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 17px;
        box-sizing: border-box;
        outline: none;
    }

    .input-style-3 {
        width: 120%;
        font-family: 'Roboto', sans-serif;
        padding: 10px;
        margin: 6px 0 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 17px;
        box-sizing: border-box;
        outline: none;
    }

    .swal2-title {
        font-family: 'Roboto';
        position: relative;
        max-width: 100%;
        margin: 0;
        padding: 5px;
        color: oklch(63.7% 0.237 25.331);
        font-size: 25px;
        font-weight: 600;
        text-align: center;
        text-transform: none;
        word-wrap: break-word;
    }

    .swal2-icon.swal2-warning {
        font-size: 16px;
        border-color: oklch(63.7% 0.237 25.331);
        color: oklch(63.7% 0.237 25.331);
    }

    .swal2-html-container strong {
        font-family: 'Roboto';
    }

    .swal2-html-container li {
        color: black;
        margin-top: 15px;
    }

    .swal2-html-container div ul li {
        color: black;
        margin-bottom: 15px;
    }

    .swal2-html-container button {
        border: 2px solid oklch(70.7% 0.165 254.624);
        font-weight: 600;
        font-size: 15px;
        font-family: 'Roboto';
        margin: 13px 10px 5px 0px;
        position: relative;
        padding: 10px 10px;
        background: var(--blue);
        text-decoration: none;
        color: var(--white);
        border-radius: 4px;
    }

    .swal2-html-container {
        z-index: 1;
        justify-content: center;
        margin: 0px 10px 10px 10px;
        padding: 0;
        overflow: auto;
        color: inherit;
        font-size: 1.125em;
        font-weight: normal;
        line-height: normal;
        text-align: center;
        word-wrap: break-word;
        word-break: break-word;
    }

    .highlighted-row {
        background-color: #d1e7fd !important;
        /* màu nền tô đậm */
        font-weight: bold;
    }

    .status-select {
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

    .status-select:hover {
        border-color: #999;
        background-color: #f1f1f1;
    }

    .status-select:focus {
        outline: none;
        border-color: #5c9ded;
        box-shadow: 0 0 0 3px rgba(92, 157, 237, 0.3);
    }

    .status-select option {
        background-color: white;
        color: #333;
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

    .button_search,
    .button_reset,
    .button_history {
        display: inline-block;
    }

    .button_history_1 {
        margin-right: 15px;
        width: 120px;
        font-weight: 600;
        border-radius: 20px;
        border: none;
        font-family: 'Noto Sans';
        font-size: 15px;
        text-align: center;
        background: linear-gradient(46.26deg, oklch(62.3% 0.214 259.815), #009edb 96.59%) !important;
        color: #fff;
        padding: 10px 0px;
        text-decoration: none;
        transition: background 0.3s ease-in-out;
    }

    .input_date {
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

    .input_date_range {
        margin-bottom: 17px;
        gap: 15px;
        display: inline-flex;
    }

    .from_date {
        display: grid;
    }

    .from_date label {
        font-weight: 600;
        color: oklch(62.3% 0.214 259.815);
        width: 69px;
        margin-left: 6px;
        font-family: 'Roboto', sans-serif;
        font-size: 15px;
        position: relative;
        transform: translateY(25%);
        background: white;
        padding: 0 5px;
        transition: all 0.3s ease-in-out;
        pointer-events: none;
    }

    .to_date label {
        font-weight: 600;
        color: oklch(62.3% 0.214 259.815);
        width: 77px;
        margin-left: 6px;
        font-family: 'Roboto', sans-serif;
        font-size: 15px;
        position: relative;
        transform: translateY(25%);
        background: white;
        padding: 0 5px;
        transition: all 0.3s ease-in-out;
        pointer-events: none;
    }

    .to_date {
        display: grid;
    }

    .button_return {
        width: 120px;
        font-weight: 600;
        border-radius: 20px;
        border: none;
        font-family: 'Noto Sans';
        font-size: 15px;
        text-align: center;
        background: linear-gradient(46.26deg, oklch(62.3% 0.214 259.815), #009edb 96.59%) !important;
        color: #fff;
        padding: 10px 0px;
        text-decoration: none;
        transition: background 0.3s ease-in-out;
    }

    .location_filters .input_export {
        font-family: 'Roboto', sans-serif;
        width: 230px;
        outline: none;
        box-shadow: none;
        height: 45px;
        font-size: 15px;
        padding: 10px;
        border: 2px solid #3498db;
        border-radius: 2px;
    }

    table tbody tr {
        transition: background-color 0.3s ease;
    }

    table td {
        transition: background-color 0.3s ease;
    }

    .search_kieu_giao {
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
        border-radius: 20px;
    }

    .search_nhan_hang {
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
        border-radius: 20px;
    }

    /* Nền mờ */
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        /* Màu tối có độ mờ */
        z-index: 999;
    }

    /* Modal trung tâm */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 50%;
        top: 30%;
        transform: translate(-50%, -50%);
        padding: 30px;
        border-radius: 12px;
        max-height: 80vh;
        overflow-y: auto;
        width: 60%;
    }

    /* Nút đóng */
    .close-btn {
        font-size: 40px;
        color: oklch(63.7% 0.237 25.331);
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .close-btn:hover {
        color: red;
    }

    /* Modal content */
    .modal-content {
        position: relative;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        width: 90%;
        max-width: 1000px;
        margin: auto;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        overflow-x: auto;
    }

    .modal-content-1 {
        position: relative;
        padding: 10px 20px 20px 20px;
        background-color: #fff;
        border-radius: 12px;
        width: 90%;
        max-width: 1000px;
        margin: auto;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        overflow-x: auto;
    }

    /* Bảng hóa đơn đã xóa */
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Segoe UI', sans-serif;
        font-size: 15px;
    }

    table th,
    table td {
        border: 1px solid #ddd;
        padding: 0px 15px;
        text-align: center;
    }

    table th {
        background-color: #007BFF;
        color: white;
        font-weight: 600;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #e9f5ff;
        transition: 0.2s;
    }

    /* Nút khôi phục */
    .return {
        font-size: 15px;
        font-family: 'Roboto', sans-serif;
        outline: none;
        border: none;
        border-radius: 6px;
        padding: 12px !important;
        color: #ffffff;
        background-color: #28a745;
        padding: 8px 16px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .return:hover {
        background-color: #218838;
    }

    .success-alert {
        font-weight: 500;
        font-family: 'Roboto';
        font-size: 17px;
        background-color: #d4edda;
        color: #155724;
        border: 2px solid green;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert_update {
        display: flex;
        justify-content: center;
    }

    .title_model {
        margin-bottom: 20px;
        justify-content: space-between;
        flex-direction: row-reverse;
        align-items: center;
        display: flex;
    }

    .title_model h3 {
        color: oklch(62.3% 0.214 259.815);
        font-weight: 700;
        font-family: 'Roboto', sans-serif;
        font-size: 22px;
    }

    .history_bill th {
        border: 2px solid blue;
        padding: 10px 20px;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        background-color: #007BFF;
        color: white;
        font-weight: 600;
    }

    .infor_history td {
        font-family: 'Roboto';
        font-size: 16px;
        border: 1px solid #ddd;
        padding: 5px 20px;
        text-align: center;
    }

    .reason_delete {
        margin-bottom: 10px;
        justify-content: space-between;
        align-items: center;
        display: flex;
        flex-direction: row-reverse;
    }

    .reason_delete h3 {
        color: oklch(58.8% 0.158 241.966);
        font-family: 'Roboto';
        font-size: 20px;
    }

    .confirm_delete {
        width: 120px;
        font-weight: 600;
        border-radius: 2px;
        border: none;
        font-family: 'Roboto';
        font-size: 15px;
        text-align: center;
        background: linear-gradient(46.26deg, oklch(62.3% 0.214 259.815), #009edb 96.59%) !important;
        color: #fff;
        padding: 10px 0px;
        text-decoration: none;
        transition: background 0.3s ease-in-out;
    }

    .input_reason {
        font-size: 15px;
        font-family: 'Roboto';
        outline: none;
        padding: 10px 10px;
        resize: auto;
        border: 1px solid oklch(58.8% 0.158 241.966);
        box-shadow: none;
        margin-top: 1px;
        width: 100%;
        height: 100px;
    }

    .modal_1 {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 50%;
        top: 30%;
        transform: translate(-50%, -50%);
        padding: 30px;
        border-radius: 12px;
        max-height: 80vh;
        overflow-y: auto;
        width: 30%;
    }

    .edit_delete {
        display: flex;
        justify-content: center;
    }

    td button:nth-child(2) {
        height: 35px;
        width: 35px;
        outline: none;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        padding: unset !important;
        color: #FFFFFF;
        background-color: red;
    }

    .box_success {
        justify-content: center;
        display: flex;
    }

    .table_history {
        max-height: 300px;
        overflow-y: auto;
    }

    .table_history table {
        width: 100%;
        border-collapse: collapse;
    }

    .table_history thead th {
        position: sticky;
        top: 0;
        /* màu nền cho hàng tiêu đề */
        z-index: 2;
    }
</style>

<?php
include('../../html/db/connect.php');

// Lấy giá trị trạng thái từ URL nếu có
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
$tinh_thanh = isset($_GET['tinh_thanh']) ? $_GET['tinh_thanh'] : '';
$quan_huyen = isset($_GET['quan_huyen']) ? $_GET['quan_huyen'] : '';
$phuong_xa = isset($_GET['phuong_xa']) ? $_GET['phuong_xa'] : '';
$kieu_giao_hang = isset($_GET['kieu_giao_hang']) ? $_GET['kieu_giao_hang'] : '';
$phuongthucnhan = isset($_GET['phuongthucnhan']) ? $_GET['phuongthucnhan'] : '';

$sql_query = "SELECT hoadon.*, chinhanh.ten_chinhanh, chinhanh.diachi_cuthe 
              FROM hoadon
              LEFT JOIN chinhanh ON hoadon.id_chinhanh = chinhanh.id_chinhanh
              WHERE 1";

// Lọc theo trạng thái nếu có
if (!empty($status_filter)) {
    $status_filter = mysqli_real_escape_string($con, $status_filter);
    $sql_query .= " AND hoadon.trang_thai = '$status_filter'";
}

// Lọc theo khoảng thời gian giao hàng
if (!empty($from_date)) {
    $sql_query .= " AND hoadon.ngay_giao_hang >= '$from_date'";
}
if (!empty($to_date)) {
    $sql_query .= " AND hoadon.ngay_giao_hang <= '$to_date'";
}

if (!empty($tinh_thanh)) {
    $tinh_thanh = mysqli_real_escape_string($con, $tinh_thanh);
    $sql_query .= " AND hoadon.tinh_thanh LIKE '%$tinh_thanh%'";
}

if (!empty($quan_huyen)) {
    $quan_huyen = mysqli_real_escape_string($con, $quan_huyen);
    $sql_query .= " AND hoadon.quan_huyen LIKE '%$quan_huyen%'";
}

if (!empty($phuong_xa)) {
    $phuong_xa = mysqli_real_escape_string($con, $phuong_xa);
    $sql_query .= " AND hoadon.phuong_xa LIKE '%$phuong_xa%'";
}

if (!empty($kieu_giao_hang)) {
    $kieu_giao_hang = mysqli_real_escape_string($con, $kieu_giao_hang);
    $sql_query .= " AND hoadon.kieu_giao_hang = '$kieu_giao_hang'";
}

if (!empty($phuongthucnhan)) {
    $phuongthucnhan = mysqli_real_escape_string($con, $phuongthucnhan);
    $sql_query .= " AND hoadon.phuongthucnhan = '$phuongthucnhan'";
}

// Lọc theo keyword (mã hóa đơn hoặc họ tên)
if (!empty($keyword)) {
    // escape và thêm dấu % để LIKE
    $kw = mysqli_real_escape_string($con, $keyword);
    $sql_query .= " AND (
        hoadon.ma_hoadon LIKE '%$kw%' 
        OR hoadon.ho_va_ten LIKE '%$kw%'
    )";
}

$sql_query .= " ORDER BY hoadon.id_hoadon DESC";

$sql_hoadon = mysqli_query($con, $sql_query);

?>

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

            <div class="manage_order">
                <?php if (isset($_SESSION['success_add'])): ?>
                    <div class="box_success">
                        <div class="alert success-alert" id="success-alert">
                            <?= $_SESSION['success_add']; ?>
                        </div>
                    </div>
                    <?php unset($_SESSION['success_add']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert-error" id="error-alert">
                        <?= $_SESSION['error']; ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                <h1 class="title_order">Quản lí đơn hàng</h1>
                <hr class="dash">
            </div>

            <form method="GET">
                <div class="form_product">
                    <div class="form_search">
                        <div class="form_search_1">
                            <div class="title_form">
                                <h1>Form tìm kiếm</h1>
                            </div>
                            <div class="search_product">
                                <div class="input_product">
                                    <input class="input_export" name="keyword" placeholder="Tìm kiếm..." value="<?php echo htmlspecialchars($keyword); ?>">
                                </div>


                                <?php $status_filter = isset($_GET['status']) ? $_GET['status'] : ''; ?>

                                <div class="classify_status">
                                    <select class="search_status" name="status">
                                        <option value="">-- Tất cả vai trò --</option>
                                        <option value="Chờ xác nhận" <?php if ($status_filter == 'Chờ xác nhận') echo 'selected'; ?>>Chờ xác nhận</option>
                                        <option value="Đã xác nhận" <?php if ($status_filter == 'Đã xác nhận') echo 'selected'; ?>>Đã xác nhận</option>
                                        <option value="Đã giao" <?php if ($status_filter == 'Đã giao') echo 'selected'; ?>>Đã giao</option>
                                        <option value="Đã hủy" <?php if ($status_filter == 'Đã hủy') echo 'selected'; ?>>Đã hủy</option>
                                    </select>
                                </div>

                                <div class="input_date_range">
                                    <div class="from_date">
                                        <label>Từ ngày:</label>
                                        <input class="input_date" type="date" name="from_date" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>">
                                    </div>

                                    <div class="to_date">
                                        <label>Đến ngày:</label>
                                        <input class="input_date" type="date" name="to_date" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>">
                                    </div>
                                </div>

                                <div class="location_filters" style="display: flex; gap: 15px;">
                                    <div class="filter_item">
                                        <input class="input_export" type="text" name="tinh_thanh" placeholder="Tỉnh thành" value="<?php echo isset($_GET['tinh_thanh']) ? $_GET['tinh_thanh'] : ''; ?>">
                                    </div>
                                    <div class="filter_item">
                                        <input class="input_export" type="text" name="quan_huyen" placeholder="Quận huyện" value="<?php echo isset($_GET['quan_huyen']) ? $_GET['quan_huyen'] : ''; ?>">
                                    </div>
                                    <div class="filter_item">
                                        <input class="input_export" type="text" name="phuong_xa" placeholder="Phường xã" value="<?php echo isset($_GET['phuong_xa']) ? $_GET['phuong_xa'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form_add">
                    <div class="form_add_1">
                        <?php
                        $kieu_giao_hang_filter = isset($_GET['kieu_giao_hang']) ? $_GET['kieu_giao_hang'] : '';
                        $phuongthucnhan_filter = isset($_GET['phuongthucnhan']) ? $_GET['phuongthucnhan'] : '';
                        ?>

                        <div class="classify_delivery">
                            <select class="search_kieu_giao" name="kieu_giao_hang">
                                <option value="">-- Phương thức giao hàng --</option>
                                <option value="Giao khi có hàng" <?php if ($kieu_giao_hang_filter == 'Giao khi có hàng') echo 'selected'; ?>>Giao khi có hàng</option>
                                <option value="Chọn thời gian" <?php if ($kieu_giao_hang_filter == 'Chọn thời gian') echo 'selected'; ?>>Chọn thời gian</option>
                            </select>
                        </div>

                        <div class="classify_receive">
                            <select class="search_nhan_hang" name="phuongthucnhan">
                                <option value="">-- Phương thức nhận hàng --</option>
                                <option value="Giao hàng tận nơi" <?php if ($phuongthucnhan_filter == 'Giao hàng tận nơi') echo 'selected'; ?>>Giao hàng tận nơi</option>
                                <option value="Nhận tại cửa hàng" <?php if ($phuongthucnhan_filter == 'Nhận tại cửa hàng') echo 'selected'; ?>>Nhận tại cửa hàng</option>
                            </select>
                        </div>
                        <div class="button_search">
                            <button type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <span>Tìm kiếm</span>
                            </button>
                        </div>
                        <div class="button_reset">
                            <a href="../../Admin/interface/donhang.php" style="text-decoration: none;">
                                <button type="button" class="button_return">
                                    <i class="fa-solid fa-rotate-left"></i>
                                    <span>Trở về</span>
                                </button>
                            </a>
                        </div>
                        <div class="button_history">
                            <button id="btn-history" type="button" class="button_history_1">
                                <i class="fa-regular fa-clock"></i>
                                <span>Lịch sử</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="content">
                <div class="cards-1">
                    <div class="content-2">
                        <div class="recent-payments">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã hóa đơn</th>
                                        <th>Họ và Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Tỉnh thành</th>
                                        <th>Quận huyện</th>
                                        <th>Phường xã</th>
                                        <th>Phương thức giao hàng</th>
                                        <th>Phương thức nhận hàng</th>
                                        <th>Ngày giao hàng</th>
                                        <th>Thời gian giao</th>
                                        <th>Tên chi nhánh</th>
                                        <th>Địa chỉ chi nhánh</th>
                                        <th>Mã giảm giá</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Ngày tạo</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                    function hienThiGiaTri($value, $default = 'Không có')
                                    {
                                        return isset($value) && $value !== null && $value !== '' ? $value : $default;
                                    }

                                    while ($row_hoadon = mysqli_fetch_array($sql_hoadon)) {
                                    ?>
                                        <tr>
                                            <td><?php echo hienThiGiaTri($row_hoadon['id_hoadon']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['ma_hoadon']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['ho_va_ten']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['email']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['so_dien_thoai']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['dia_chi']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['tinh_thanh']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['quan_huyen']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['phuong_xa']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['kieu_giao_hang']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['phuongthucnhan']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['ngay_giao_hang']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['start_time'], '00:00:00') . ' - ' . hienThiGiaTri($row_hoadon['end_time'], '00:00:00') ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['ten_chinhanh']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['diachi_cuthe']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['magiamgia']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['phuongthucthanhtoan']) ?></td>
                                            <td><?php echo hienThiGiaTri($row_hoadon['ngay_tao']) ?></td>
                                            <td><?php echo number_format(hienThiGiaTri($row_hoadon['tong_tien']), 0, ',', '.') . 'đ'; ?></td>
                                            <td>
                                                <select class="status-select" data-id="<?php echo $row_hoadon['id_hoadon']; ?>">
                                                    <option value="Chờ xác nhận" <?php if ($row_hoadon['trang_thai'] == 'Chờ xác nhận' || $row_hoadon['trang_thai'] == null || $row_hoadon['trang_thai'] == '') echo 'selected'; ?>>Chờ xác nhận</option>
                                                    <option value="Đã xác nhận" <?php if ($row_hoadon['trang_thai'] == 'Đã xác nhận') echo 'selected'; ?>>Đã xác nhận</option>
                                                    <option value="Đã giao" <?php if ($row_hoadon['trang_thai'] == 'Đã giao') echo 'selected'; ?>>Đã giao</option>
                                                    <option value="Đã hủy" <?php if ($row_hoadon['trang_thai'] == 'Đã hủy') echo 'selected'; ?>>Đã hủy</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button class="edit-btn">
                                                    <i class="fa-solid fa-file-lines" style="color: #fcfcfc;"></i>
                                                </button>

                                                <button class="toggle-status-btn" style="background-color: oklch(85.2% 0.199 91.936) !important;">
                                                    <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                                                </button>

                                                <button id="btn-delete" class="btn-delete" onclick="showDeleteReasonModal(<?php echo $row_hoadon['id_hoadon']; ?>)">
                                                    <i class="fa-solid fa-trash" style="color: #fcfcfc;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Overlay nền mờ -->
            <div id="overlay" style="display:none;"></div>

            <!-- Form popup lịch sử -->
            <div id="deleted-invoices-modal" class="modal">
                <div class="modal-content">
                    <div class="title_model">
                        <span class="close-btn" onclick="closeHistoryModal()">&times;</span>
                        <h3>Danh sách các hóa đơn đã xóa</h3>
                    </div>
                    <div class="table_history">
                        <div class="table_delete">
                            <table border="1" cellpadding="10" cellspacing="0">
                                <thead>
                                    <tr class="history_bill">
                                        <th>Mã hóa đơn</th>
                                        <th>Khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày xóa</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result_deleted = mysqli_query($con, "SELECT *, khachhang.ho_ten FROM hoadon_daxoa
                    INNER JOIN khachhang ON khachhang.id_khachhang = hoadon_daxoa.id_khachhang");
                                    while ($row = mysqli_fetch_assoc($result_deleted)) {
                                        echo '<tr class="infor_history">
                        <td>' . $row['ma_hoadon'] . '</td>
                        <td>' . $row['ho_ten'] . '</td>
                        <td>' . number_format($row['tong_tien'], 0, ',', '.') . 'đ</td>
                        <td>' . $row['ngay_tao'] . '</td>
                        <td>' . $row['deleted_at'] . '</td>
                        <td> 
                           <button class="edit-btn-1" data-id="' . $row['id_hoadon'] . '">
                           <i class="fa-solid fa-file-lines" style="color: #fcfcfc;"></i>
                           </button> 
                           <button class="button_delete" data-id="' . $row['id_hoadon'] . '">
                           <i class="fa-solid fa-trash" style="color: #fcfcfc;"></i>
                           </button>
                        </td>
                      </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form popup lý do -->
            <div id="delete-reason-modal" class="modal_1" style="display:none;">
                <div class="modal-content-1">
                    <div class="reason_delete">
                        <span class="close-btn" onclick="closeDeleteReasonModal()">&times;</span>
                        <h3>Nhập lý do xóa</h3>
                    </div>
                    <form id="delete-reason-form" method="POST" action="../../Admin/php/xulyhoadon.php?action=delete_with_reason">
                        <input type="hidden" name="id_hoadon" id="delete-id">
                        <textarea class="input_reason" name="ly_do_xoa" required placeholder="Nhập lý do..." style="width: 100%; height: 100px;"></textarea>
                        <br><br>
                        <div class="edit_delete">
                            <button type="submit" name="submit_delete_reason" class="confirm_delete">Xác nhận xóa</button>
                        </div>
                    </form>
                </div>
            </div>

            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

            <script>
                // Tự ẩn thông báo thành công sau 3 giây
                const successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    setTimeout(() => {
                        successAlert.style.opacity = '0';
                        setTimeout(() => successAlert.style.display = 'none', 500); // chờ hiệu ứng opacity kết thúc
                    }, 3000);
                }

                // (Tùy chọn) Nếu muốn tự ẩn cả lỗi
                const errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                    setTimeout(() => {
                        errorAlert.style.opacity = '0';
                        setTimeout(() => errorAlert.style.display = 'none', 500);
                    }, 3000);
                }
            </script>

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
                document.addEventListener('DOMContentLoaded', function() {
                    const selects = document.querySelectorAll('.status-select');

                    selects.forEach(select => {
                        select.addEventListener('change', function() {
                            const id_hoadon = this.dataset.id;
                            const trang_thai_moi = this.value;

                            fetch('../../Admin/php/xulyhoadon.php?action=update_status', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: `id_hoadon=${id_hoadon}&trang_thai=${encodeURIComponent(trang_thai_moi)}`
                                })
                                .then(response => response.text())
                                .then(data => {
                                    alert('✅ Cập nhật trạng thái thành công!');
                                })
                                .catch(error => {
                                    alert('❌ Cập nhật thất bại!');
                                    console.error('Lỗi:', error);
                                });
                        });
                    });
                });
            </script>


            <script>
                document.querySelectorAll('.status-select').forEach(function(select) {
                    function updateSelectColor(selectElement) {
                        const value = selectElement.value;
                        switch (value) {
                            case 'Chờ xác nhận':
                                selectElement.style.backgroundColor = 'oklch(82.8% 0.111 230.318)';
                                selectElement.style.color = '#0c5460';
                                break;
                            case 'Đã xác nhận':
                                selectElement.style.backgroundColor = 'oklch(90.5% 0.182 98.111)';
                                selectElement.style.color = '#856404';
                                break;
                            case 'Đã giao':
                                selectElement.style.backgroundColor = 'oklch(89.7% 0.196 126.665)';
                                selectElement.style.color = '#155724';
                                break;
                            case 'Đã hủy':
                                selectElement.style.backgroundColor = 'oklch(70.4% 0.191 22.216)';
                                selectElement.style.color = 'oklch(50.5% 0.213 27.518)';
                                break;
                        }
                    }

                    updateSelectColor(select);
                    select.addEventListener('change', function() {
                        updateSelectColor(this);
                    });
                });
            </script>


            <!-- <script>
                document.querySelector('.search_status').addEventListener('change', function() {
                    const selectedStatus = this.value;
                    window.location.href = "?status=" + encodeURIComponent(selectedStatus);
                });
            </script> -->

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const kieuGiao = "<?php echo strtolower($kieu_giao_hang_filter); ?>";
                    const phuongThucNhan = "<?php echo strtolower($phuongthucnhan_filter); ?>";

                    const rows = document.querySelectorAll("table tbody tr");

                    rows.forEach(row => {
                        const kieuGiaoCell = row.children[9]; // Cột 10
                        const nhanHangCell = row.children[10]; // Cột 11

                        if (kieuGiao && kieuGiaoCell && kieuGiaoCell.textContent.toLowerCase().includes(kieuGiao)) {
                            kieuGiaoCell.style.backgroundColor = "oklch(93.2% 0.032 255.585)"; // vàng nhạt
                        }

                        if (phuongThucNhan && nhanHangCell && nhanHangCell.textContent.toLowerCase().includes(phuongThucNhan)) {
                            nhanHangCell.style.backgroundColor = "oklch(93.2% 0.032 255.585)"; // xanh nhạt
                        }
                    });
                });
            </script>

            <script>
                document.querySelectorAll('.edit-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        // Lấy id hóa đơn từ data-id (ta sẽ đặt thêm bên dưới)
                        const id = this.closest('tr').querySelector('.status-select').getAttribute('data-id');
                        // Chuyển hướng tới trang invoice.php với tham số id
                        window.location.href = `../../Admin/interface/hoadon.php?id=${id}`;
                    });
                });
            </script>

            <script>
                document.querySelectorAll('.edit-btn-1').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        window.location.href = `../../Admin/interface/hoadondaxoa.php?id=${id}`;
                    });
                });
            </script>


            <script>
                function confirmDelete(billId) {
                    if (confirm("Bạn có chắc chắn muốn xóa hóa đơn này không?")) {
                        window.location.href = '../../Admin/php/xulyhoadon.php?action=delete_direct&id_hoadon=' + billId;
                    }
                }
            </script>

            <script>
                document.getElementById('btn-history').addEventListener('click', function() {
                    document.getElementById('overlay').style.display = 'block';
                    document.getElementById('deleted-invoices-modal').style.display = 'block';
                });

                function closeHistoryModal() {
                    document.getElementById('overlay').style.display = 'none';
                    document.getElementById('deleted-invoices-modal').style.display = 'none';
                }
            </script>

            <script>
                function showDeleteReasonModal(id) {
                    document.getElementById('delete-id').value = id;
                    document.getElementById('overlay').style.display = 'block';
                    document.getElementById('delete-reason-modal').style.display = 'block';
                }

                function closeDeleteReasonModal() {
                    document.getElementById('overlay').style.display = 'none';
                    document.getElementById('delete-reason-modal').style.display = 'none';
                }
            </script>

            <script>
                document.querySelectorAll('.button_delete').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');

                        if (confirm("Bạn có chắc chắn muốn xóa hóa đơn này không?")) {
                            fetch('../../Admin/php/xulyhoadon.php?action=delete_restore_data', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: 'id_hoadon=' + encodeURIComponent(id)
                                })
                                .then(res => res.text())
                                .then(data => {
                                    const trimmed = data.trim();
                                    if (trimmed === 'not_admin') {
                                        alert("❌ Bạn không có quyền xóa hóa đơn. Chỉ tài khoản admin mới được phép!");
                                    } else if (trimmed === 'success') {
                                        alert("✅ Xóa thành công!");
                                        location.reload();
                                    } else {
                                        alert("⚠️ Có lỗi xảy ra. Vui lòng thử lại.");
                                    }
                                });
                        }
                    });
                });
            </script>


</body>

</html>