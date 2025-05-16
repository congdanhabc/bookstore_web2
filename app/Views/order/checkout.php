<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/output.css">
</head>

<body>

    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Thanh toán</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Thông tin đơn hàng -->
            <div class="lg:w-1/2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">Thông tin giao hàng</h2>
                    </div>
                    <div class="p-6">
                        <form id="shipping-form" method="POST">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                                    <input type="text" id="name" name="name" required value="<?php echo htmlentities($user->name); ?>"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                                    <input type="tel" id="phone" name="phone" required value="<?php echo htmlentities($user->phone); ?>""
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" required value="<?php echo htmlentities($user->email); ?>"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div class="col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                                    <input type="text" id="address" name="address" required value="<?php echo htmlentities($user->address); ?>"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Tỉnh/Thành phố</label>
                                    <select id="province" name="city" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <?php
                                        foreach ($provinces as $province) {
                                            $selected = $province['id'] == $user->province_id ? 'selected' : '';
                                            echo('<option '. $selected .' value="' . htmlentities($province['id']) . '">' . htmlentities($province['name']) . '</option>');
                                        }
                                        ?>   
                                        <!-- Thêm các tỉnh/thành phố khác -->
                                    </select>
                                </div>

                                <div class="col-span-2">
                                    <label for="note" class="block text-sm font-medium text-gray-700 mb-1">Ghi chú</label>
                                    <textarea id="note" name="note" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">Phương thức thanh toán</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="radio" id="cod" name="payment_method" value="cod" checked
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <label for="cod" class="ml-3 block text-sm font-medium text-gray-700">
                                    Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="radio" id="vnpay" name="payment_method" value="vnpay"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <label for="vnpay" class="ml-3 block text-sm font-medium text-gray-700">
                                    Thanh toán qua VNPay
                                </label>
                            </div>

                            <div id="vnpay-info" class="hidden mt-4 p-4 bg-blue-50 rounded-md border border-blue-200">
                                <div class="flex items-center mb-3">
                                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR-1.png" alt="VNPay" class="h-10">
                                    <span class="ml-3 text-sm text-gray-700">Thanh toán an toàn với VNPay</span>
                                </div>
                                <p class="text-sm text-gray-600">Bạn sẽ được chuyển đến cổng thanh toán VNPay để hoàn tất thanh toán sau khi đặt hàng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tổng quan đơn hàng -->
            <div class="lg:w-1/2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">Đơn hàng của bạn</h2>
                    </div>

                    <div class="p-4 divide-y divide-gray-200">
                        <div id="order-items">
                            <?php foreach($data['cartItems'] as $item):?>
                            <div class="flex items-center justify-between py-4">
                                <div class="flex items-center">
                                    <img src="\images\books\<?php echo htmlentities($item['image'])?>" alt="<?php echo htmlentities($item['name'])?>" class="w-12 h-12 object-cover rounded-md mr-4">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-800"><?php echo htmlentities($item['name'])?></h3>
                                        <p class="text-sm text-gray-500"><?php echo htmlentities($item['quantity'])?> x <?php echo htmlentities(number_format($item['sale_price'], 0, ',', ' ')); ?> đ</p>
                                    </div>
                                </div>
                                <span class="font-medium"><?php echo htmlentities(number_format($item['sale_price'] * $item['quantity'], 0, ',', ' ')); ?> đ</span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="py-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Tạm tính</span>
                                <span id="checkout-subtotal" class="font-medium"><?php echo htmlentities(number_format($data['totalPrice'], 0, ',', ' ')); ?> đ</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Phí vận chuyển</span>
                                <span id="checkout-shipping" class="font-medium">
                                    <?php 
                                    if ($data['totalPrice'] >= 300000) {
                                        echo 'Miễn phí';
                                    } else {
                                        echo '30.000 đ';
                                    }
                                    ?>
                                </span>
                            </div>
                            <?php if ($data['totalPrice'] < 300000):?>
                                <div id="free-shipping-message" class="text-sm text-green-600 mb-2">
                                    Miễn phí vận chuyển cho đơn hàng từ 300.000 VNĐ
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="py-4">
                            <div class="flex justify-between">
                                <span class="text-lg font-medium">Tổng thanh toán</span>
                                <span id="checkout-total" class="text-lg font-bold text-blue-600">
                                    <?php 
                                    if ($data['totalPrice'] >= 300000) {
                                        echo htmlentities(number_format($data['totalPrice'], 0, ',', ' '));
                                    } else {
                                        echo htmlentities(number_format($data['totalPrice'] + 30000, 0, ',', ' '));
                                    }
                                    ?>
                                 đ</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50">
                        <button id="place-order" class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700">
                            Đặt hàng
                        </button>
                        <p class="text-sm text-gray-500 mt-3">
                            Bằng cách nhấn "Đặt hàng", bạn đồng ý với
                            <a href="#" class="text-blue-600 hover:underline">Điều khoản dịch vụ</a> và
                            <a href="#" class="text-blue-600 hover:underline">Chính sách bảo mật</a> của chúng tôi.
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-center mb-6">
                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Icon-VNPAY-QR-1024x800.png" alt="VNPay" class="h-10 mr-2">
                    <img src="https://inkythuatso.com/uploads/thumbnails/800/2021/09/logo-momo-inkythuatso-01-13-16-04-11.jpg" alt="MoMo" class="h-10 mr-2">
                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-Visa-Blue-2006-2014.png" alt="Visa" class="h-7 mr-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/800px-Mastercard-logo.svg.png" alt="Mastercard" class="h-7">
                </div>

                <div class="flex items-center justify-center">
                    <a href="/cart" class="text-blue-600 hover:text-blue-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Quay lại giỏ hàng
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 50px;"></div>
</body>

