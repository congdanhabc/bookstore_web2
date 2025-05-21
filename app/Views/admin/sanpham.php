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
</head>

<style>
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
        margin-bottom: 25px;
    }

    .title_form h1 {
        font-weight: 700;
        color: oklch(68.5% 0.169 237.323);
        font-family: "Noto Sans", sans-serif;
        font-size: 21px;
        margin-bottom: 15px;
    }

    .search_product {
        gap: 25px;
        margin-bottom: 25px;
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

    .category_product select {
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
        z-index: 10;
        top: 0;
        position: sticky;
        border: 2px solid #3498db;
        font-family: 'Roboto', sans-serif;
        color: white;
        height: 40px;
        background: oklch(70.7% 0.165 254.624);
    }

    .content .recent-payments table tr th:nth-child(1) {
        text-align: center;
    }

    .content .recent-payments table tr th:nth-child(2) {
        text-align: center;
    }

    .content .recent-payments table tr th:nth-child(3) {
        text-align: center;
    }

    .content .recent-payments table tr th:nth-child(4) {
        text-align: center;
    }

    .content .recent-payments table tr th:nth-child(5) {
        text-align: center;
    }

    .content .recent-payments table tr th:nth-child(6) {
        text-align: center;
    }

    .content .recent-payments table tr th:nth-child(7) {
        text-align: center;
    }

    .content .recent-payments table tr th:nth-child(8) {
        text-align: center;
    }

    .form_add {
        padding-top: 15px;
        background: oklch(97% 0 0);
    }

    .form_add_1 {
        border-radius: 4px;
        margin: 0px 20px 0px 20px;
        border: 1px solid oklch(0.92 0.004 286.32);
        background-color: white;
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
        width: 60px;
        text-align: center;
        font-size: 18px;
    }

    .content .recent-payments table tr td:nth-child(2) {
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 200px;
        text-align: center;
    }

    .content .recent-payments table tr td:nth-child(3) {
        line-height: 25px;
        border: 2px solid oklch(0.92 0.004 286.32);
        padding-left: 20px;
        font-weight: 500;
        font-family: 'Roboto';
        width: 350px;
        text-align: left;
        font-size: 18px;
    }

    .content .recent-payments table tr td:nth-child(4) {
        padding-left: 20px;
        font-weight: 500;
        font-family: 'Roboto';
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 200px;
        text-align: left;
        font-size: 18px;
    }

    .content .recent-payments table tr td:nth-child(5) {
        font-size: 18px;
        padding-left: 20px;
        font-weight: 500;
        font-family: 'Roboto';
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 250px;
        text-align: left;
    }

    .content .recent-payments table tr td:nth-child(6) {
        font-size: 18px;
        padding-left: 20px;
        font-weight: 500;
        font-family: 'Roboto';
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 150px;
        text-align: left;
    }

    .content .recent-payments table tr td:nth-child(7) {
        font-size: 18px;
        border: 2px solid oklch(0.92 0.004 286.32);
        width: 150px;
        text-align: left;
        padding-left: 20px;
        font-weight: 500;
        font-family: 'Roboto';
    }

    .content .recent-payments table tr td:nth-child(8) {
        border: 2px solid oklch(0.92 0.004 286.32);
        text-align: center;
    }

    .th,
    td {
        border-bottom: 1px solid #dddddd;
    }

    img.profile-1 {
        margin-bottom: 5px;
        margin-top: 5px;
        width: 100px !important;
        height: 130px !important;
        padding: 5px 5px !important;
        align-items: center;
        justify-content: center;
    }

    .recent-payments table {
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
        padding: 12px 200px;
        border-radius: 5px;
        margin: 15px 0;
        width: fit-content;
    }

    .alert-success {
        font-weight: 500;
        font-family: 'Roboto';
        font-size: 17px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
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

    .manage_order {
        display: grid;
        padding: 60px 20px 0px 20px;
        background: oklch(97% 0 0);
    }

    .button_search_1 {
        width: 120px !important;
        font-weight: 600 !important;
        border-radius: 20px !important;
        border: none !important;
        font-family: 'Noto Sans' !important;
        font-size: 15px !important;
        text-align: center !important;
        background: linear-gradient(46.26deg, oklch(62.3% 0.214 259.815), #009edb 96.59%) !important;
        color: #fff !important;
        padding: 10px 0px !important;
        text-decoration: none !important;
        transition: background 0.3s ease-in-out !important;
    }

    .button_add_1 {
        display: unset !important;
        width: 120px !important;
        font-weight: 600 !important;
        border-radius: 20px !important;
        border: none !important;
        font-family: 'Noto Sans' !important;
        font-size: 15px !important;
        text-align: center !important;
        background: linear-gradient(46.26deg, oklch(62.3% 0.214 259.815), #009edb 96.59%) !important;
        color: #fff !important;
        padding: 10px 0px !important;
        text-decoration: none !important;
        transition: background 0.3s ease-in-out !important;
    }

    .handle_product {
        display: flex;
        gap: 25px;
    }

    .category_product select option {
        font-weight: 500;
        font-size: 16px;
        font-family: 'Roboto', sans-serif;
    }
</style>

<?php
include('../../html/db/connect.php');

// Lấy thể loại từ URL nếu có
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$selected_category = isset($_GET['category']) ? $_GET['category'] : '';
$selected_author = isset($_GET['author']) ? $_GET['author'] : '';
$selected_publishing = isset($_GET['publishing']) ? $_GET['publishing'] : '';


// Truy vấn sản phẩm có lọc theo thể loại nếu người dùng chọn
$sql_query = "SELECT sanpham.*, loaisanpham.ten_loai_sach, tacgia.ten_tac_gia, giatien.gia_khuyen_mai, giatien.gia, giatien.id_khoanggia, khoanggia.ten_khoang_gia, nhaxuatban.ten_nha_xuat_ban 
FROM sanpham
INNER JOIN giatien ON sanpham.id_sanpham = giatien.id_sanpham
INNER JOIN khoanggia ON giatien.id_khoanggia = khoanggia.id_khoanggia
INNER JOIN loaisanpham ON loaisanpham.id_loai_spham = sanpham.id_loai_spham
INNER JOIN tacgia ON tacgia.id_tacgia = sanpham.id_tacgia
INNER JOIN nhaxuatban ON nhaxuatban.id_nhaxuatban = sanpham.id_nhaxuatban";

if (!empty($selected_category)) {
    $selected_category = mysqli_real_escape_string($con, $selected_category);
    $conditions[] = "loaisanpham.ten_loai_sach = '$selected_category'";
}

if (!empty($selected_author)) {
    $selected_author = mysqli_real_escape_string($con, $selected_author);
    $conditions[] = "tacgia.ten_tac_gia = '$selected_author'";
}

if (!empty($selected_publishing)) {
    $selected_publishing = mysqli_real_escape_string($con, $selected_publishing);
    $conditions[] = "nhaxuatban.ten_nha_xuat_ban = '$selected_publishing'";
}

// Lọc theo keyword (mã hóa đơn hoặc họ tên)
if (!empty($keyword)) {
    // escape và thêm dấu % để LIKE
    $kw = mysqli_real_escape_string($con, $keyword);
    $conditions[] = "sanpham.ten_sach LIKE '%$kw%' ";
}

// Thêm điều kiện nếu có
if (!empty($conditions)) {
    $sql_query .= " WHERE " . implode(" AND ", $conditions);
}

// Sắp xếp
$sql_query .= " ORDER BY sanpham.id_sanpham ASC";

// Thực thi
$sql_sanpham = mysqli_query($con, $sql_query);

?>

<?php
include('../../html/db/connect.php');

$list_tacgia = mysqli_query($con, "SELECT * FROM tacgia");

$list_nxb = mysqli_query($con, "SELECT * FROM nhaxuatban");

$list_theloai = mysqli_query($con, "SELECT * FROM loaisanpham");

$list_khoanggia = mysqli_query($con, "SELECT * FROM khoanggia");
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
                <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'success'): ?>
                        <div class="alert_update">
                            <div class="alert alert-success">✅ Cập nhật sản phẩm thành công.</div>
                        </div>
                    <?php elseif ($_GET['status'] === 'error'): ?>
                        <div class="alert alert-danger">❌ Có lỗi xảy ra trong quá trình cập nhật.</div>
                    <?php endif; ?>
                <?php endif; ?>
                <h1 class="title_order">Quản lí sản phẩm</h1>
                <hr class="dash">
            </div>

            <div class="form_product">
                <div class="form_search">
                    <div class="form_search_1">
                        <div class="title_form">
                            <h1>Form tìm kiếm</h1>
                        </div>
                        <form method="GET" action="" class="handle_product">
                            <div class="search_product">
                                <div class="input_product">
                                    <input class="input_export" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Tên sản phẩm...">
                                </div>
                                <div class="category_product">
                                    <select name="category" onchange="this.form.submit()">
                                        <option value="">-- Thể loại sản phẩm --</option>
                                        <?php
                                        $sql_category = mysqli_query($con, "SELECT DISTINCT ten_loai_sach FROM loaisanpham");
                                        while ($row = mysqli_fetch_assoc($sql_category)) {
                                            $category = $row['ten_loai_sach'];
                                            $selected = (isset($_GET['category']) && $_GET['category'] == $category) ? 'selected' : '';
                                            echo "<option value=\"$category\" $selected>$category</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="category_product">
                                    <select name="author" onchange="this.form.submit()">
                                        <option value="">-- Tác giả --</option>
                                        <?php
                                        $sql_author = mysqli_query($con, "SELECT DISTINCT ten_tac_gia FROM tacgia");
                                        while ($row = mysqli_fetch_assoc($sql_author)) {
                                            $author = $row['ten_tac_gia'];
                                            $selected = (isset($_GET['author']) && $_GET['author'] == $author) ? 'selected' : '';
                                            echo "<option value=\"$author\" $selected>$author</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="category_product">
                                    <select name="publishing" onchange="this.form.submit()">
                                        <option value="">-- Nhà xuất bản --</option>
                                        <?php
                                        $sql_publishing = mysqli_query($con, "SELECT DISTINCT ten_nha_xuat_ban FROM nhaxuatban");
                                        while ($row = mysqli_fetch_assoc($sql_publishing)) {
                                            $publishing = $row['ten_nha_xuat_ban'];
                                            $selected = (isset($_GET['publishing']) && $_GET['publishing'] == $publishing) ? 'selected' : '';
                                            echo "<option value=\"$publishing\" $selected>$publishing</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="button_reset">
                                    <a href="../../Admin/interface/sanpham.php" style="text-decoration: none;">
                                        <button type="button" class="button_return">
                                            <i class="fa-solid fa-rotate-left"></i>
                                            <span>Trở về</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="form_add">
                <div class="form_add_1">
                    <div class="button_add">
                        <button class="button_add_1">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tạo mới</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="cards-1">
                    <div class="content-2">
                        <div class="recent-payments">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Tên sách</th>
                                        <th>Tác giả</th>
                                        <th>Nhà xuất bản</th>
                                        <th>Thể loại</th>
                                        <th>Giá tiền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    while ($row_sanpham = mysqli_fetch_array($sql_sanpham)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row_sanpham['id_sanpham'] ?></td>
                                            <td><img class="profile-1" src="../../img-index/<?php echo $row_sanpham['img'] ?>" alt=""></td>
                                            <td><?php echo $row_sanpham['ten_sach'] ?></td>
                                            <td><?php echo $row_sanpham['ten_tac_gia'] ?></td>
                                            <td><?php echo $row_sanpham['ten_nha_xuat_ban'] ?></td>
                                            <td><?php echo $row_sanpham['ten_loai_sach'] ?></td>
                                            <td><?php echo $row_sanpham['gia_khuyen_mai'] . 'đ' ?></td>
                                            <td>
                                                <button class="edit-btn"
                                                    data-id="<?php echo $row_sanpham['id_sanpham'] ?>"
                                                    data-img="<?php echo $row_sanpham['img'] ?>"
                                                    data-ten="<?php echo $row_sanpham['ten_sach'] ?>"
                                                    data-tacgia="<?php echo $row_sanpham['id_tacgia'] ?>"
                                                    data-nxb="<?php echo $row_sanpham['id_nhaxuatban'] ?>"
                                                    data-theloai="<?php echo $row_sanpham['id_loai_spham'] ?>"
                                                    data-gia="<?php echo $row_sanpham['gia'] ?>"
                                                    data-giakm="<?php echo $row_sanpham['gia_khuyen_mai'] ?>"
                                                    data-khoanggia="<?php echo $row_sanpham['id_khoanggia'] ?>">
                                                    <i class="fa-solid fa-pencil" style="color: #fcfcfc;"></i>
                                                </button>

                                                <button class="toggle-status-btn" data-id="<?= $row_sanpham['id_sanpham'] ?>" style="background-color: oklch(85.2% 0.199 91.936) !important;">
                                                    <?php if ($row_sanpham['trangthai'] == 1): ?>
                                                        <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                                                    <?php else: ?>
                                                        <i class="fa-solid fa-eye-slash" style="color: #fcfcfc;"></i>
                                                    <?php endif; ?>
                                                </button>

                                                <button class="btn-delete" data-id="<?= $row_sanpham['id_sanpham'] ?>">
                                                    <i class="fa-solid fa-trash" style="color: #fcfcfc;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- FORM CHỈNH SỬA SẢN PHẨM -->
                        <!-- Nền mờ -->
                        <div id="overlay" class="edit_product"></div>

                        <!-- FORM CHỈNH SỬA -->
                        <div id="editForm" class="form_edit">
                            <h2>Chỉnh sửa sản phẩm</h2>
                            <form method="POST" action="../../Admin/php/xulysanpham.php" enctype="multipart/form-data" class="font_label">
                                <input type="hidden" name="action" value="edit">

                                <input type="hidden" name="id_sanpham" id="edit-id">

                                <label>Tên sách:</label>
                                <input type="text" name="ten_sach" id="edit-ten" class="input-style"><br>

                                <div class="author_nxb">
                                    <div class="edit_form_add">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Tác giả:</th>
                                                    <th>Nhà xuất bản:</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td><select name="id_tac_gia" id="edit-tacgia" class="input-style-1">
                                                            <?php while ($row = mysqli_fetch_assoc($list_tacgia)) { ?>
                                                                <option value="<?php echo $row['id_tacgia']; ?>"><?php echo $row['ten_tac_gia']; ?></option>
                                                            <?php } ?>
                                                        </select></td>
                                                    <td><select name="id_nha_xuat_ban" id="edit-nxb" class="input-style-1">
                                                            <?php while ($row = mysqli_fetch_assoc($list_nxb)) { ?>
                                                                <option value="<?php echo $row['id_nhaxuatban']; ?>"><?php echo $row['ten_nha_xuat_ban']; ?></option>
                                                            <?php } ?>
                                                        </select></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <label>Thể loại:</label>
                                <select name="id_loai_sach" id="edit-theloai" class="input-style">
                                    <?php while ($row = mysqli_fetch_assoc($list_theloai)) { ?>
                                        <option value="<?php echo $row['id_loai_spham']; ?>"><?php echo $row['ten_loai_sach']; ?></option>
                                    <?php } ?>
                                </select>

                                <div class="price_pure_discount">
                                    <div class="edit_form_add">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Giá gốc:</th>
                                                    <th>Giá khuyến mãi:</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td style="width:50%;"><input type="text" name="gia" id="edit-gia" class="input-style-2"><br></td>
                                                    <td style="width:50%;"><input type="text" name="gia_khuyen_mai" id="edit-gia-km" class="input-style-3"><br></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <label>Khoảng giá:</label>
                                <select name="id_khoanggia" id="edit-khoang-gia" class="input-style">
                                    <?php while ($row = mysqli_fetch_assoc($list_khoanggia)) { ?>
                                        <option value="<?php echo $row['id_khoanggia']; ?>"><?php echo $row['ten_khoang_gia']; ?></option>
                                    <?php } ?>
                                </select>

                                <label>Ảnh hiện tại & ảnh mới:</label><br>
                                <div id="image-preview" style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px; margin-top: 10px;">
                                    <img id="preview-img" src="" alt="Ảnh hiện tại" style="width: 100px; height: auto; border: 1px solid #ccc; border-radius: 5px;">
                                    <span style="font-family: 'Roboto';font-size: 30px;font-weight: 900;">→</span>
                                    <img id="new-img-preview" src="" alt="Ảnh mới" style="width: 100px; height: auto; display: none; border: 1px solid #ccc; border-radius: 5px;">
                                </div>

                                <label>Hình ảnh mới (nếu muốn đổi):</label>
                                <input type="file" name="img" class="input-style" id="new-img-input"><br><br>

                                <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                                    <button type="submit" class="btn-green">💾 Lưu thay đổi</button>
                                    <button type="button" onclick="closeEditForm()" class="btn-red">❌ Hủy</button>
                                </div>
                            </form>
                        </div>

                        <!-- FORM THÊM SẢN PHẨM -->
                        <div id="addForm" class="form_edit" style="display: none;">
                            <h2>Thêm sản phẩm mới</h2>
                            <form method="POST" action="../../Admin/php/xulysanpham.php" enctype="multipart/form-data" class="font_label">
                                <input type="hidden" name="action" value="add">

                                <label>Tên sách:</label>
                                <input type="text" name="ten_sach" class="input-style" required><br>

                                <div class="author_nxb">
                                    <div class="edit_form_add">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Tác giả:</th>
                                                    <th>Nhà xuất bản:</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td><select name="id_tac_gia" class="input-style-1" required>
                                                            <?php mysqli_data_seek($list_tacgia, 0);
                                                            while ($row = mysqli_fetch_assoc($list_tacgia)) { ?>
                                                                <option value="<?= $row['id_tacgia'] ?>"><?= $row['ten_tac_gia'] ?></option>
                                                            <?php } ?>
                                                        </select></td>
                                                    <td><select name="id_nha_xuat_ban" class="input-style-1" required>
                                                            <?php mysqli_data_seek($list_nxb, 0);
                                                            while ($row = mysqli_fetch_assoc($list_nxb)) { ?>
                                                                <option value="<?= $row['id_nhaxuatban'] ?>"><?= $row['ten_nha_xuat_ban'] ?></option>
                                                            <?php } ?>
                                                        </select></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <label>Thể loại:</label>
                                <select name="id_loai_sach" class="input-style" required>
                                    <?php mysqli_data_seek($list_theloai, 0);
                                    while ($row = mysqli_fetch_assoc($list_theloai)) { ?>
                                        <option value="<?= $row['id_loai_spham'] ?>"><?= $row['ten_loai_sach'] ?></option>
                                    <?php } ?>
                                </select>

                                <div class="price_pure_discount">
                                    <div class="edit_form_add">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Giá gốc:</th>
                                                    <th>Giá khuyến mãi:</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td style="width:50%;"><input type="text" name="gia" class="input-style-2" required><br></td>
                                                    <td style="width:50%;"><input type="text" name="gia_khuyen_mai" class="input-style-3" required><br></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <label>Khoảng giá:</label>
                                <select name="id_khoanggia" class="input-style" required>
                                    <?php mysqli_data_seek($list_khoanggia, 0);
                                    while ($row = mysqli_fetch_assoc($list_khoanggia)) { ?>
                                        <option value="<?= $row['id_khoanggia'] ?>"><?= $row['ten_khoang_gia'] ?></option>
                                    <?php } ?>
                                </select>

                                <label>Hình ảnh:</label>
                                <input type="file" name="img" class="input-style" accept="image/*" id="new-img-input-1" required>
                                <img id="new-img-preview-1" src="" alt="Ảnh mới" style="width: 100px; height: auto; display: none; border: 1px solid #ccc; border-radius: 5px;margin-bottom: 20px;">

                                <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                                    <button type="submit" class="btn-green">📦 Thêm sản phẩm</button>
                                    <button type="button" onclick="closeAddForm()" class="btn-red">❌ Hủy</button>
                                </div>
                            </form>
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
                function closeEditForm() {
                    document.getElementById('editForm').style.display = 'none';
                    document.getElementById('overlay').style.display = 'none';
                }

                document.querySelectorAll('.edit-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        // Gán dữ liệu vào form
                        document.getElementById('edit-id').value = this.dataset.id;
                        document.getElementById('edit-ten').value = this.dataset.ten;
                        document.getElementById('edit-tacgia').value = this.dataset.tacgia;
                        document.getElementById('edit-nxb').value = this.dataset.nxb;
                        document.getElementById('edit-theloai').value = this.dataset.theloai;
                        document.getElementById('edit-gia').value = this.dataset.gia;
                        document.getElementById('edit-gia-km').value = this.dataset.giakm;
                        document.getElementById('edit-khoang-gia').value = this.dataset.khoanggia;
                        document.getElementById('preview-img').src = '../../img-index/' + this.dataset.img;

                        // Hiển thị form và nền mờ
                        document.getElementById('editForm').style.display = 'block';
                        document.getElementById('overlay').style.display = 'block';
                    });
                });
            </script>

            <script>
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(alert => alert.style.display = 'none');
                }, 2000);
            </script>

            <script>
                document.getElementById('new-img-input').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('new-img-preview');
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.src = '';
                        preview.style.display = 'none';
                    }
                });
            </script>

            <script>
                document.querySelector('.button_add button').addEventListener('click', function() {
                    document.getElementById('addForm').style.display = 'block';
                    document.getElementById('overlay').style.display = 'block';
                });

                function closeAddForm() {
                    document.getElementById('addForm').style.display = 'none';
                    document.getElementById('overlay').style.display = 'none';
                }
            </script>

            <script>
                document.getElementById('new-img-input-1').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('new-img-preview-1');
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.src = '';
                        preview.style.display = 'none';
                    }
                });
            </script>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).on('click', '.toggle-status-btn', function() {
                    let button = $(this);
                    let productId = button.data('id');

                    $.ajax({
                        url: '../../Admin/php/anhiensanpham.php',
                        method: 'POST',
                        data: {
                            id_sanpham: productId,
                            action: 'toggle'
                        },
                        success: function(response) {
                            try {
                                let json = JSON.parse(response);

                                if (json.action === 'hide' && json.has_invoice) {
                                    // Chỉ khi đang ẩn và có hóa đơn liên quan thì mới hiện danh sách
                                    let content = "<ul>";
                                    json.hoadon.forEach(function(hd, index) {
                                        content += `
                    <li>
                        <strong>Mã HĐ:</strong> ${hd.ma_hoadon} | <strong>Ngày:</strong> ${hd.ngay_tao} | <strong>Tổng:</strong> ${hd.tong_tien} <br>
                        <button onclick="xemChiTiet(${index})" class="btn btn-sm btn-info mt-1">Xem chi tiết</button>
                        <div id="ct-${index}" style="display:none; margin-top:10px;">
                            <ul>
                                ${hd.items.map(sp => `<li>${sp.name} - SL: ${sp.quantity} - Giá: ${sp.price}</li>`).join('')}
                            </ul>
                        </div>
                    </li><hr/>
                `;
                                    });
                                    content += "</ul><button class='btn btn-danger' onclick='tiepTucAnSanPham(" + productId + ")'>Vẫn ẩn sản phẩm này</button>";

                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Sản phẩm đang tồn tại trong các hóa đơn sau',
                                        html: content,
                                        width: 700,
                                        showConfirmButton: false
                                    });
                                } else if (json.success) {
                                    capNhatIcon(button, json.new_status);
                                } else {
                                    alert('Có lỗi xảy ra!');
                                }
                            } catch (e) {
                                console.error(e);
                                alert('Lỗi xử lý JSON từ server.');
                            }
                        }
                    });
                });

                // Mở chi tiết đơn hàng
                function xemChiTiet(index) {
                    let div = document.getElementById('ct-' + index);
                    div.style.display = (div.style.display === 'none') ? 'block' : 'none';
                }

                // Cập nhật icon hiển thị/ẩn
                function capNhatIcon(button, status) {
                    let icon = button.find('i');
                    let message = "";

                    if (status == 1) {
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                        message = "Sản phẩm đã được hiển thị.";
                    } else {
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                        message = "Sản phẩm đã được ẩn.";
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }

                // Nếu người dùng vẫn muốn ẩn
                function tiepTucAnSanPham(id_sanpham) {
                    $.ajax({
                        url: '../../Admin/php/anhiensanpham.php',
                        method: 'POST',
                        data: {
                            id_sanpham: id_sanpham,
                            force_hide: true,
                            action: 'toggle'
                        },
                        success: function(response) {
                            let json = JSON.parse(response);
                            if (json.success) {
                                let button = $('.toggle-status-btn[data-id="' + id_sanpham + '"]');
                                capNhatIcon(button, json.new_status);
                            } else {
                                Swal.fire('Lỗi', 'Không thể cập nhật trạng thái.', 'error');
                            }
                        }
                    });
                }
            </script>

            <script>
                $(document).on('click', '.btn-delete', function() {
                    let id = $(this).data('id');
                    Swal.fire({
                        title: 'Bạn có chắc muốn xóa sản phẩm này?',
                        text: "Hành động này không thể hoàn tác!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteProduct(id); // gọi hàm bạn đã viết
                        }
                    });
                });

                function deleteProduct(id_sanpham) {
                    fetch('../../Admin/php/anhiensanpham.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                action: 'delete',
                                id_sanpham: id_sanpham
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Xóa thành công!', '', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Lỗi', data.message || 'Xóa thất bại!', 'error');
                            }
                        });
                }
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const tableRows = document.querySelectorAll('table tbody tr');
                    let currentlyHighlighted = null;

                    tableRows.forEach(row => {
                        row.addEventListener('click', function(e) {
                            // Nếu click là trên nút thì không làm gì
                            if (
                                e.target.closest('.toggle-status-btn') ||
                                e.target.closest('.btn-delete') ||
                                e.target.closest('button') // để bắt tất cả các nút nếu cần
                            ) return;

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
                        });
                    });

                    // Nếu click ra ngoài bảng thì bỏ chọn
                    document.addEventListener('click', function(e) {
                        if (!e.target.closest('table') && currentlyHighlighted) {
                            currentlyHighlighted.classList.remove('highlighted-row');
                            currentlyHighlighted = null;
                        }
                    });
                });
            </script>

</body>

</html>