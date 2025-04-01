<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/books.css">
    <script type="text/javascript" src="/js/books.js"></script>
</head>

<body>
    <?php include APP_DIR . '/Views/layout/header.php'; ?>

    <div class="mainprinfo">
        <ul class="mainprinfo-list">
            <li class="mainprinfo-item mainprinfo-btn"><a href="index.html">Trang chủ</a></li>
            <li class="mainprinfo-item mainprinfo-btn-1"><a href="#">Kỹ năng - Công cụ</a></li>
            <li class="mainprinfo-item mainprinfo-btn-2"> Combo sách của Phan Văn Trường: Thay đổi một suy nghĩ, thay đổi cả cuộc đời - Một đời như kẻ tìm đường - Một đời quản trị - Một đời thương thuyết</li>
        </ul>
    </div>
    <div class="banner-2">
        <img class="img-index-3" src="https://file.hstatic.net/200000504927/file/5-cuon-sach__1__7a220db9e5524215a383ffb88c5006c9.jpg" alt="">
    </div>
    <div class="app__container">
        <div class="grid">
            <div class="grid__row app__content">
                <div class="grid__column-2">
                    <nav class="category">
                        <h3 class="category__heading"><i class='category__heading-icon bx bx-list-ul'></i> Danh mục
                        </h3>
                        <ul class="category-list">
                            <li>
                                <a href="#" onclick="myFunction1()" class="dropbtn1">Trẻ Em<i class='bx bxs-chevron-down'></i></a>
                                <ul class="filter_product" id="Dropdown1">
                                    <li><a href="../html/product-1.html">Văn học nước ngoài</a></li>
                                    <li><a href="../html/product.html">Kĩ năng sống</a></li>
                                    <li><a href="../html/product-1.html">Phát triển tư duy</a></li>
                                    <li><a href="../html/product.html">Tiếng Anh</a></li>
                                    <li><a href="../html/product-1.html">Truyện tranh</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" onclick="myFunction2()" class="dropbtn2">Tuổi Teen<i class='bx bxs-chevron-down'></i></a>
                                <ul class="filter_product" id="Dropdown2">
                                    <li><a href="../html/product-1.html">Văn học kinh điển</a></li>
                                    <li><a href="../html/product.html">Doanh nhân - Thần tượng</a></li>
                                    <li><a href="../html/product-1.html">Kỹ năng sống</a></li>
                                    <li><a href="../html/product.html">Kiến thức khoa học</a></li>
                                    <li><a href="../html/product-1.html">Tâm lý - Giới tính</a></li>
                                    <li><a href="../html/product.html">Truyện tranh</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" onclick="myFunction3()" class="dropbtn3">Người Lớn<i class='bx bxs-chevron-down'></i></a>
                                <ul class="filter_product" id="Dropdown3">
                                    <li><a href="../html/product-1.html">Kinh tế - Tài chính</a></li>
                                    <li><a href="../html/product.html">Tư duy lãnh đạo</a></li>
                                    <li><a href="../html/product-1.html">Kinh doanh - Đầu tư</a></li>
                                    <li><a href="../html/product.html">Văn hóa - Chính trị</a></li>
                                    <li><a href="../html/product-1.html">Pháp luật</a></li>
                                    <li><a href="../html/product.html">Tâm sinh lý</a></li>
                                    <li><a href="../html/product-1.html">Marketing - Truyền thông</a></li>
                                    <li><a href="../html/product.html">Sức khỏe - Y học</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" onclick="myFunction4()" class="dropbtn4">Truyện Tranh<i class='bx bxs-chevron-down'></i></a>
                                <ul class="filter_product" id="Dropdown4">
                                    <li><a href="../html/product-1.html">One Piece - Đảo hải tặc</a></li>
                                    <li><a href="../html/product.html">Conan - Thám tử lừng danh</a></li>
                                    <li><a href="../html/product-1.html">Doraemon - Chú mèo máy </a></li>
                                    <li><a href="../html/product.html">Fairy Tail - Hội pháp sư</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="grid__column-10">
                    <div class="home-filter">
                        <span class="home-filter__label">Sắp xếp theo</span>
                        <button class="home-filter__btn btn">Phổ Biến</button>
                        <button class="home-filter__btn btn btn--primary">Mới Nhất</button>
                        <button class="home-filter__btn btn">Bán Chạy</button>

                        <div class="select-input">
                            <span class="select-input__label">Giá</span>
                            <i class='.select-input__icon bx bx-chevron-down'></i>
                            <ul class="select-input__list">
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link"><input type="checkbox" id="checkbox-1" style="background-color:#155e75"><span>Dưới 100.000đ</span></a>
                                    </label>
                                </li>
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link"><input type="checkbox" id="checkbox-1"><span>100.000đ - 500.000đ</span></a>
                                    </label>
                                </li>
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link"><input type="checkbox" id="checkbox-1"><span>500.000đ - 1.000.000đ</span></a>
                                    </label>
                                </li>
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link"><input type="checkbox" id="checkbox-1"><span>1.000.000đ - 3.000.000đ</span></a>
                                    </label>
                                </li>
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link"><input type="checkbox" id="checkbox-1"><span>Trên 3.000.000đ</span></a>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="home-filter__page">
                            <span class="home-filter__page-num">
                                <span class="home-filter__page-current">1</span>/2
                            </span>
                            <div class="home-filter__page-control">
                                <a href="#" class="home-filter__page-btn home-filter__page-btn--disabled">
                                    <i class='home-filter__page-icon bx bx-chevron-left'></i>
                                </a>
                                <a href="#" class="home-filter__page-btn">
                                    <i class='home-filter__page-icon bx bx-chevron-right'></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($books)): ?>
                    <div class="home-product">
                        <div class="grid__row">
                            <?php foreach ($books as $book): ?>
                            <div class="grid__column-2-2">
                                <div class="home-product-item">
                                    <a href="/books/<?php echo htmlentities($book->id); ?>"><img class="image-2" src="\images\books\<?php echo htmlentities($book->image); ?>" alt=""></a>
                                    <div class="text-product">
                                        <h1 class="text-product-1"><?php echo htmlentities($book->name); ?></h1>
                                        <p class="text-product-2"><a href="#"><?php echo htmlentities($book->author); ?></a></p>
                                    </div>
                                    <div class="price-product">
                                        <p class="price-product-1"><?php echo htmlentities(number_format($book->sale_price, 0, ',', ' ')); ?> đ</p>
                                        <?php if ($book->sale_price != $book->price): ?>
                                            <p class="price-product-2"><?php echo htmlentities(number_format($book->price, 0, ',', ' ')); ?> đ</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="star-product">
                                        <p><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <div class="b-page">
        <div class="pagination-1">
            <a href="../html/product.html">&laquo;</a>
            <a href="../html/product.html">1</a>
            <a href="../html/product-1.html">2</a>
            <a href="../html/product-1.html">&raquo;</a>
        </div>
    </div>

    <div style="margin-bottom: 50px;"></div>
    <?php include APP_DIR . '/Views/layout/footer.php'; ?>
</body>