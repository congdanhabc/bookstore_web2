<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,700;0,900;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Domine&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,700;0,900;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/output.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Shop Book</title>
</head>

<!--NAVBAR-->
<header>
        <marquee class="box">
            <div class="box-1">"Việc đọc rất quan trọng! Nếu bạn biết cách đọc, cả thế giới sẽ mở ra cho bạn." - Barack Obama</div>
        </marquee>
        <div class="header">
            
            <h1><a href="/" class="logo">BookStore</a></h1>
            <div class="nav">
                <ul>
                    <li class="dropdown-1">
                        <a href="/">Về BookStore</a>
                        <div class="dropdown-content">
                            <a href="#">Về BookStore</a>
                            <a href="#">Tìm đồng đội</a>
                        </div>
                    </li>
                    <li class="dropdown-2">
                        <a href="/books">Sách</a>
                        <div class="dropdown-content">
                            <a href="/books">Trẻ em</a>
                            <a href="/books">Tuổi Teen</a>
                            <a href="/books">Người lớn</a>
                        </div>
                    </li>
                    <li class="dropdown-3">
                        <a href="/books">Tủ sách</a>
                        <div class="dropdown-content">
                            <a href="/books">Best seller mọi thời đại</a>
                            <a href="/books">Sách mới,sách hay</a>
                            <a href="/books">Nhà quản lí-quản trị</a>
                            <a href="/books">Ceo đọc sách gì</a>
                            <a href="/books">Qùa tặng vô giá cho con</a>
                            <a href="/books">Phong cách sống</a>
                        </div>
                    </li>
                    <li class="dropdown-4">
                        <a href="/books">Tác giả Bestseller</a>
                        <div class="dropdown-content">
                            <a href="/books">Nguyễn Nhật Ánh</a>
                            <a href="/books">John Seymour</a>
                            <a href="/books">Michael Scott</a>
                            <a href="/books">Andrew Matthews</a>
                            <a href="/books">Stephen Hawking</a>
                            <a href="/books">Gosinny</a>
                        </div>
                    </li>
                    <li><a href="/books">Blog</a></li>
                </ul>
            </div>
            <!-- <div class="search">
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Tìm kiếm sản phẩm">
            </div> -->
            <div class="icon">
                <table>
                    <!-- <thead>
                        <th><i class='bx bx-user'></i></th>
                        <th><i class='bx bx-cart'></i></th>
                    </thead> -->
                    <tbody>
                        <tr>
                            <td>
                                
                                <?php if (!isset($_SESSION['user_id'])) 
                                    { 
                                ?>
                                    <div class="nav2">
                                        <a href="/login">
                                            <i class='bx bx-user text-[25px] text-[#075985]'></i>
                                            Đăng nhập
                                        </a>
                                    </div>
                                <?php 
                                    } 
                                    else { 
                                ?>
                                    <div class="dropdown-1">
                                        <button type="button" data-toggle="dropdown">
                                            <div class="nav2">
                                                <i class='bx bx-user text-[25px] text-[#075985]'></i>
                                                Tài khoản
                                            </div>
                                        </button>
                                        <div class="dropdown-content">
                                            <a href="/profile">Thông tin tài khoản</a>
                                            <a href="/logout">Đăng xuất</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="nav2 group">
                                    <div id="cart_1" class="relative">
                                        <a href='<?php echo(isset($_SESSION['user_id']) ? '/cart' : '/login')?>' id="cart_toggle">
                                            <span class="cart_icon">
                                                <i class='bx bx-cart text-[25px] text-[#075985]'></i>
                                            </span>
                                            <span class="box_cart_text">
                                                <span class="cart_text">Giỏ hàng</span>
                                            </span>                        
                                        </a>
                                        
                                        <?php if (isset($_SESSION['user_id']) && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) !== '/cart'): ?>          
                                        <div class="hidden absolute font-sans text-black bg-gray-100 shadow-xl w-100 h-fit p-5 right-1 rounded-2xl z-10 group-hover:block">
                                            <div class="items-center flex justify-center w-full">
                                                <span class="text-[#528b0f] p-3 font-bold text-xl">
                                                    GIỎ HÀNG
                                                </span>
                                            </div>
                                            
                                            <div id="miniCartList" class="mt-3 border-t-1 border-gray-400 py-1"></div>

                                            <div id="miniCartTotal" class="flex justify-between"></div>
                                            
                                            <div class="items-center flex justify-center w-full mt-2">
                                                <a href= "/cart" class="w-full flex items-center justify-center border-red-500 border-2 bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-100 hover:text-red-500 ease-in-out duration-300">
                                                    <span class="text-base">
                                                        XEM GIỎ HÀNG
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <script type="text/javascript" src="/js/mini_cart.js"></script>
</header>
