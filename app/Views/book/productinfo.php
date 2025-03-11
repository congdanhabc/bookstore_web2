<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/productinfo.css">
    <script type="text/javascript" src="/js/productinfo.js"></script>
</head>

<body>
    <?php include APP_DIR . '/Views/layout/header.php'; ?>

    <div class="mainprinfo">
        <ul class="mainprinfo-list">
            <li class="mainprinfo-item mainprinfo-btn"><a href="#">Trang chủ</a></li>
            <li class="mainprinfo-item mainprinfo-btn-1"><a href="#">Kỹ năng - Công cụ</a></li>
            <li class="mainprinfo-item mainprinfo-btn-2"> Combo sách của Phan Văn Trường: Thay đổi một suy nghĩ, thay đổi cả cuộc đời - Một đời như kẻ tìm đường - Một đời quản trị - Một đời thương thuyết</li>
        </ul>
    </div>
    <div class="app__info">
        <div class="grid-productinfo">
            <div class="grid-productinfo__row app__info">
                <div class="grid__column-5">
                    <div class="img-product">
                        <img src="\images\books\<?php echo htmlentities($book->image); ?>" alt="">
                    </div>
                    <?php if ($book->price != $book->sale_price) : ?>
                        <div class="off-info">
                            <h2 class="sm-title">SALE OFF</h2>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="grid__column-7">
                    <div class="include-info">
                        <div class="name-product">
                            <h1><?php echo htmlentities($book->name) ; ?></h1>
                        </div>
                        <div class="tilte-product">
                            <ul class="tilte-product-info">
                                <li>
                                    <div class="info-product">
                                        <h5>Tác giả:</h5>
                                        <span class="hr-product"><?php echo htmlentities($book->author) ; ?></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="info-product-1">
                                        <h5>NXB:</h5>
                                        <span><?php echo htmlentities($book->publisher) ; ?></span>
                                    </div>
                                </li>
                            </ul>
                            <ul class="price-product-info">
                                <?php if ($book->sale_price != $book->price): ?>
                                    <li>
                                        <p class="product-price"><?php echo htmlentities(number_format($book->price, 0, ',', ' ')); ?> đ</p>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <p class="product-price-1"><?php echo htmlentities(number_format($book->sale_price, 0, ',', ' ')); ?> đ</p>
                                </li>
                                <li>
                                    <h2 class="price-down"><?php echo htmlentities(number_format(100 - ($book->sale_price / $book->price) * 100, 0, ',', ' ')); ?>% GIẢM</h2>
                                </li>
                            </ul>
                            <ul class="button-product-info">
                                <li><button class="button-product"><a href="#">Chat ngay</a></button></li>
                                <li><button class="button-product-1"><a href="../html/cart.html">THÊM VÀO GIỎ</a></button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="button-info">
                        <ul>
                            <li><button>FREESHIP đơn hàng từ 1 triệu đồng</button></li>
                            <li><button>Cam kết bảo mật thông tin khách hàng</button></li>
                        </ul>
                    </div>
                    <div class="include-product-information">
                        <div class="product-information">
                            <a href="#" onclick="myFunction5()" class="dropbtn5">THÔNG TIN SẢN PHẨM</a>
                            <ul class="filter_product" id="Dropdown5">
                                <li>
                                    <div class="pro-inf">
                                        <ul>
                                            <li class="info-first-1">Công ty phát hành</li>
                                            <li class="info-second-1">NXB Trẻ</li>
                                        </ul>
                                        <ul>
                                            <li class="info-first">Ngày xuất bản</li>
                                            <li class="info-second-2">2019-11-01 00:00:00</li>
                                        </ul>
                                        <ul>
                                            <li class="info-first">Kích thước</li>
                                            <li class="info-second-3">15.5 x 23 cm</li>
                                        </ul>
                                        <ul>
                                            <li class="info-first">Loại bìa</li>
                                            <li class="info-second-4">Bìa mềm</li>
                                        </ul>
                                        <ul>
                                            <li class="info-first">Số trang</li>
                                            <li class="info-second-5">336</li>
                                        </ul>
                                        <ul>
                                            <li class="info-first">Nhà xuất bản</li>
                                            <li class="info-second-6">NXB Trẻ</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="product-describe">
                                        <h3>MÔ TẢ SẢN PHẨM</h3>
                                        <h4>Hơn 40 năm kinh nghiệm trong nghề và cả nghiệp thương thuyết, Giáo sư Phan Văn Trường, Cố vấn thương mại quốc tế của chính phủ Pháp, có lẽ đã cố gắng thể hiện gần trọn vẹn trong cuốn sách này.</h4>
                                        <h4>Được viết từ trải nghiệm của một người thường xuyên “xông pha trận mạc” đàm phán, thật khó có thể tìm được cuốn sách nào khác về đề tài này mang tính thực tế cao hơn Một đời thương thuyết. Trong đó không có những
                                            bài lý thuyết theo lớp lang chuẩn mực, nhưng độc giả sẽ được “sống” thực sự trong từng bối cảnh đàm phán như đang diễn ra trước mắt. Và độc giả sẽ đọc cuốn sách này chẳng khác gì đang đọc một tập truyện ngắn
                                            đầy những tình tiết thú vị.</h4>
                                        <h4>Nhà sách online Book trân trọng giới thiệu đến bạn cuốn sách này. Hy vọng nó sẽ đem lại cho bạn đọc những giờ phút thật thư thái, trong tâm hồn và nhiều kiến thức hấp dẫn, bổ ích cùng những bài học hay về triết
                                            lý nhân sinh. Hãy mua sách tại nhà sách Kala và theo dõi chúng tôi thường xuyên để nhận nhiều ưu đãi hơn nhé.</h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="dash-page">
                            <hr class="dash-3">
                        </div>
                        <div class="product-information-1">
                            <a href="#" onclick="myFunction6()" class="dropbtn6">DỊCH VỤ GIAO HÀNG</a>
                            <ul class="filter_product" id="Dropdown6">
                                <li>
                                    <div class="icon-product">
                                        <ul>
                                            <li class="ico-att">
                                                <span class="icon-pr"><i class='bx bx-check-shield' ></i></span>
                                                <span class="attention">Cam kết 100% chính hãng</span>
                                            </li>
                                            <li class="ico-att-1">
                                                <span class="icon-pr-1"><i class='bx bxs-truck' ></i></span><span class="attention-1">Giao hàng dự kiến</span>
                                                <br>
                                                <strong class="attention-2">Thứ 2 - Thứ 6 từ 9h00 - 17h00</strong>
                                            </li>
                                            <li class="ico-att-2">
                                                <span class="icon-pr-2"><i class='bx bx-revision'></i></span><span class="attention-3">Hỗ trợ 24/7</span>
                                                <br>
                                                <strong class="attention-4">Với các kênh chat, email & phone</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="comment">
                        <h3>KHÁCH HÀNG NHẬN XÉT</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="dash-page-1">
            <hr class="dash-4">
        </div>
    </div>
    <div class="recomment">
        <div class="recomment-1">
            <h3>Gợi ý Sách liên quan</h3>
        </div>
        <div class="recomment-2">
            <h3>Sản phẩm liên quan</h3>
        </div>
        <div class="include">
            <div class="product-kind">
                <div class="product-1">
                    <a href="#"><img class="image-1" src="../img-productinfo/sach48 (2).jpg" alt=""></a>
                    <div class="text">
                        <h1 class="text-1">Nhà xuất bản lẻ</h1>
                        <p class="text-2"><a href="#">Thế Gian Này Dẫu Đẹp Nhưng Cũng Chẳng Bằng Em</a></p>
                    </div>
                    <div class="price">
                        <p class="price-index">140,000đ</p>
                        <p class="price-index-1">120,000đ</p>
                    </div>
                    <div class="star">
                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                    </div>
                    <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
                </div>
                <div class="product-1">
                    <a href="#"><img class="image-1" src="../img-productinfo/sach49.jpg" alt=""></a>
                    <div class="text">
                        <h1 class="text-1">Nhà xuất bản lẻ</h1>
                        <p class="text-2"><a href="#">Không Biết Làm Sao Để Trưởng Thành</a></p>
                    </div>
                    <div class="price">
                        <p class="price-index">175,000đ</p>
                        <p class="price-index-1">165,000đ</p>
                    </div>
                    <div class="star">
                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                    </div>
                    <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
                </div>
                <div class="product-1">
                    <a href="#"><img class="image-1" src="../img-productinfo/sach50.jpg" alt=""></a>
                    <div class="text">
                        <h1 class="text-1">Nhà xuất bản lẻ</h1>
                        <p class="text-2"><a href="#">Gửi Bạn, Người Đang Bỏ Lỡ Hạnh Phúc Ngày Hôm Nay</a></p>
                    </div>
                    <div class="price">
                        <p class="price-index">200,000đ</p>
                        <p class="price-index-1">185,000đ</p>
                    </div>
                    <div class="star">
                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                    </div>
                    <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
                </div>
                <div class="product-1">
                    <a href="#"><img class="image-1" src="../img-productinfo/sach51.jpg" alt=""></a>
                    <div class="text">
                        <h1 class="text-1">Nhà xuất bản lẻ</h1>
                        <p class="text-2"><a href="#">Cuộc Đời Ngắn Lắm Đừng Ôm Muộn Phiền </a></p>
                    </div>
                    <div class="price">
                        <p class="price-index">185,000đ</p>
                        <p class="price-index-1">175,000đ</p>
                    </div>
                    <div class="star">
                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                    </div>
                    <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
                </div>
                <div class="product-1">
                    <a href="#"><img class="image-1" src="../img-productinfo/sach52.jpg" alt=""></a>
                    <div class="text">
                        <h1 class="text-1">Nhà xuất bản lẻ</h1>
                        <p class="text-2"><a href="#">Những Điều Tốt Đẹp Luôn Đúng Hạn Mà Đến</a></p>
                    </div>
                    <div class="price">
                        <p class="price-index">160,000đ</p>
                        <p class="price-index-1">150,000đ</p>
                    </div>
                    <div class="star">
                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                    </div>
                    <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
                </div>
            </div>
        </div>
        <div class="recomment-3">
            <h3>Sản phẩm đã xem</h3>
        </div>
        <div class="include">
            <div class="product-kind">
                <div class="product-1">
                    <a href="#"><img class="image-1" src="../img-productinfo/sach53.jpg" alt=""></a>
                    <div class="text">
                        <h1 class="text-1">Nhà xuất bản lẻ</h1>
                        <p class="text-2"><a href="#">Xuân Qua Hạ Đến</a></p>
                    </div>
                    <div class="price">
                        <p class="price-index">120,000đ</p>
                        <p class="price-index-1">115,000đ</p>
                    </div>
                    <div class="star">
                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                    </div>
                    <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
                </div>
                <div class="product-1">
                    <a href="#"><img class="image-1" src="../img-productinfo/sach54.jpg" alt=""></a>
                    <div class="text">
                        <h1 class="text-1">Nhà xuất bản lẻ</h1>
                        <p class="text-2"><a href="#">Đừng Buồn Khi Hoàng Hôn Buông</a></p>
                    </div>
                    <div class="price">
                        <p class="price-index">180,000đ</p>
                        <p class="price-index-1">175,000đ</p>
                    </div>
                    <div class="star">
                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                    </div>
                    <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
                </div>
                <div class="product-1">
                    <a href="#"><img class="image-1" src="../img-productinfo/sach55.jpg" alt=""></a>
                    <div class="text">
                        <h1 class="text-1">Nhà xuất bản lẻ</h1>
                        <p class="text-2"><a href="#">Đi Vòng Thế Giới Vẫn Quanh Một Người</a></p>
                    </div>
                    <div class="price">
                        <p class="price-index">140,000đ</p>
                        <p class="price-index-1">135,000đ</p>
                    </div>
                    <div class="star">
                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                    </div>
                    <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
                </div>
                <div class="product-1">
                    <a href="#"><img class="image-1" src="../img-productinfo/sach56.jpg" alt=""></a>
                    <div class="text">
                        <h1 class="text-1">Nhà xuất bản lẻ</h1>
                        <p class="text-2"><a href="#">Đừng Nản Chí, Cố Lên Nào!</a></p>
                    </div>
                    <div class="price">
                        <p class="price-index">210,000đ</p>
                        <p class="price-index-1">200,000đ</p>
                    </div>
                    <div class="star">
                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                    </div>
                    <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
                </div>
                <div class="product-1">
                    <a href="#"><img class="image-1" src="../img-productinfo/sach57.jpg" alt=""></a>
                    <div class="text">
                        <h1 class="text-1">Nhà xuất bản lẻ</h1>
                        <p class="text-2"><a href="#">Khi Bình Minh Tới Tớ Sẽ Đến Gặp Cậu Đầu Tiên</a></p>
                    </div>
                    <div class="price">
                        <p class="price-index">220,000đ</p>
                        <p class="price-index-1">215,000đ</p>
                    </div>
                    <div class="star">
                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                    </div>
                    <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
                </div>
            </div>
        </div>
        <div class="background-product"></div>
    </div>
</div>

    <?php include APP_DIR . '/Views/layout/footer.php'; ?>
</body>