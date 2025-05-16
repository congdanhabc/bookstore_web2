<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/productinfo.css">
</head>

<body>
    <?php include APP_DIR . '/Views/layout/header.php'; ?>
    <!--BANNER-->
    <div class="main">
        <div class="banner">
            <img class="banner-image" src="\images\banners\welcome.webp"
                alt="Quà tặng vô giá cho con">
        </div>
        <div class="main-infomation">
            <div class="main-info">
                <h2>HÔM NAY ĐỌC SÁCH GÌ</h2>
            </div>
            <div class="main-infoma">
                <div class="main-list">
                    <div class="main-item">
                        <a href="#">
                            <span class="title-1">[Giới thiệu sách mới] "Yoga theo Dosha" - Lời tác giả</span>
                            <span class="content-1">Tôi sinh ra là một đứa trẻ yếu ớt với đủ mọi vấn đề về sức khỏe. Bố tôi hay đánh thức tôi dậy lúc 4 giờ sáng và hướng dẫn tôi tập Yoga.</span>
                        </a>
                    </div>
                </div>
                <div class="main-list">
                    <div class="main-item">
                        <a href="#">
                            <span class="title-2">Ayurveda - Khoa học trong lối sống của người Ấn Độ xưa</span>
                            <span class="content-2">Ayurveda là sự thông thái và khoa học về lối sống của người Ấn Độ xưa, là chị em với Yoga, giúp con người có một cuộc sống an lành, khỏe mạnh.</span>
                        </a>
                    </div>
                </div>
                <div class="main-list">
                    <div class="main-item">
                        <a href="#">
                            <span class="title-3">Grand Master Kamal lần đầu tiên xuất bản 2 cuốn sách Yoga</span>
                            <span class="content-3">Grand Master Kamal được Liên minh Yoga thế giới tôn vinh là 1 trong 8 huấn luyện viên Yoga thành công nhất thế giới.</span>
                        </a>
                    </div>
                </div>
                <div class="main-list">
                    <div class="main-item">
                        <a href="#">
                            <span class="title-4">Yoga for men - Phục hồi và tăng sức mạnh nam giới</span>
                            <span class="content-4">Cuốn sách này sẽ mang đến cho bạn hệ thống Yoga Chuyển đổi (Metabolic Yoga - MY) đầu tiên trên thế giới dành cho nam giới.</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="name">SÁCH THỊNH HÀNH</div>
    </div>
    <!--TẠO KHUNG VÀ THÔNG TIN SẢN PHẨM THỨ NHẤT-->
    <div class="include">
        <div class="product-in">
            <?php 
            $count = 0;
            foreach ($data as $product): ?>
            <div class="product-1">
                <a href="/books/<?php echo $product->id; ?>"><img class="image-1" src="/images/books/<?php echo $product->image; ?>" alt=""></a>
                <div class="text">
                    <h1 class="text-1"><?php echo $product->publisher; ?></h1>
                    <p class="text-2"><a href="/books/<?php echo $product->id; ?>"><?php echo $product->name; ?></a></p>
                </div>
                <div class="price">
                    <p class="price-index"><?php echo htmlentities(number_format($product->price, 0, ',', ' ')); ?> đ</p>
                    <p class="price-index-1"><?php echo htmlentities(number_format($product->price, 0, ',', ' ')); ?> đ</p>
                </div>
                <div class="star">
                    <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                </div>
                <button class="buy"><a href="../html/formlogin.html">BUY NOW</a></button>
            </div>
            <?php
            $count++;
            if($count > 9)
                break;
            endforeach ?>
        </div>
        <div class="banner-2">
            <img class="img-index-2" src="https://file.hstatic.net/200000504927/file/banner_tu_sach__1__21e82fd5f34041a1b817e9f4140ed0e9.png" alt="">
        </div>
        <div class="banner-2">
            <img class="img-index-2" src="https://file.hstatic.net/200000504927/file/banner_tu_sach_daf4237d4f9f4659986b07d221d57b7b.png" alt="">
        </div>
    </div>
    <!--PHẦN CUỐI-->
    <div style='margin-bottom: 50px;'></div>
    <?php include APP_DIR . '/Views/layout/footer.php'; ?>
</body>

</html>