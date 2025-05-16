<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Đơn hàng</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    .card-title {
      font-weight: bold;
    }
    .chart-container {
      position: relative;
      height: 300px;
    }
  </style>
</head>
<body>
  <div class="container py-4">
    <h2 class="mb-4 text-center">Bảng điều khiển thống kê đơn hàng</h2>

    <!-- Cards Tổng Quan -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <div class="card text-white bg-primary">
          <div class="card-body">
            <h5 class="card-title">Tổng Đơn Hàng</h5>
            <p class="card-text fs-4">1,250</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-success">
          <div class="card-body">
            <h5 class="card-title">Đơn Đã Giao</h5>
            <p class="card-text fs-4">1,100</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-warning">
          <div class="card-body">
            <h5 class="card-title">Đơn Chờ Xác Nhận</h5>
            <p class="card-text fs-4">95</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-danger">
          <div class="card-body">
            <h5 class="card-title">Đơn Hủy</h5>
            <p class="card-text fs-4">55</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Biểu đồ Doanh thu theo tháng -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title">Doanh thu theo tháng</h5>
        <div class="chart-container">
          <canvas id="revenueChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('revenueChart');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],
        datasets: [{
          label: 'Doanh thu (VNĐ)',
          data: [12000000, 13500000, 14800000, 9900000, 16000000, 17500000],
          fill: true,
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value) {
                return value.toLocaleString('vi-VN') + 'đ';
              }
            }
          }
        }
      }
    });
  </script>
</body>
</html>