<script>
    // Đảm bảo rằng script này chạy sau khi DOM đã được tải đầy đủ
    document.addEventListener('DOMContentLoaded', () => {

        const form = document.getElementById('shipping-form');
        // Sửa lỗi cú pháp: ID cần nằm trong dấu nháy đơn hoặc kép
        const place_orderBtn = document.getElementById('place-order');
        const selectedPaymentMethodInput = document.querySelector('input[name="payment_method"]:checked');

        // Kiểm tra xem cả form và nút có tồn tại trên trang không
        if (form && place_orderBtn) {
            // Thêm trình lắng nghe sự kiện 'click' cho nút
            place_orderBtn.addEventListener('click', (event) => {
                event.preventDefault();

                // 1. Thu thập dữ liệu từ form sử dụng FormData
                const formData = new FormData(form);

                // 2. Chuyển đổi FormData sang một đối tượng JavaScript đơn giản
                // để dễ dàng chuyển thành JSON.
                // (Backend thường mong đợi JSON cho các yêu cầu phức tạp như checkout)
                const jsonData = {};
                formData.forEach((value, key) => {
                    // Lưu ý: Logic này chỉ xử lý trường hợp mỗi tên input có 1 giá trị duy nhất.
                    // Nếu có nhiều checkbox/select cùng tên, cần xử lý phức tạp hơn.
                    jsonData[key] = value;
                });

                jsonData['total_amount'] = document.getElementById('checkout-total').textContent;
                jsonData['payment_method'] = selectedPaymentMethodInput.value;

                // Chuyển đối tượng JS thành chuỗi JSON
                const jsonString = JSON.stringify(jsonData);

                console.log('Dữ liệu gửi đi:', jsonData); // Log dữ liệu để kiểm tra

                // 3. Gửi yêu cầu POST đến server bằng Fetch API
                fetch('/checkout_submit', {
                    method: 'POST', // Phương thức HTTP
                    headers: {
                        'Content-Type': 'application/json', // Báo cho server biết dữ liệu gửi đi là JSON
                        // *** QUAN TRỌNG: THÊM CSRF TOKEN HEADER NẾU BACKEND CÓ BẢO VỆ CSRF ***
                        // Nếu hệ thống của bạn sử dụng CSRF protection, bạn cần lấy token
                        // và thêm vào header. Token thường được đặt trong thẻ meta.
                        // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: jsonString // Body của request là chuỗi JSON dữ liệu form
                })
                .then(response => {
                    // 4. Xử lý phản hồi từ server
                    // Kiểm tra xem response có thành công không (status code 2xx)
                    if (!response.ok) {
                        // Nếu không thành công, cố gắng đọc response body để lấy thông báo lỗi từ server
                        // Giả định server trả về lỗi dưới dạng JSON
                        return response.json().then(errorData => {
                            console.error('Đặt hàng thất bại (Server):', errorData);
                            // Hiển thị thông báo lỗi cho người dùng
                            alert('Đặt hàng thất bại: ' + (errorData.message || response.statusText));
                            // Bạn có thể thêm logic hiển thị lỗi cụ thể hơn gần các trường input
                        });
                    }
                    // Nếu thành công, parse response body dưới dạng JSON
                    return response.json();
                })
                .then(data => {
                    // 5. Xử lý dữ liệu thành công từ server
                    console.log('Đặt hàng thành công (Server):', data);

                    // Dựa vào dữ liệu trả về từ server để thực hiện hành động tiếp theo
                    // Ví dụ: server trả về { success: true, redirect_url: '/thank-you' }
                    if (data.success) {
                        alert('Đặt hàng thành công!');
                        if (data.redirect_url) {
                            // Chuyển hướng người dùng đến trang cảm ơn hoặc trang khác
                            window.location.href = data.redirect_url;
                            // Hoặc dùng replace để không cho quay lại trang checkout bằng nút Back
                            // window.location.replace(data.redirect_url);
                        } else {
                            // Cập nhật giao diện trên trang hiện tại (ví dụ: xóa giỏ hàng mini)
                        }
                    } else {
                        // Trường hợp server trả về success: false nhưng status code vẫn là 2xx
                        alert('Đặt hàng không thành công: ' + (data.message || 'Lỗi không xác định.'));
                    }
                })
                .catch(error => {
                    // Xử lý các lỗi trong quá trình fetch (ví dụ: lỗi mạng)
                    console.error('Lỗi khi gửi yêu cầu:', error);
                    alert('Có lỗi xảy ra khi kết nối đến server. Vui lòng thử lại.');
                });
            });

            // *** Tùy chọn: Thêm client-side validation trước khi gửi ***
            // Bạn nên thêm logic kiểm tra dữ liệu form (không được bỏ trống, định dạng email...)
            // ngay tại đây, trước khi gọi fetch(...).
            // Nếu form không hợp lệ, hiển thị thông báo cho người dùng và KHÔNG gọi fetch.
            // Ví dụ:
            // if (!form.checkValidity()) {
            //    alert('Vui lòng điền đầy đủ và chính xác thông tin.');
            //    // Hoặc hiển thị thông báo validation gần các trường input lỗi
            //    return; // Dừng xử lý
            // }


        } else {
            console.error('Không tìm thấy form hoặc nút đặt hàng. Kiểm tra ID.');
        }
    });
</script>

</html>