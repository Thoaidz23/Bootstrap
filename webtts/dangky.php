<?php
    include("./admin/connect.php");
    session_start();
?>

<!-- <?php
    if(isset($_POST["dangky"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $confirm_password = $_POST["confirm_password"];
        $otp = $_POST["otp"];

         // Kiểm tra nếu OTP không rỗng
    if (!empty($otp)) {
        // Lấy OTP từ cơ sở dữ liệu
        $query = "SELECT * FROM tbl_otp_signup WHERE email = '$email' ORDER BY expired_at DESC LIMIT 1";
        $result = mysqli_query($mysqli, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $otp_stored = $row['otp'];
            $expired_at = $row['expired_at'];

            // Kiểm tra nếu OTP người dùng nhập đúng và chưa hết hạn
            if ($otp == $otp_stored && strtotime($expired_at) > time()) {
                // OTP đúng và chưa hết hạn, tiếp tục đăng ký

                if ($password == $confirm_password) {
                    // Kiểm tra mật khẩu xác nhận đúng
                    $sql_dangky = mysqli_query($mysqli, "INSERT INTO tbl_user(name, email, phone, address, password, role) VALUE('$name', '$email', '$phone', '$address', '$hashedPassword', 2)");
                    if ($sql_dangky) {
                        // Đăng ký thành công, chuyển hướng đến trang đăng nhập
                        header("location: dangnhap.php");
                    } else {
                        echo "<p style='color: red'>Có lỗi xảy ra khi đăng ký, vui lòng thử lại</p>";
                    }
                } else {
                    echo "<p style='color: red'>Mật khẩu và mật khẩu xác nhận không khớp</p>";
                }
            } else {
                // OTP sai hoặc đã hết hạn
                echo "<p style='color: red'>Mã OTP không hợp lệ hoặc đã hết hạn. Vui lòng thử lại.</p>";
            }
        } else {
            // Không tìm thấy OTP trong CSDL
            echo "<p style='color: red'>Không tìm thấy mã OTP cho email này. Vui lòng thử lại.</p>";
        }
    } else {
        // OTP không được nhập
        echo "<p style='color: red'>Vui lòng nhập mã OTP.</p>";
    }
}
?> -->

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;     
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: white;
        }

        .main {
            background: white;
            padding: 100px 0 100px 0;
            text-align: center;
            max-width: 700px;
            width: 100%;
            align-items: center;
            margin:auto;
        }
        .login-title {
            font-size: 25px;
            margin-bottom: 40px;
        }
        .input-container {
            position: relative;
            margin: 10px 0 20px;
        }
        .box-input__main {
            font-size: 16px;
            width: 700px;
            border: none; 
            border-bottom: 1px solid #0097B2; 
            outline: none;  
            padding: 10px 0 10px 10px;
            transition: border-bottom 0.3s;
            margin-bottom:30px;
        }
        .box-input__main:focus {
            border-bottom: 1px solid rgb(15, 210, 181); 
        }
        label {
            position: absolute;
            left: 10px;
            top: 10px;
            font-size: 16px;
            color: #aaa;
            transition: 0.2s ease all;
            pointer-events: none;
        }
        .box-input__main:focus + label,
        .box-input__main:not(:placeholder-shown) + label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #0097B2;
        }
        .dangky {
            width: 700px;
            padding: 10px;
            background-color: #0097B2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;   
        }
        .dangky:hover {
            background-color: rgb(15, 210, 181);
        }
        .bcctktdk {
            margin-top: 20px;
        }


        /* Định dạng biểu tượng mắt */
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 30%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
            color: #555;
        }

        .input-container {
            position: relative; /* Cần có relative để icon mắt có thể đặt ở vị trí tuyệt đối */
        }

        input[type="password"] {
            padding-right: 30px; /* Để có không gian cho biểu tượng mắt */
        }


        /* Ẩn modal */
        .hidden {
            display: none !important ;
        }
        .no-scroll {
            overflow: hidden;
            height: 100vh;
        }
        .blur-background {
            /* filter: blur(5px); */
            pointer-events: none; /* Ngăn tương tác */
        }
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }       

        .payment-modal {
            background: white;
            border-radius: 8px;
            width: 90%;
            max-width: 400px;
            padding: 20px;
        }

        .payment-modal__head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            /* background:#FAFAFA; */
        }

        .payment-modal__head em {
            cursor: pointer;
        }

        .payment-modal__body {
            margin-top: 20px;
            margin-bottom:20px;
        }

        .list-payment__item {
            display: flex;
            align-items: center;
            border:1px solid rgba(145, 158, 171, .239);
            border-radius:10px;
            padding:11px;
            height: 70px;
            width: 50%;
            margin:0 25% 20px 25%;
            font-size:26px;
            letter-spacing:11.7px;
        }
        .list-payment__item:hover{
            background:#E0E0E0;
        }
        .list-payment__item.active{
            border:1px solid #0092B7 !important;
        }
        .payment-item__img img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        /* Khi thêm class này vào <body>, trang sẽ bị khóa cuộn */
        .btn{
            margin: 10px;
            border:1px solid rgba(145, 158, 171, .239);
            border-radius:10px;
            background:#0092B7;
            color:white;
            height:40px;
            width:40%;
            text-align:center !important;
            padding-top:10px;
        }
        .btn:hover{
            background: rgb(15, 210, 181) !important;
        }
    </style>
