<?php
    session_start();
    include("./admin/connect.php");
?>

<?php
    if(isset($_POST["dangnhap"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        // Lấy dữ liệu từ cơ sở dữ liệu (chỉ lấy thông tin người dùng có email trùng khớp)
        $sql = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
        $row = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($row);
        
        if ($count > 0) {
            $row_data = mysqli_fetch_array($row);
            
            // Kiểm tra mật khẩu người dùng nhập vào với mật khẩu đã mã hóa trong cơ sở dữ liệu
            if (password_verify($password, $row_data["password"])) {
                // Nếu mật khẩu đúng, lưu thông tin người dùng vào session và chuyển hướng về trang home.php
                if ($row_data["role"] == 1) {
                    $_SESSION["admin_name"] = $row_data["name"];
                    $_SESSION["admin_email"] = $row_data["email"];
                    $_SESSION["admin_id_user"] = $row_data["id_user"];
                    $_SESSION["admin_role"] = $row_data["role"];
                    header("Location: admin/admin.php?action=thongke");
                } else if ($row_data["role"] == 2) {
                    $_SESSION["name"] = $row_data["name"];
                    $_SESSION["email"] = $row_data["email"];
                    $_SESSION["id_user"] = $row_data["id_user"];
                    $_SESSION["role"] = $row_data["role"];
                    header("Location: home.php");
                }
                exit();
            } else {
                // Nếu mật khẩu sai
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const notificationDiv = document.createElement('div');
                            notificationDiv.classList.add('notification-div');
                            notificationDiv.innerHTML = '<span style=\"font-size: 18px;\">&#9888;</span> Mật khẩu đăng nhập không đúng. Vui lòng kiểm tra lại.';
                            document.body.appendChild(notificationDiv);
                            
                            setTimeout(function() {
                                notificationDiv.style.display = 'none'; // Ẩn thông báo sau 5 giây
                            }, 5000);  // 5000ms = 5 giây
                        });
                    </script>";
            }
        } else {
            // Nếu email không tồn tại trong cơ sở dữ liệu
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                const notificationDiv = document.createElement('div');
                notificationDiv.classList.add('notification-div');
                notificationDiv.innerHTML = '<span style=\"font-size: 18px;\">&#9888;</span> Email không tồn tại, vui lòng kiểm tra lại.';
                document.body.appendChild(notificationDiv);
                
                setTimeout(function() {
                    notificationDiv.style.display = 'none'; // Ẩn thông báo sau 5 giây
                }, 5000);  // 5000ms = 5 giây
            });
          </script>";
        }
    }
?>



<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./assets/css/index.css">
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


.container-main {
    text-align: center;
    display: flex;
    justify-content: center;
}
.main-form {
    margin-top: 40PX;
    background: white;
    padding: 40px;
    text-align: center;
    width: 800px;  /* Chiều rộng của form */
    height: 350px;  /* Chiều cao của form */
    border-radius: 10px;  /* Bo góc */
    display: flex; /* Sử dụng flexbox */
    flex-direction: column; /* Đảm bảo các phần tử trong form xếp theo chiều dọc */
    justify-content: center; /* Căn giữa các phần tử trong form */
}


    

