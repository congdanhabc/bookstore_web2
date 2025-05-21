<?php
include('../../html/db/connect.php');

// Lấy doanh thu theo tháng
$sql_doanhthu_thang = mysqli_query($con, "
    SELECT 
        DATE_FORMAT(ngay_tao, '%Y-%m') AS thang,
        SUM(tong_tien) AS tong_doanh_thu
    FROM hoadon
    WHERE trang_thai = 'Đã giao'
    GROUP BY thang
    ORDER BY thang ASC
");

$labels = [];
$values = [];

while ($row = mysqli_fetch_assoc($sql_doanhthu_thang)) {
    $labels[] = $row['thang'];
    $values[] = $row['tong_doanh_thu'];
}
?>

<!-- Chart Container -->
<div class="card">
    <div class="frame_total">
        <i class="fa-solid fa-chart-column"></i>
        <div class="cardName">BIỂU ĐỒ DOANH THU THEO THÁNG</div>
    </div>
    <canvas id="revenueChart" height="100"></canvas>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Doanh thu theo tháng',
                data: <?php echo json_encode($values); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + ' đ';
                        }
                    }
                }
            }
        }
    });
</script>
