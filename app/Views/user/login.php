<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/form.css">
    <title>Đăng nhập</title>
</head>

<body>
    <?php include APP_DIR . '/Views/layout/header.php';?>
    <div class="form">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Đăng nhập</button>
                <button type="button" id="btn_register" class="toggle-btn" onclick="register()">Đăng ký</button>
            </div>
            <div class="social-icons">
                <!-- <img src="../img/fb.png" alt="">
                <img src="../img/tw.png" alt="">
                <img src="../img/gp.png" alt=""> -->
                <h1 class="logo_form">BookStore</h1>
            </div>
            <div id="message" class="message">
                <?php if (isset($error_register)): ?>
                        <p class="error-message"><?php echo htmlspecialchars($error_register); ?></p>
                <?php endif; ?>
                <?php if (isset($error_login)): ?>
                    <p class="error-message"><?php echo htmlspecialchars($error_login); ?></p>
                <?php endif; ?>
                <?php if (isset($success_message)): // Kiểm tra biến $success_message ?>
                    <p class="success-message" style="color: red;"><?php echo htmlspecialchars($success_message); ?></p>
                <?php endif; ?>
            </div>
            <form id="login" class="input-group" action="/authenticate" method="POST">
                <input type="email" name="email" class="input-field" placeholder="Email" required>
                <input type="password" name="password" class="input-field" placeholder="Mật khẩu" required>
                <input type="checkbox" class="chech-box"><span class="password">Lưu mật khẩu</span>
                <button type="submit" class="submit-btn">Đăng nhập</button>
                <br><a href="#" class="login-admin">Quên mật khẩu ?</a></br>
            </form>
            <form id="register" class="input-group" action="/register" method="POST">
                <input type="text" name="name" class="input-field" placeholder="Họ tên" required>
                <select class="form-select form-select-sm mb-3" id="city" name="city" aria-label=".form-select-sm" style="width: 215px;">
                    <option value="" selected>Chọn tỉnh thành</option>           
                </select>
                        
                <select class="form-select form-select-sm mb-3" id="district" name="district" aria-label=".form-select-sm">
                    <option value="" selected>Chọn quận huyện</option>
                </select>

                <select class="form-select form-select-sm" id="ward" name="ward" aria-label=".form-select-sm">
                    <option value="" selected>Chọn phường xã</option>
                </select>

                <input type="text" class="input-field" placeholder="Số nhà - Tên đường" name="address" required>
                <input type="number" class="input-field" placeholder="Số điện thoại" name="phone" required>
                <input type="email" class="input-field" placeholder="Email" name="email" required>
                <input type="password" class="input-field" placeholder="Mật khẩu" name="password" required>
                <input type="password" class="input-field" placeholder="Nhập lại mật khẩu" name="password_confirmation" required>
                <input type="checkbox" class="chech-box" required><span class="agree">Tôi đồng ý với các điều kiện và điều khoản</span>
                <button type="submit" class="submit-btn">Đăng ký</button>
            </form>
        </div>
    </div>
    <?php include APP_DIR . '/Views/layout/footer.php'; ?>
</body>
<script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("btn");

    function register() {
        x.style.left = "-400px";
        y.style.left = "75px";
        z.style.left = "110px";
    }

    function login() {
        x.style.left = "75px";
        y.style.left = "515px";
        z.style.left = "0px";
        }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
    url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
    method: "GET", 
    responseType: "application/json", 
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
    renderCity(result.data);
    });

    function renderCity(data) {
    for (const x of data) {
        citis.options[citis.options.length] = new Option(x.Name, x.Id);
    }
    citis.onchange = function () {
        district.length = 1;
        ward.length = 1;
        if(this.value != ""){
        const result = data.filter(n => n.Id === this.value);

        for (const k of result[0].Districts) {
            district.options[district.options.length] = new Option(k.Name, k.Id);
        }
        }
    };
    district.onchange = function () {
        ward.length = 1;
        const dataCity = data.filter((n) => n.Id === citis.value);
        if (this.value != "") {
        const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

        for (const w of dataWards) {
            wards.options[wards.options.length] = new Option(w.Name, w.Id);
        }
        }
    };
    }
</script>

</html>