.dangnhap:hover {
    background-color: rgb(15, 210, 181);
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
        .dangnhap {
            width: 700px;
            padding: 10px;
            background-color: #0097B2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;   
        }
        .dangnhap:hover {
            background-color: rgb(15, 210, 181);
        }
        .bcctktdk {
            margin-top: 20px;
        }

        /* Thông báo khi email ko tồn tại trong csdl */
        .notification-div {
            background-color: #FF6347; /* Đỏ nhạt */
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: flex; /* Sử dụng flexbox để căn icon */
            align-items: center; /* Căn giữa icon và chữ */
            margin-bottom: 10px; /* Khoảng cách giữa các thông báo */
            text-align: center; /* Căn giữa nội dung trong thông báo */
            justify-content: center; /* Căn giữa toàn bộ nội dung */
            word-wrap: break-word; /* Đảm bảo văn bản không bị tràn ra ngoài */
            
            position: fixed; /* Đảm bảo thông báo nằm cố định trên trang */
            left: 50%; /* Căn giữa thông báo theo chiều ngang */
            transform: translateX(-50%); /* Dịch chuyển sang trái 50% chiều rộng để căn giữa */
            top: 80px; /* Di chuyển xuống dưới một chút (có thể thay đổi giá trị này) */
            z-index: 9999; /* Đảm bảo thông báo nằm trên các phần tử khác */
        }
        .notification-div span {
            margin-right: 15px; /* Khoảng cách giữa icon và text */
            font-size: 18px; /* Kích thước icon */
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


    </style>
</head>
<body>
    <?php
        include("./includes/header.php");
    ?>
    <div class="container-main">
        <form id="dangnhap-form" action="" method="post" class="main-form">
            <h2 class="text-center mb-4">Đăng Nhập</h2>
            <div class="mb-3 position-relative">        
                <input type="text" class="form-control" id="email" name="email" maxlength="255" required autocomplete="off" placeholder="Nhập email">
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Mật khẩu</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" maxlength="255" required autocomplete="off" placeholder="Nhập mật khẩu">
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 dangnhap" name="dangnhap">Đăng nhập</button>

            <div class="mt-3 d-flex justify-content-between small">
                <span>Bạn chưa có tài khoản? <a href="dangky.php" style="color: #278cda">Đăng ký ngay</a></span>
                <a href="quenmatkhau.php" style="color: #278cda">Quên mật khẩu?</a>
            </div>
        </form>
    </div>
    <?php
        include("./includes/footer.php");
        ?>
</body>
<script>

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


    // Check form 1
    document.getElementById("dangnhap-form").addEventListener("submit", function (event) {
        let hasError = false; // Biến kiểm tra có lỗi hay không
        const notifications = []; // Mảng lưu các thông báo lỗi

        // Lấy giá trị email
        const emailInput = document.querySelector("input[name='email']").value;
        // Regex kiểm tra email hợp lệ
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
        // Kiểm tra email
        if (!emailRegex.test(emailInput)) {
            hasError = true; // Đánh dấu có lỗi
            notifications.push({
                message: "Vui lòng kiểm tra lại email",
                icon: "&#9888;", // Mã HTML cho icon cảnh báo (⚠)
            });
        }

        // Nếu có lỗi thì ngừng gửi biểu mẫu và tạo thông báo
        if (hasError) {
            event.preventDefault(); // Ngừng gửi biểu mẫu
            
            // Tạo thông báo container
            const notificationContainer = document.createElement("div");
            notificationContainer.style.position = "fixed";
            notificationContainer.style.top = "70px";
            notificationContainer.style.left = "50%";
            notificationContainer.style.transform = "translateX(-50%)"; // Căn giữa
            notificationContainer.style.zIndex = "1000";
            notificationContainer.style.maxWidth = "330px"; // Giới hạn chiều rộng container
            notificationContainer.style.width = "100%"; // Đảm bảo container chiếm toàn bộ chiều rộng có sẵn

            // Duyệt qua mảng notifications và tạo từng thông báo
            notifications.forEach(function (notification, index) {
                const notificationDiv = document.createElement("div");
                notificationDiv.style.backgroundColor = "#FF6347"; // Đỏ nhạt
                notificationDiv.style.color = "white";
                notificationDiv.style.padding = "10px 20px";
                notificationDiv.style.borderRadius = "5px";
                notificationDiv.style.display = "flex"; // Sử dụng flexbox để căn icon
                notificationDiv.style.alignItems = "center"; // Căn giữa icon và chữ
                notificationDiv.style.marginBottom = "10px"; // Khoảng cách giữa các thông báo
                notificationDiv.style.textAlign = "center"; // Căn giữa nội dung trong thông báo
                notificationDiv.style.justifyContent = "center"; // Căn giữa toàn bộ nội dung
                notificationDiv.style.wordWrap = "break-word"; // Đảm bảo văn bản không bị tràn ra ngoài

                // Tạo nội dung thông báo
                const icon = document.createElement("span");
                icon.innerHTML = notification.icon; // Mã HTML cho icon cảnh báo (⚠)
                icon.style.marginRight = "10px"; // Khoảng cách giữa icon và chữ
                icon.style.fontSize = "18px"; // Tăng kích thước icon

                const message = document.createElement("span");
                message.innerText = notification.message; // Tin nhắn thông báo

                // Gắn icon và chữ vào thông báo
                notificationDiv.appendChild(icon);
                notificationDiv.appendChild(message);

                // Thêm thông báo vào container
                notificationContainer.appendChild(notificationDiv);
            });

            // Thêm container chứa thông báo vào trang
            document.body.appendChild(notificationContainer);

            // Tự động ẩn thông báo sau 5 giây
            setTimeout(function () {
                notificationContainer.remove();
            }, 5000);
        }
    });

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
</script>
</html>