</head>
<body>
    <?php
        include("./includes/header.php");
    ?>
    <form id="registrationForm" action="send_otp_signup.php" method="post" onsubmit="return handleRegistration(event)">
    <div class="container py-5 main">
        <h2 class="text-center mb-4">Đăng ký</h2>

        <div class="form-group position-relative">
            <input type="text" class="form-control box-input__main" placeholder=" " autocomplete="off" name="name">
            <label for="name" class="form-label">Họ và tên</label>
        </div>

        <div class="form-group position-relative">
            <input type="text" class="form-control box-input__main" placeholder=" " maxlength="255" autocomplete="off" name="email">
            <label for="email" class="form-label">Email</label>
        </div>

        <div class="form-group position-relative">
            <input type="tel" class="form-control box-input__main" placeholder=" " maxlength="11" autocomplete="off" name="phone">
            <label for="phone" class="form-label">Số điện thoại</label>
        </div>

        <div class="form-group position-relative">
            <input type="text" class="form-control box-input__main" placeholder=" " maxlength="255" autocomplete="off" name="address">
            <label for="address" class="form-label">Địa chỉ</label>
        </div>

        <!-- Mật khẩu -->
        <div class="form-group position-relative">
            <input type="password" class="form-control box-input__main" placeholder=" " maxlength="255" autocomplete="off" name="password" id="password">
            <label for="password" class="form-label">Mật khẩu</label>
            <span class="toggle-password" id="togglePassword">
                <i class="fa-solid fa-eye"></i> <!-- Biểu tượng mắt -->
            </span>
        </div>

        <!-- Xác nhận mật khẩu -->
        <div class="form-group position-relative">
            <input type="password" class="form-control box-input__main" placeholder=" " maxlength="255" autocomplete="off" name="confirm_password" id="confirm_password">
            <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
            <span class="toggle-password" id="toggleConfirmPassword">
                <i class="fa-solid fa-eye"></i> <!-- Biểu tượng mắt -->
            </span>
        </div>

        <input type="submit" name="dangky" class="btn btn-primary w-100 mt-3" value="Đăng ký">

        <div class="bcctktdk mt-3">
            Bạn đã có tài khoản? <a href="dangnhap.php" style="color: #278cda">Đăng nhập</a>
        </div>
    </div>
</form>

    <div>
        
    <?php
        include("./includes/footer.php");
    ?>

    <script>
        
        // Nhảy placeholder
        const inputs = document.querySelectorAll('.box-input__main');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.placeholder = '';  
            });
            input.addEventListener('blur', () => {
                if (input.value === '') {
                    input.placeholder = ' '; 
                }
            });
        });


 // Hàm kiểm tra form
