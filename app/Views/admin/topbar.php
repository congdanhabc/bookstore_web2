<style>
    .topbar {
        background: linear-gradient(to right, #287bff, #a5f3fc) !important;
        width: 100%;
        height: 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
    }
</style>
<div class="topbar">
    <div class="toggle">
        <ion-icon name="menu-outline"></ion-icon>
    </div>
    <!--userimg-->
    <div class="user">
        <p class="user_name">
            <?php
            if (isset($_SESSION['username'])) {
                echo htmlspecialchars($_SESSION['username']);
            } else {
                echo "Tài khoản";
            }
            ?>
        </p>
        <img src="../../img/user.png" alt="">
    </div>
</div>