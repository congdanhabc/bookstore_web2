<?php
include('../../html/db/connect.php');

// Lấy id từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    die('ID hóa đơn không hợp lệ');
}

// Truy vấn chi tiết hóa đơn
$sql = "
  SELECT h.*, c.ten_chinhanh, c.diachi_cuthe
  FROM hoadon_daxoa h
  LEFT JOIN chinhanh c ON h.id_chinhanh = c.id_chinhanh
  WHERE h.id_hoadon = $id
";
$res = mysqli_query($con, $sql);
$inv = mysqli_fetch_assoc($res);
if (!$inv) {
    die('Không tìm thấy hóa đơn');
}

// Truy vấn các mặt hàng trong hóa đơn (giả sử có bảng hoadon_chitiet)
$sqlItems = "
  SELECT ct.*, sp.ten_sach, ct.so_luong, ct.don_gia, hoadon_daxoa.id_hoadon
  FROM chitietdonhang_daxoa ct
  INNER JOIN sanpham sp ON ct.id_sanpham = sp.id_sanpham
  INNER JOIN hoadon_daxoa ON hoadon_daxoa.id_hoadon = ct.id_hoadon
  WHERE ct.id_hoadon = $id
";
$resItems = mysqli_query($con, $sqlItems);
echo "<p>Tổng sản phẩm: " . mysqli_num_rows($resItems) . "</p>";
echo "<p>Đang truy vấn sản phẩm với ID: $id</p>";

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <!-- html2canvas để chụp ảnh nội dung -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <!-- jsPDF để xuất PDF -->
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Hóa đơn #<?php echo $inv['ma_hoadon']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .invoice-box {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td,
        .invoice-box table th {
            overflow: hidden;
            font-family: 'Roboto', sans-serif;
            /* color: black; */
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            font-weight: 500;
        }

        .invoice-box table th {
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
            color: white;
            background: #3366CC;
        }

        .invoice-header {
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            font-family: 'Roboto';
            align-items: center;
            height: 40px;
            background: #3366CC;
            justify-content: center;
            display: flex;
            color: white;
            margin: 0;
        }

        .details {
            margin-bottom: 30px;
        }

        .total {
            font-family: 'Roboto';
            color: #3366CC;
            text-align: right;
            font-size: 20px;
            font-weight: bold;
        }

        .export_pdf {
            justify-content: center;
            display: flex;
        }

        .export_pdf button {
            margin-top: 25px;
            justify-content: center;
            display: flex;
            width: 123px;
            font-weight: 600;
            border-radius: 2px;
            border: none;
            font-family: 'Noto Sans';
            font-size: 17px;
            text-align: center;
            background: oklch(84.1% 0.238 128.85);
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
        }

        .button_action {
            justify-content: center;
            gap: 20px;
            display: flex;
        }

        .button_return {
            margin-top: 25px;
            justify-content: center;
            display: flex;
            width: 123px;
            font-weight: 600;
            border-radius: 2px;
            border: none;
            font-family: 'Noto Sans';
            font-size: 17px;
            text-align: center;
            background: oklch(70.7% 0.165 254.624);
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
        }
    </style>

    <style>
        /* Áp dụng khoảng cách dòng cho toàn bộ invoice */
        #invoice-box table th,
        #invoice-box table td,
        #invoice-box .invoice-header p {
            font-family: 'Roboto';
            line-height: 1.6;
            font-size: 16px;
        }

        #invoice-box {
            background: white;
        }

        .invoice-box table tr th:nth-child(1) {
            font-family: 'Roboto';
            line-height: 1.6;
            font-size: 16px;
        }

        .details table tr td {
            width: 360px;
            font-family: 'Roboto';
            line-height: 1.6;
            font-size: 16px;
        }

        /* Ví dụ nếu bạn muốn riêng hàng trong bảng có khoảng cách cao hơn */
        #invoice-box table tr {
            height: 1.8em;
            /* tăng chiều cao mỗi hàng */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: gray;
        }
    </style>

</head>

<body>
    <div class="invoice-box" id="invoice-box">
        <div class="invoice-header">
            <h2>HÓA ĐƠN BÁN HÀNG</h2>
            <p>Mã hóa đơn: <strong><?php echo $inv['ma_hoadon']; ?></strong></p>
            <p>Ngày tạo: <?php echo date('d/m/Y', strtotime($inv['ngay_tao'])); ?></p>
        </div>

        <div class="details">
            <table>
                <tr>
                    <th>Khách hàng</th>
                    <td><?php echo htmlspecialchars($inv['ho_va_ten']); ?></td>
                    <th>Điện thoại</th>
                    <td><?php echo htmlspecialchars($inv['so_dien_thoai']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($inv['email']); ?></td>
                    <th>Địa chỉ</th>
                    <td><?php echo htmlspecialchars($inv['dia_chi'] . ', ' . $inv['phuong_xa'] . ', ' . $inv['quan_huyen'] . ',' . $inv['tinh_thanh']); ?></td>
                </tr>
                <tr>
                    <th>Chi nhánh</th>
                    <td colspan="3"><?php echo htmlspecialchars($inv['ten_chinhanh'] . ' - ' . $inv['diachi_cuthe']); ?></td>
                </tr>
                <tr>
                    <th>Lý do hủy hóa đơn</th>
                    <td colspan="3"><?php echo htmlspecialchars($inv['ly_do_xoa']); ?></td>
                </tr>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $total = 0;
                if (mysqli_num_rows($resItems) == 0): ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Không có sản phẩm trong hóa đơn</td>
                    </tr>
                <?php
                endif;
                while ($item = mysqli_fetch_assoc($resItems)):
                    $line = $item['so_luong'] * $item['don_gia'];
                    $total += $line;
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($item['ten_sach']); ?></td>
                        <td><?php echo $item['so_luong']; ?></td>
                        <td><?= number_format($item['don_gia'] * 1000, 0, ',', '.') . 'đ' ?></td>
                        <td><?= number_format($line * 1000, 0, ',', '.') . 'đ' ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>

        </table>

        <p class="total">Tổng cộng: <?php echo number_format($total * 1000, 0, ',', '.') . 'đ'; ?></p>

    </div>

    <div class="button_action">
        <div class="export_pdf">
            <button id="btn-export-pdf">Xuất PDF</button>
        </div>

        <div class="button_reset">
            <a href="../../Admin/interface/donhang.php" style="text-decoration: none;">
                <button type="button" class="button_return">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>Trở về</span>
                </button>
            </a>
        </div>
    </div>

    <script>
        document.getElementById('btn-export-pdf').addEventListener('click', () => {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF('p', 'pt', 'a4');
            const invoice = document.getElementById('invoice-box');

            html2canvas(invoice, {
                scale: 2
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgProps = doc.getImageProperties(imgData);
                const pdfWidth = doc.internal.pageSize.getWidth() - 40;
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                doc.addImage(imgData, 'PNG', 20, 40, pdfWidth, pdfHeight);
                doc.save(`HOADON_${new Date().getTime()}.pdf`);
            });
        });
    </script>
</body>

</html>