function validateForm() {
    let hasError = false; // Biến kiểm tra có lỗi hay không
    const notifications = []; // Mảng lưu các thông báo lỗi

    // Lấy giá trị số điện thoại
    const phoneInput = document.querySelector("input[name='phone']").value;
    const isValidLength = phoneInput.length >= 10 && phoneInput.length <= 11;
    const isValidPrefix = /^(03|05|07|08|09)/.test(phoneInput);
    const isNumeric = /^\d+$/.test(phoneInput);

    if (!(isValidLength && isValidPrefix && isNumeric)) {
        hasError = true;
        notifications.push({
            message: "Vui lòng kiểm tra lại số điện thoại",
            icon: "&#9888;",
        });
    }

    // Lấy giá trị email
    const emailInput = document.querySelector("input[name='email']").value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    if (!emailRegex.test(emailInput)) {
        hasError = true;
        notifications.push({
            message: "Vui lòng kiểm tra lại email",
            icon: "&#9888;",
        });
    }

    // Kiểm tra mật khẩu
    const passwordInput = document.querySelector("input[name='password']").value;
    const confirmPasswordInput = document.querySelector("input[name='confirm_password']").value;

    // Regex kiểm tra điều kiện mật khẩu
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
    if (!passwordRegex.test(passwordInput)) {
        hasError = true;
        notifications.push({
            message: "Mật khẩu phải có ít nhất 6 ký tự, bao gồm ít nhất một chữ cái, một số và một ký tự đặc biệt",
            icon: "&#9888;",
        });
    }

    if (passwordInput !== confirmPasswordInput) {
        hasError = true;
        notifications.push({
            message: "Mật khẩu xác thực không trùng khớp",
            icon: "&#9888;",
        });
    }

    // Hiển thị thông báo nếu có lỗi
    if (hasError) {
        const notificationContainer = document.createElement("div");
        notificationContainer.style.position = "fixed";
        notificationContainer.style.top = "70px";
        notificationContainer.style.left = "50%";
        notificationContainer.style.transform = "translateX(-50%)";
        notificationContainer.style.zIndex = "1000";
        notificationContainer.style.maxWidth = "330px";
        notificationContainer.style.width = "100%";

        notifications.forEach(function (notification) {
            const notificationDiv = document.createElement("div");
            notificationDiv.style.backgroundColor = "#FF6347";
            notificationDiv.style.color = "white";
            notificationDiv.style.padding = "10px 20px";
            notificationDiv.style.borderRadius = "5px";
            notificationDiv.style.display = "flex";
            notificationDiv.style.alignItems = "center";
            notificationDiv.style.marginBottom = "10px";
            notificationDiv.style.textAlign = "center";
            notificationDiv.style.justifyContent = "center";
            notificationDiv.style.wordWrap = "break-word";

            const icon = document.createElement("span");
            icon.innerHTML = notification.icon;
            icon.style.marginRight = "10px";
            icon.style.fontSize = "18px";

            const message = document.createElement("span");
            message.innerText = notification.message;

            notificationDiv.appendChild(icon);
            notificationDiv.appendChild(message);

            notificationContainer.appendChild(notificationDiv);
        });

        document.body.appendChild(notificationContainer);

        setTimeout(function () {
            notificationContainer.remove();
        }, 5000);
    }

    return !hasError; // Trả về true nếu không có lỗi
}

// Hàm xử lý đăng ký
function handleRegistration() {
    if (validateForm()) {
        // Nếu form hợp lệ, cho phép gửi form
        return true;
    } else {
        // Nếu form không hợp lệ, ngừng gửi form
        return false;
    }
}



    // Chức năng ẩn/hiện mật khẩu
    document.getElementById("togglePassword").addEventListener("click", function () {
        const passwordField = document.getElementById("password");
        const icon = this.querySelector("i");

        // Chuyển đổi giữa mật khẩu ẩn và hiện
        const type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;

        // Chuyển đổi biểu tượng mắt
        if (type === "password") {
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    });

    document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
        const confirmPasswordField = document.getElementById("confirm_password");
        const icon = this.querySelector("i");

        // Chuyển đổi giữa mật khẩu ẩn và hiện
        const type = confirmPasswordField.type === "password" ? "text" : "password";
        confirmPasswordField.type = type;

        // Chuyển đổi biểu tượng mắt
        if (type === "password") {
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    });

//     // Cửa số OTP
//     function openModal() {
//     const modal = document.getElementById("payment-modal");
//     const body = document.body;

//     if (modal && body) {
//         modal.classList.remove("hidden"); // Hiển thị modal
//         body.classList.add("no-scroll"); // Khóa cuộn
//     } else {
//         console.error("Modal hoặc body không được tìm thấy!");
//     }
// }

// function closeModal() {
//     const modal = document.getElementById("payment-modal");
//     const body = document.body;

//     if (modal && body) {
//         modal.classList.add("hidden"); // Ẩn modal
//         body.classList.remove("no-scroll"); // Mở cuộn
//     } else {
//         console.error("Modal hoặc body không được tìm thấy!");
//     }
// }

// // Gắn sự kiện cho nút đóng
// document.getElementById("close-modal-btn").addEventListener("click", closeModal);



// // Xử lý Ajax gửi otp khi nhấn nút Đăng ký
// function handleRegistration() {
//     const email = document.querySelector("input[name='email']").value;

//     // Kiểm tra email trước khi gửi OTP
//     if (email) {
//         // Gửi request tới backend để tạo OTP và gửi email
//         fetch('send_otp_signup.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//             },
//             body: JSON.stringify({ email: email })
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 openModal(); // Hiển thị modal khi OTP gửi thành công
//             } else {
//                 alert('Có lỗi xảy ra khi gửi OTP!');
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             alert('Có lỗi xảy ra!');
//         });
//     } else {
//         alert("Vui lòng nhập email!");
//     }
// }

    </script>
</body>
</html>
