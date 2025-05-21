<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/books.css">
</head>

<body>
    <?php include APP_DIR . '/Views/layout/header.php'; ?>

    <div class="mainprinfo">
    </div>

    <div class="app__container">
        <div class="grid">
            <div class="grid__row app__content">
                <div class="grid__column-2">
                    <nav class="category">
                        <h3 class="category__heading"><i class='category__heading-icon bx bx-list-ul'></i> Danh mục
                        </h3>
                        <ul class="category-list" id="category-list"> 
                            <li>
                                <button data-categoryid=" " class="category-list-btn">
                                    <span>
                                        Tất cả sách
                                    </span>
                                </button>
                            </li>
                            <?php foreach ($categories as $category): ?>
                            <li>
                                <button class="category-list-btn" data-categoryid="<?php echo htmlentities($category->id); ?>">
                                    <span>
                                        <?php echo htmlentities($category->name); ?>
                                    </span>
                                </button>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </div>
                <div class="grid__column-10">
                    <div class="home-filter" id="home-filter">
                        <span class="home-filter__label">Sắp xếp theo</span>
                        <button class="home-filter__btn filter-sort-btn" data-sort="name" data-ascending="false">
                            <span>Tên A-Z</span>
                            <span class="sort-icon">
                                <i class='bx sort-asc-icon'> <img style="width: 20px;" src="images/icons/ascending-sort.png"> </i>  <!-- Icon tăng dần -->
                                <i class='bx sort-desc-icon'> <img style="width: 20px;" src="images/icons/sort-descending.png"> </i> <!-- Icon giảm dần -->
                            </span>
                        </button>

                        <button class="home-filter__btn filter-sort-btn inactive" data-sort="sale_price" data-ascending="true">
                            <span>Giá</span>
                            <span class="sort-icon">
                                <i class='bx sort-asc-icon'> <img style="width: 20px;" src="images/icons/ascending-sort.png"> </i>  <!-- Icon tăng dần -->
                                <i class='bx sort-desc-icon'> <img style="width: 20px;" src="images/icons/sort-descending.png"> </i> <!-- Icon giảm dần -->
                            </span>
                        </button>

                        <button class="home-filter__btn inactive" data-sort="created_at" data-ascending="true">Mới nhất</button>

                        <div class="select-input">
                            <span class="select-input__label">Giá</span>
                            <i class='.select-input__icon bx bx-chevron-down'></i>
                            <ul class="select-input__list" id="price-filter">
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link active" data-price_min=" " data-price_max=" "><span>Tất cả giá</span></a>
                                    </label>
                                </li>
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link inactive" data-price_min=" " data-price_max="50000"><span>Dưới 50.000đ</span></a>
                                    </label>
                                </li>
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link inactive" data-price_min="50000" data-price_max="100000"><span>50.000đ - 100.000đ</span></a>
                                    </label>
                                </li>
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link inactive" data-price_min="100000" data-price_max="150000"><span>100.000đ - 150.000đ</span></a>
                                    </label>
                                </li>
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link inactive" data-price_min="150000" data-price_max="200000"><span>150.000đ - 200.000đ</span></a>
                                    </label>
                                </li>
                                <li class="select-input__item">
                                    <label for="checkbox-1" class="checkbox">
                                        <a href="#" class="select-input__link inactive" data-price_min="200000" data-price_max=" "><span>Trên 200.000đ</span></a>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="home-filter__page">
                            <!-- <span class="home-filter__page-num">
                                <span class="home-filter__page-current">1</span>/2
                            </span>
                            <div class="home-filter__page-control">
                                <a href="#" class="home-filter__page-btn home-filter__page-btn--disabled">
                                    <i class='home-filter__page-icon bx bx-chevron-left'></i>
                                </a>
                                <a href="#" class="home-filter__page-btn">
                                    <i class='home-filter__page-icon bx bx-chevron-right'></i>
                                </a>
                            </div> -->
                            <div class="search" id="search">
                                <input type="text" placeholder="Tìm kiếm sản phẩm" value="" id="search-input">
                                <button class="search_btn" id="search-btn">
                                    <i class='bx bx-search'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div id="home-product" class="home-product"></div>                
                </div>
            </div>
        </div>
    </div>

    <div class="b-page" id="pagination-container">
    </div>

    <script src="/js/books.js"></script>

    <div style="margin-bottom: 50px;"></div>
    <?php include APP_DIR . '/Views/layout/footer.php'; ?>
</body>