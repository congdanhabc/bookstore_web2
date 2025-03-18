<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="/js/productinfo.js"></script>
</head>

<body class="font-sans bg-gray-100">
    <?php include APP_DIR . '/Views/layout/header.php'; ?>

    <div class="bg-gray-100">
        <div class="mainprinfo bg-gray-100">
            <ul class="mainprinfo-list  ml-[157px] flex list-none py-2 px-2">
                <li class="mainprinfo-item  mainprinfo-btn relative pr-1"><a href="#" class="text-blue-500 font-semibold text-sm hover:underline">Trang chủ</a></li>
                <li class="mainprinfo-item  mainprinfo-btn-1 relative ml-[3px] pr-1"><a href="#" class="text-blue-500 font-semibold text-sm hover:underline">Kỹ năng - Công cụ</a></li>
                <li class="mainprinfo-item  mainprinfo-btn-2 ml-[3px] mt-[3px] text-gray-600 font-semibold text-sm"> Combo sách của Phan Văn Trường: Thay đổi một suy nghĩ, thay đổi cả cuộc đời - Một đời như kẻ tìm đường - Một đời quản trị - Một đời thương thuyết</li>
            </ul>
        </div>

        <div class="bg-gray-100 pt-0.5">
            <div class="grid-productinfo  max-w-[1170px] mx-auto px-4">
                <div class="grid-productinfo__row flex flex-wrap mx-[-7px]">
                    <div class="grid__column-5  bg-white h-fit px-[50px] py-[50px] flex justify-center">
                        <?php if ($book->price != $book->sale_price) : ?>
                            <div class="off-info relative">
                                <h2 class="sm-title absolute top-0 left-0 w-21 text-center bg-red-500 text-white inline-block p-2 text-sm font-bold z-10">SALE OFF</h2>
                            </div>
                        <?php endif; ?>
                        <div class="img-product text-center h-fit">
                            <img src="\images\books\<?php echo htmlentities($book->image); ?>" alt="" class="h-[470px] w-[320px]">
                        </div>
                    </div>
                    <div class="grid__column-7 w-full md:w-1/2 lg:w-[54%] px-2.5">
                        <div class="include-info bg-white leading-7">
                            <div class="name-product pt-[17px] px-[7px] text-red-500 text-sm font-bold">
                                <h1 class="text-xl lg:text-2xl"><?php echo htmlentities($book->name) ; ?></h1>
                            </div>
                            <div class="tilte-product mt-[10px]">
                                <ul class="tilte-product-info flex list-none">
                                    <li class="info-product relative pr-1 flex px-[7px]">
                                        <h5 class="text-cyan-500 font-bold text-sm lg:text-base">Tác giả:</h5>
                                        <span class="hr-product px-[5px] text-orange-500 font-bold text-sm lg:text-base"><?php echo htmlentities($book->author) ; ?></span>
                                    </li>
                                    <li class="info-product-1 flex px-[7px]">
                                        <h5 class="text-cyan-500 font-bold text-sm lg:text-base mr-1">NXB:</h5>
                                        <span class="text-orange-500 font-bold text-sm lg:text-base"><?php echo htmlentities($book->publisher) ; ?></span>
                                    </li>
                                </ul>
                                <form action="/cart/add/<?php echo $book->id; ?>" method="post">
                                    <ul class="price-product-info flex list-none pt-[20px]">
                                        <?php if ($book->sale_price != $book->price): ?>
                                            <li class="product-price px-[7px] text-gray-500 line-through text-sm lg:text-base">
                                                <p><?php echo htmlentities(number_format($book->price, 0, ',', ' ')); ?> đ</p>
                                            </li>
                                        <?php endif; ?>
                                        <li class="product-price-1 px-[5px] text-orange-500 font-bold text-xl lg:text-2xl">
                                            <p><?php echo htmlentities(number_format($book->sale_price, 0, ',', ' ')); ?> đ</p>
                                        </li>
                                        <?php if ($book->sale_price != $book->price): ?>
                                            <li class="price-down bg-red-500 text-white text-sm h-fit px-2 py-1 ml-3">
                                                <h2 class=" "><?php echo htmlentities(number_format(100 - ($book->sale_price / $book->price) * 100, 0, ',', ' ')); ?>% GIẢM</h2>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                    <ul class="button-product-info flex list-none">
                                        <li class="button-product-quantity">
                                            <div class="flex m-5 items-center rounded-full border border-gray-300 overflow-hidden">
                                                <button type="button" id="decrement" class="px-3 py-2 text-gray-600 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                                                    -
                                                </button>
                                                <input type="text" id="numberInput" oninput="validateNumberInput(this)" class="w-16 text-center focus:outline-none border-none appearance-none" value="1"/>
                                                <button type="button" id="increment" class="px-3 py-2 text-gray-600 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                                                    +
                                                </button>
                                            </div>
                                        </li>
                                        <li class="button-product-addcart">
                                            <button class="button-product-1 bg-orange-500 hover:bg-orange-600 text-white border-none w-fit h-10 lg:h-10 mt-5 lg:mt-5 px-4 rounded">
                                                <a href="../html/cart.html" class="text-white font-bold text-sm lg:text-base tracking-wide">THÊM VÀO GIỎ HÀNG</a>
                                            </button>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <div class="button-info mt-2">
                            <ul class="flex list-none">
                                <li>
                                    <button class="bg-cyan-500 hover:bg-cyan-600 text-white text-lg border-none w-fit h-12 lg:h-14 font-bold px-4 rounded mr-3">Freeship cho đơn hàng từ 1 triệu đồng</button>
                                </li>
                                <li>
                                    <button class="bg-cyan-500 hover:bg-cyan-600 text-white text-lg border-none w-fit h-12 lg:h-14 font-bold px-4 rounded">Cam kết bảo mật thông tin khách hàng</button>
                                </li>
                            </ul>
                        </div>
                        <div class="include-product-information mt-2 bg-white">
                            <div class="product-information bg-white mt-2">
                                <div class="dropbtn5 text-orange-500 font-extrabold text-sm lg:text-base no-underline inline-block py-4 px-2">THÔNG TIN SẢN PHẨM</div>
                                <ul class="filter_product" id="Dropdown5">
                                    <li>
                                        <div class="pro-inf px-2">
                                            <ul class="flex list-none">
                                                <li class="info-first text-cyan-500 text-sm lg:text-base pt-1">Ngày xuất bản: </li>
                                                <li class="info-second-2 text-cyan-500 text-sm text-bold lg:text-base pt-1 ml-2"><?php echo htmlentities($book->publish_year) ; ?></li>
                                            </ul>
                                            <ul class="flex list-none">
                                                <li class="info-first text-cyan-500 text-sm lg:text-base pt-1">Kích thước: </li>
                                                <li class="info-second-3 text-cyan-500 text-sm lg:text-base pt-1 ml-2"><?php echo htmlentities($book->size) ; ?></li>
                                            </ul>
                                            <ul class="flex list-none">
                                                <li class="info-first text-cyan-500 text-sm lg:text-base pt-1">Loại bìa: </li>
                                                <li class="info-second-4 text-cyan-500 text-sm lg:text-base pt-1 ml-2"><?php echo htmlentities($book->cover_type) ; ?></li>
                                            </ul>
                                            <ul class="flex list-none">
                                                <li class="info-first text-cyan-500 text-sm lg:text-base pt-1">Số trang: </li>
                                                <li class="info-second-5 text-cyan-500 text-sm lg:text-base pt-1 ml-2"><?php echo htmlentities($book->page) ; ?></li>
                                            </ul>
                                            <ul class="flex list-none">
                                                <li class="info-first text-cyan-500 text-sm lg:text-base pt-1">Nhà xuất bản: </li>
                                                <li class="info-second-6 text-cyan-500 text-sm lg:text-base pt-1 ml-2"><?php echo htmlentities($book->publisher) ; ?></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="product-describe leading-6  py-5 px-2">
                                            <h3 class="text-orange-500 font-extrabold text-sm lg:text-base no-underline inline-block">MÔ TẢ SẢN PHẨM</h3>
                                            <h4 class="text-cyan-500 font-semibold text-sm lg:text-base pt-1"><?php echo htmlentities($book->description) ; ?></h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="dash-page">
                                <hr class="dash-3">
                            </div>
                            <div class="product-information-1 bg-white">
                                <div class="dropbtn6 text-orange-500 font-extrabold text-sm lg:text-base no-underline inline-block py-4 px-2">DỊCH VỤ GIAO HÀNG</div>
                                <ul class="filter_product" id="Dropdown6">
                                    <li>
                                        <div class="icon-product px-2">
                                            <ul class="list-none">
                                                <li class="ico-att pb-6 relative">
                                                    <span class="icon-pr absolute top-[-5px] text-3xl text-cyan-500 pr-2"><i class='bx bx-check-shield' ></i></span>
                                                    <span class="attention text-cyan-500 text-sm lg:text-base ml-[53px]">Cam kết 100% chính hãng</span>
                                                </li>
                                                <li class="ico-att-1 relative pb-6">
                                                    <span class="icon-pr-1 absolute top-0 text-3xl text-cyan-500 pr-2"><i class='bx bxs-truck' ></i></span><span class="attention-1 text-cyan-500 text-sm lg:text-base ml-[54px]">Giao hàng dự kiến</span>
                                                    <br>
                                                    <strong class="attention-2 text-orange-500 font-bold text-sm lg:text-base ml-[55px]">Thứ 2 - Thứ 6 từ 9h00 - 17h00</strong>
                                                </li>
                                                <li class="ico-att-2 relative pb-8">
                                                    <span class="icon-pr-2 absolute top-0 text-3xl text-cyan-500 pr-2"><i class='bx bx-revision'></i></span><span class="attention-3 text-cyan-500 text-sm lg:text-base ml-[56px]">Hỗ trợ 24/7</span>
                                                    <br>
                                                    <strong class="attention-4 text-orange-500 font-bold text-sm lg:text-base ml-[56px]">Với các kênh chat, email & phone</strong>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- <div class="comment mt-2 bg-white">
                            <h3 class="text-orange-500 font-extrabold text-sm lg:text-base inline-block py-4 px-2 pb-12">KHÁCH HÀNG NHẬN XÉT</h3>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="dash-page-1 mt-10">
                <hr class="dash-4">
            </div>
        </div>

        <div class="recomment bg-gray-100 min-h-screen">
            <div class="recomment-1 text-center pt-10">
                <h3 class="text-red-500 text-2xl lg:text-3xl font-bold">Gợi ý Sách liên quan</h3>
            </div>
            <div class="recomment-2 text-center pt-16 pb-6">
                <h3 class="text-red-500 text-2xl lg:text-3xl font-bold">Sản phẩm liên quan</h3>
            </div>
            <div class="include px-4">
                <div class="product-kind max-w-[1250px] mx-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-y-8 text-center pl-10">
                    <div class="product-1">
                        <a href="#"><img class="image-1" src="../img-productinfo/sach48 (2).jpg" alt=""></a>
                        <div class="text">
                            <h1 class="text-1 text-left mt-2 text-gray-700 text-sm">Nhà xuất bản lẻ</h1>
                            <p class="text-2 text-left mt-1"><a href="#" class="no-underline hover:underline text-sm text-cyan-700">Thế Gian Này Dẫu Đẹp Nhưng Cũng Chẳng Bằng Em</a></p>
                        </div>
                        <div class="price mt-2 text-left text-sm">
                            <p class="price-index text-blue-800 font-bold">140,000đ</p>
                            <p class="price-index-1 text-gray-500 line-through inline-block ml-2">120,000đ</p>
                        </div>
                        <div class="star mt-1 text-left">
                            <p><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i></p>
                        </div>
                        <button class="buy bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2"><a href="../html/formlogin.html" class="no-underline text-white">BUY NOW</a></button>
                    </div>
                    <div class="product-1">
                        <a href="#"><img class="image-1" src="../img-productinfo/sach49.jpg" alt=""></a>
                        <div class="text">
                            <h1 class="text-1 text-left mt-2 text-gray-700 text-sm">Nhà xuất bản lẻ</h1>
                            <p class="text-2 text-left mt-1"><a href="#" class="no-underline hover:underline text-sm text-cyan-700">Không Biết Làm Sao Để Trưởng Thành</a></p>
                        </div>
                        <div class="price mt-2 text-left text-sm">
                            <p class="price-index text-blue-800 font-bold">175,000đ</p>
                            <p class="price-index-1 text-gray-500 line-through inline-block ml-2">165,000đ</p>
                        </div>
                        <div class="star mt-1 text-left">
                            <p><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i></p>
                        </div>
                        <button class="buy bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2"><a href="../html/formlogin.html" class="no-underline text-white">BUY NOW</a></button>
                    </div>
                    <div class="product-1">
                        <a href="#"><img class="image-1" src="../img-productinfo/sach50.jpg" alt=""></a>
                        <div class="text">
                            <h1 class="text-1 text-left mt-2 text-gray-700 text-sm">Nhà xuất bản lẻ</h1>
                            <p class="text-2 text-left mt-1"><a href="#" class="no-underline hover:underline text-sm text-cyan-700">Gửi Bạn, Người Đang Bỏ Lỡ Hạnh Phúc Ngày Hôm Nay</a></p>
                        </div>
                        <div class="price mt-2 text-left text-sm">
                            <p class="price-index text-blue-800 font-bold">200,000đ</p>
                            <p class="price-index-1 text-gray-500 line-through inline-block ml-2">185,000đ</p>
                        </div>
                        <div class="star mt-1 text-left">
                            <p><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i></p>
                        </div>
                        <button class="buy bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2"><a href="../html/formlogin.html" class="no-underline text-white">BUY NOW</a></button>
                    </div>
                    <div class="product-1">
                        <a href="#"><img class="image-1" src="../img-productinfo/sach51.jpg" alt=""></a>
                        <div class="text">
                            <h1 class="text-1 text-left mt-2 text-gray-700 text-sm">Nhà xuất bản lẻ</h1>
                            <p class="text-2 text-left mt-1"><a href="#" class="no-underline hover:underline text-sm text-cyan-700">Cuộc Đời Ngắn Lắm Đừng Ôm Muộn Phiền </a></p>
                        </div>
                        <div class="price mt-2 text-left text-sm">
                            <p class="price-index text-blue-800 font-bold">185,000đ</p>
                            <p class="price-index-1 text-gray-500 line-through inline-block ml-2">175,000đ</p>
                        </div>
                        <div class="star mt-1 text-left">
                            <p><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i></p>
                        </div>
                        <button class="buy bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2"><a href="../html/formlogin.html" class="no-underline text-white">BUY NOW</a></button>
                    </div>
                    <div class="product-1">
                        <a href="#"><img class="image-1" src="../img-productinfo/sach52.jpg" alt=""></a>
                        <div class="text">
                            <h1 class="text-1 text-left mt-2 text-gray-700 text-sm">Nhà xuất bản lẻ</h1>
                            <p class="text-2 text-left mt-1"><a href="#" class="no-underline hover:underline text-sm text-cyan-700">Những Điều Tốt Đẹp Luôn Đúng Hạn Mà Đến</a></p>
                        </div>
                        <div class="price mt-2 text-left text-sm">
                            <p class="price-index text-blue-800 font-bold">160,000đ</p>
                            <p class="price-index-1 text-gray-500 line-through inline-block ml-2">150,000đ</p>
                        </div>
                        <div class="star mt-1 text-left">
                            <p><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i></p>
                        </div>
                        <button class="buy bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2"><a href="../html/formlogin.html" class="no-underline text-white">BUY NOW</a></button>
                    </div>
                </div>
            </div>
            <div class="recomment-3 text-center pt-12 pb-6">
                <h3 class="text-red-500 text-2xl lg:text-3xl font-bold">Sản phẩm đã xem</h3>
            </div>
            <div class="include px-4">
                <div class="product-kind max-w-[1250px] mx-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-y-8 text-center pl-10">
                    <div class="product-1">
                        <a href="#"><img class="image-1" src="../img-productinfo/sach53.jpg" alt=""></a>
                        <div class="text">
                            <h1 class="text-1 text-left mt-2 text-gray-700 text-sm">Nhà xuất bản lẻ</h1>
                            <p class="text-2 text-left mt-1"><a href="#" class="no-underline hover:underline text-sm text-cyan-700">Xuân Qua Hạ Đến</a></p>
                        </div>
                        <div class="price mt-2 text-left text-sm">
                            <p class="price-index text-blue-800 font-bold">120,000đ</p>
                            <p class="price-index-1 text-gray-500 line-through inline-block ml-2">115,000đ</p>
                        </div>
                        <div class="star mt-1 text-left">
                            <p><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i></p>
                        </div>
                        <button class="buy bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2"><a href="../html/formlogin.html" class="no-underline text-white">BUY NOW</a></button>
                    </div>
                    <div class="product-1">
                        <a href="#"><img class="image-1" src="../img-productinfo/sach54.jpg" alt=""></a>
                        <div class="text">
                            <h1 class="text-1 text-left mt-2 text-gray-700 text-sm">Nhà xuất bản lẻ</h1>
                            <p class="text-2 text-left mt-1"><a href="#" class="no-underline hover:underline text-sm text-cyan-700">Đừng Buồn Khi Hoàng Hôn Buông</a></p>
                        </div>
                        <div class="price mt-2 text-left text-sm">
                            <p class="price-index text-blue-800 font-bold">180,000đ</p>
                            <p class="price-index-1 text-gray-500 line-through inline-block ml-2">175,000đ</p>
                        </div>
                        <div class="star mt-1 text-left">
                            <p><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i></p>
                        </div>
                        <button class="buy bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2"><a href="../html/formlogin.html" class="no-underline text-white">BUY NOW</a></button>
                    </div>
                    <div class="product-1">
                        <a href="#"><img class="image-1" src="../img-productinfo/sach55.jpg" alt=""></a>
                        <div class="text">
                            <h1 class="text-1 text-left mt-2 text-gray-700 text-sm">Nhà xuất bản lẻ</h1>
                            <p class="text-2 text-left mt-1"><a href="#" class="no-underline hover:underline text-sm text-cyan-700">Đi Vòng Thế Giới Vẫn Quanh Một Người</a></p>
                        </div>
                        <div class="price mt-2 text-left text-sm">
                            <p class="price-index text-blue-800 font-bold">140,000đ</p>
                            <p class="price-index-1 text-gray-500 line-through inline-block ml-2">135,000đ</p>
                        </div>
                        <div class="star mt-1 text-left">
                            <p><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i></p>
                        </div>
                        <button class="buy bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2"><a href="../html/formlogin.html" class="no-underline text-white">BUY NOW</a></button>
                    </div>
                    <div class="product-1">
                        <a href="#"><img class="image-1" src="../img-productinfo/sach56.jpg" alt=""></a>
                        <div class="text">
                            <h1 class="text-1 text-left mt-2 text-gray-700 text-sm">Nhà xuất bản lẻ</h1>
                            <p class="text-2 text-left mt-1"><a href="#" class="no-underline hover:underline text-sm text-cyan-700">Đừng Nản Chí, Cố Lên Nào!</a></p>
                        </div>
                        <div class="price mt-2 text-left text-sm">
                            <p class="price-index text-blue-800 font-bold">210,000đ</p>
                            <p class="price-index-1 text-gray-500 line-through inline-block ml-2">200,000đ</p>
                        </div>
                        <div class="star mt-1 text-left">
                            <p><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i></p>
                        </div>
                        <button class="buy bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2"><a href="../html/formlogin.html" class="no-underline text-white">BUY NOW</a></button>
                    </div>
                    <div class="product-1">
                        <a href="#"><img class="image-1" src="../img-productinfo/sach57.jpg" alt=""></a>
                        <div class="text">
                            <h1 class="text-1 text-left mt-2 text-gray-700 text-sm">Nhà xuất bản lẻ</h1>
                            <p class="text-2 text-left mt-1"><a href="#" class="no-underline hover:underline text-sm text-cyan-700">Khi Bình Minh Tới Tớ Sẽ Đến Gặp Cậu Đầu Tiên</a></p>
                        </div>
                        <div class="price mt-2 text-left text-sm">
                            <p class="price-index text-blue-800 font-bold">220,000đ</p>
                            <p class="price-index-1 text-gray-500 line-through inline-block ml-2">215,000đ</p>
                        </div>
                        <div class="star mt-1 text-left">
                            <p><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i><i class='bx bxs-star text-yellow-500'></i></p>
                        </div>
                        <button class="buy bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2"><a href="../html/formlogin.html" class="no-underline text-white">BUY NOW</a></button>
                    </div>
                </div>
            </div>
            <div class="background-product bg-gray-100 h-16 max-w-full"></div>
        </div>
    </div>

    <?php include APP_DIR . '/Views/layout/footer.php'; ?>
</body>
</html>