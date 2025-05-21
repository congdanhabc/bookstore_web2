<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/books.css">
</head>

<body>
    <?php include APP_DIR . '/Views/layout/header.php'; ?>

<div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Giỏ hàng của bạn</h1>

        <!-- Giỏ hàng trống (mặc định ẩn, sẽ hiển thị nếu giỏ hàng không có sản phẩm) -->
        <div id="empty-cart" class="bg-white rounded-lg shadow-md p-6 mb-6 text-center hidden">
            <div class="text-gray-500 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p class="text-xl">Giỏ hàng của bạn đang trống</p>
            </div>
            <p class="text-gray-600 mb-6">Hãy tiếp tục mua sắm để tìm sách bạn yêu thích!</p>
            <a href="index.html" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 inline-block">Tiếp tục mua sắm</a>
        </div>

        <!-- Giỏ hàng có sản phẩm -->
        <div id="cart-container" class="flex flex-col md:flex-row gap-6">
            <!-- Danh sách sản phẩm -->
            <div class="md:w-2/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">Sản phẩm</h2>
                    </div>

                    <!-- Danh sách sản phẩm -->
                    <div id="cart-items" class="divide-y divide-gray-200">
                        <!-- Các sản phẩm sẽ được thêm bằng JavaScript -->
                    </div>

                    <!-- Cập nhật giỏ hàng -->
                    <div class="p-4 bg-gray-50 flex justify-between">
                        <a href="/books" class="text-blue-600 hover:text-blue-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Tiếp tục mua sắm
                        </a>
                        <!-- <button id="update-cart" class="bg-gray-200 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-300">
                            Cập nhật giỏ hàng
                        </button> -->
                    </div>
                </div>
            </div>

            <!-- Tổng kết đơn hàng -->
            <div class="md:w-1/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">Tổng đơn hàng</h2>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between mb-3">
                            <span class="text-gray-600">Tạm tính</span>
                            <span id="subtotal" class="font-medium">0 VNĐ</span>
                        </div>
                        <div class="flex justify-between mb-3">
                            <span class="text-gray-600">Phí vận chuyển</span>
                            <span id="shipping" class="font-medium">30.000 VNĐ</span>
                        </div>
                        <div id="shipping-note" class="text-sm text-gray-500 mb-3">
                            <p>Miễn phí vận chuyển cho đơn hàng từ 300.000 VNĐ</p>
                        </div>
                        <div class="border-t my-3"></div>
                        <div class="flex justify-between mb-6">
                            <span class="text-lg font-medium">Tổng cộng</span>
                            <span id="total" class="text-lg font-bold text-blue-600">30.000 VNĐ</span>
                        </div>
                        <a href="/checkout" class="block bg-blue-600 text-white text-center py-3 px-4 rounded-md hover:bg-blue-700">
                            Tiến hành thanh toán
                        </a>
                    </div>
                </div>

                <!-- Mã giảm giá -->
                <!-- <div class="bg-white rounded-lg shadow-md overflow-hidden mt-6">
                    <div class="p-4">
                        <h2 class="text-lg font-medium text-gray-800 mb-3">Mã giảm giá</h2>
                        <div class="flex">
                            <input type="text" id="coupon-code" placeholder="Nhập mã giảm giá"
                                class="flex-1 border rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button id="apply-coupon" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-r-md hover:bg-gray-300">
                                Áp dụng
                            </button>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/js/cart.js"></script>
    <div style="margin-bottom: 50px;"></div>
    <?php include APP_DIR . '/Views/layout/footer.php'; ?>
</body>