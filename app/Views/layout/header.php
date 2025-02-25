<style>

/*KHUNG MÀU CHỮ XANH*/

.box {
    padding: 7.5px;
    background-color: #075985;
    color: #ffffff;
    text-align: center;
    font-family: 'Lobster', cursive;
}

.box-1 {
    font-size: 20px;
}

.header {
    height: 115px;
    max-width: 100%;
    margin: 0 auto;
    padding: 10px;
    background-color: #ffffff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/*CHỮ SHOPBOOK*/

.logo {
    font-size: 50px;
    font-weight: bold;
    color: #075985;
    font-family: 'Lobster', cursive;
    text-decoration: none;
    padding-left: 160px;
}

/*MỤC TIÊU ĐỀ*/

.nav a {
    text-decoration: none;
    color: #06b6d4;
    font-family: 'Lobster', cursive;
    font-size: 25px;
}

.nav {
    margin-right: 5px;
}

/*TÌM KIẾM SẢN PHẨM*/

.search {
    border: 1px solid black;
    border-radius: 30px;
    height: 60px;
    margin-right: 10px;
}

.search input {
    width: 160px;
    font-size: 18px; 
    height: 30px; 
    line-height: 50px; 
    outline: none; 
    border: none;
    margin: -10px 30px 0px 10px;
}

.search i {
    margin: 13px 0px 0px 13px;
    font-size: 27px;
}

/*TÀI KHOẢN VÀ GIỎ HÀNG*/

.icon td a {
    padding-left: 30px;
    text-decoration: none;
    color: #06b6d4;
    font-family: 'Lobster', cursive;
    font-size: 25px;
}

/*ICON USER VÀ CART*/

.icon {
    padding-right: 200px;
}

.icon th i {
    padding-left: 30px;
    font-size: 30px;
    color: #075985;
}

/*HÌNH CHỦ ĐỀ*/

.banner-image {
    height: 350px;
    width: 1400px;
    margin: auto;
    margin-left: 250px;
}

.main-infomation {
    max-height: 134%;
    background-color: white;
    width: 1400px;
    margin: 0px 0px 30px 250px;
    padding: 0px 0px 20px 0px;
}

.main-info {
    overflow: hidden;
    padding: 12px 12px;
}

.main-infoma {
    margin: 0px 15px;
    display: flex;
}

.main-info h2 {
    color: #059669;
    font-family: 'Roboto', sans-serif;
    font-size: 20px;
}

.main-list {
    flex: 0 0 25%;
    max-width: 90%;
    padding: 5px 8px;
}

.main-item {
    line-height: 25px;
    height: 100%;
    border-radius: 4px;
    background: #ffffff;
    border: 1px solid #f39f09;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 10px;
}

.title-1 {
    color: orange;
    font-family: 'Roboto', sans-serif;
    text-decoration: none;
    font-size: 21px;
    padding: 0px 100px 0px 0px;
}

.content-1 {
    color: #0ea5e9;
    text-decoration: none;
    font-size: 19px;
}

.title-2 {
    color: orange;
    font-family: 'Roboto', sans-serif;
    text-decoration: none;
    font-size: 21px;
}

.content-2 {
    color: #0ea5e9;
    text-decoration: none;
    font-size: 19px;
}

.title-3 {
    font-family: 'Roboto', sans-serif;
    color: orange;
    text-decoration: none;
    font-size: 21px;
    padding: 0px 10px 0px 0px;
}

.content-3 {
    color: #0ea5e9;
    text-decoration: none;
    font-size: 19px;
}

.title-4 {
    color: orange;
    font-family: 'Roboto', sans-serif;
    text-decoration: none;
    font-size: 21px;
    padding: 0px 100px 0px 0px;
}

.content-4 {
    color: #0ea5e9;
    text-decoration: none;
    font-size: 19px;
}


.name {
    color: #0284c7;
    font-size: 30px;
    margin-top: 25px;
    text-align: center;
    font-family: 'Roboto', sans-serif;
}

.noel-1 img {
    margin-top: 24px;
    margin-left: 195px;
    height: 420px;
    width: 740px;
}

.noel-2 img {
    margin-top: 24px;
    margin-right: 195px;
    height: 420px;
    width: 740px;
}

</style>

<!--NAVBAR-->
<header>
        <marquee class="box">
            <div class="box-1">"Việc đọc rất quan trọng! Nếu bạn biết cách đọc, cả thế giới sẽ mở ra cho bạn." - Barack Obama</div>
        </marquee>

        <div class="header">
            <h1><a href="index.php" class="logo">BookStore</a></h1>
            <div class="nav">
                <ul>
                    <li class="dropdown-1">
                        <a href="../html/introduce.html">Về BookStore</a>
                        <div class="dropdown-content">
                            <a href="#">Về BookStore</a>
                            <a href="#">Tìm đồng đội</a>
                        </div>
                    </li>
                    <li class="dropdown-2">
                        <a href="../html/product.html">Sách</a>
                        <div class="dropdown-content">
                            <a href="../html/product.html">Trẻ em</a>
                            <a href="../html/product.html">Tuổi Teen</a>
                            <a href="../html/product.html">Người lớn</a>
                        </div>
                    </li>
                    <li class="dropdown-3">
                        <a href="../html/product.html">Tủ sách</a>
                        <div class="dropdown-content">
                            <a href="../html/product.html">Best seller mọi thời đại</a>
                            <a href="../html/product.html">Sách mới,sách hay</a>
                            <a href="../html/product.html">Nhà quản lí-quản trị</a>
                            <a href="../html/product.html">Ceo đọc sách gì</a>
                            <a href="../html/product.html">Qùa tặng vô giá cho con</a>
                            <a href="../html/product.html">Phong cách sống</a>
                        </div>
                    </li>
                    <li class="dropdown-4">
                        <a href="../html/product.html">Tác giả Bestseller</a>
                        <div class="dropdown-content">
                            <a href="../html/product.html">Nguyễn Nhật Ánh</a>
                            <a href="../html/product.html">John Seymour</a>
                            <a href="../html/product.html">Michael Scott</a>
                            <a href="../html/product.html">Andrew Matthews</a>
                            <a href="../html/product.html">Stephen Hawking</a>
                            <a href="../html/product.html">Gosinny</a>
                        </div>
                    </li>
                    <li><a href="../html/product.html">Blog</a></li>
                </ul>
            </div>
            <div class="search">
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Tìm kiếm sản phẩm">
            </div>
            <div class="icon">
                <table>
                    <thead>
                        <th><i class='bx bx-user'></i></th>
                        <th><i class='bx bx-cart'></i></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="formlogin.html">Tài khoản</a></td>
                            <td><a href="cart.html">Giỏ hàng</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</header>