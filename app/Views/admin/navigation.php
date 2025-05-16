<style>
    .navigation {
        box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.3);
        z-index: 999;
        position: fixed;
        width: 300px;
        height: 100%;
        background: oklch(62.3% 0.214 259.815) !important;
        border-left: 10px solid oklch(62.3% 0.214 259.815) !important;
        transition: 0.5s;
        overflow: hidden;
    }

    .navigation ul li a .title {
        /* color: #FFFFFF; */
        font-size: 18px !important;
        font-family: 'Roboto', sans-serif;
        position: relative;
        display: block;
        padding: 0 10px;
        height: 60px;
        line-height: 60px;
        text-align: start;
        white-space: nowrap;
    }
</style>
<div class="navigation">
    <ul>
        <li>
            <a href="../../Admin/interface/trangchu.php">
                <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
                <span class="title">Book Store</span>
            </a>
        </li>
        <li>
            <a href="../../Admin/interface/trangchu.php">
                <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                <span class="title">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="../Admin/customers.html">
                <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                <span class="title">Customers</span>
            </a>
        </li>
        <li>
            <a href="../../Admin/interface/sanpham.php">
                <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                <span class="title">New Product</span>
            </a>
        </li>
        <li>
            <a href="../../Admin/interface/donhang.php">
                <span class="icon"><ion-icon name="cart-outline"></ion-icon></span>
                <span class="title">Oders</span>
            </a>
        </li>
        <li>
            <a href="../../Admin/interface/statistical.php">
                <span class="icon"><ion-icon name="storefront-outline"></ion-icon></span>
                <span class="title">Inventory</span>
            </a>
        </li>
        <li>
            <a href="../../Admin/interface/account.php">
                <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                <span class="title">Accounts</span>
            </a>
        </li>
        <li>
            <a href="../../Admin/php/dangxuat.php">
                <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                <span class="title">Sign Out</span>
            </a>
        </li>
    </ul>
</div>