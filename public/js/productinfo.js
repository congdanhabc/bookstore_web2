function myFunction5() {
    var dropdown = document.getElementById("Dropdown5");
    var icon = document.querySelector(".display i");

    // Kiểm tra trạng thái hiển thị
    if (dropdown.classList.contains("show5")) {
        dropdown.style.maxHeight = "0px"; // Thu gọn lại
        setTimeout(() => dropdown.classList.remove("show5"), 400); // Xóa class sau hiệu ứng
        icon.classList.remove("fa-minus");
        icon.classList.add("fa-plus");
    } else {
        dropdown.classList.add("show5");
        dropdown.style.maxHeight = dropdown.scrollHeight + "px"; // Mở rộng theo nội dung
        icon.classList.remove("fa-plus");
        icon.classList.add("fa-minus");
    }
}

// Đóng dropdown khi click bên ngoài
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn5') && !event.target.matches('.display i')) {
        var dropdowns = document.getElementsByClassName("filter_product");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show5")) {
                openDropdown.style.maxHeight = "0px"; // Thu gọn trước khi ẩn
                setTimeout(() => openDropdown.classList.remove("show5"), 400);
                var icon = document.querySelector(".display i");
                icon.classList.remove("fa-minus");
                icon.classList.add("fa-plus");
            }
        }
    }
}

function myFunction6() {
    var dropdown = document.getElementById("Dropdown6");
    var icon = document.querySelector(".display-1 i");

    // Kiểm tra trạng thái hiển thị
    if (dropdown.classList.contains("show6")) {
        dropdown.style.maxHeight = "0px"; // Thu gọn lại
        setTimeout(() => dropdown.classList.remove("show6"), 400); // Xóa class sau hiệu ứng
        icon.classList.remove("fa-minus");
        icon.classList.add("fa-plus");
    } else {
        dropdown.classList.add("show6");
        dropdown.style.maxHeight = dropdown.scrollHeight + "px"; // Mở rộng theo nội dung
        icon.classList.remove("fa-plus");
        icon.classList.add("fa-minus");
    }
}

// Đóng dropdown khi click bên ngoài
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn6') && !event.target.matches('.display-1 i')) {
        var dropdowns = document.getElementsByClassName("filter_product");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show6")) {
                openDropdown.style.maxHeight = "0px"; // Thu gọn trước khi ẩn
                setTimeout(() => openDropdown.classList.remove("show6"), 400);
                var icon = document.querySelector(".display-1 i");
                icon.classList.remove("fa-minus");
                icon.classList.add("fa-plus");
            }
        }
    }
}